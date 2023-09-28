<?php
session_start();
if (!isset($_SESSION['restaurant_id'])) {
    header("Location: login.php");
    exit;
}

$restaurant_id = $_SESSION['restaurant_id'];

if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}

// 將計數器值加 1
$_SESSION['counter']++;

// 取得計數器的值
$counter = $_SESSION['counter'];

require_once('../../config/config.php');
$count_sql = "SELECT
    (SELECT COUNT(*) FROM ratings) AS comment_count,
    (SELECT COUNT(*) FROM menu_items) AS item_count,
    (SELECT COUNT(*) FROM restaurants) AS restaurant_count,
    (SELECT COUNT(*) FROM users) AS user_count;";	// set up your sql query

$result = $conn->query($count_sql);	// Send SQL Query

if ($result->num_rows > 0){
    $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC );
    $comment_count = $row['comment_count'];
    $item_count = $row['item_count'];
    $restaurant_count = $row['restaurant_count'];
    $user_count = $row['user_count'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">餐廳管理系統</span>
                    </a>
                </li>

                <li>
                    <a href="dashboard.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">總覽</span>
                    </a>
                </li>

                <li>
                    <a href="restaurant_info.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">餐廳資料</span>
                    </a>
                </li>

                <!-- <li>
                    <a href="restaurants.php">
                        <span class="icon">
                            <ion-icon name="chatbubble-outline"></ion-icon>
                        </span>
                        <span class="title">餐廳列表</span>
                    </a>
                </li> -->

                <li>
                    <a href="menu_items.php">
                        <span class="icon">
                            <ion-icon name="star"></ion-icon>
                        </span>
                        <span class="title">菜單管理</span>
                    </a>
                </li>

                <li>
                    <a href="rating_history.php">
                        <span class="icon">
                            <ion-icon name="receipt-outline"></ion-icon>
                        </span>
                        <span class="title">評論紀錄</span>
                    </a>
                </li>
            

                <!-- <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="lock-closed-outline"></ion-icon>
                        </span>
                        <span class="title">密碼</span>
                    </a>
                </li> -->

                 <li>
                    <a href="tracing_order.php">
                        <span class="icon">
                            <ion-icon name="receipt-outline"></ion-icon>
                        </span>
                        <span class="title">訂單</span>
                    </a>
                </li> 

                <li>
                    <a href="../public/logout.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- ========================= Main ==================== -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>

                <div class="search">
                    <label>
                        <input type="text" placeholder="Search here">
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>

                <div class="user">
                    <img src="../../assets/imgs/login1.png" alt="">
                </div>
            </div>

            <!-- ======================= Cards ================== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $counter;?></div>
                        <div class="cardName">Total Views</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $item_count;?></div>
                        <div class="cardName">Items</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cart-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $comment_count;?></div>
                        <div class="cardName">Comments</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="chatbubbles-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers"><?php echo $restaurant_count;?></div>
                        <div class="cardName">Total restaurant</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="cash-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Rating History</h2>
                        <a href="rating_history.php" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>菜單名稱</td>
                                <td>菜單評分</td>
                                <td>評論</td>
                                <td>建立時間</td>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                // 包含 config.php
                                require_once('../../config/config.php');

                                // ******** update your personal settings ******** 
                                $sql = "SELECT r.name AS restaurant_name, m.name AS menu_item_name , ra.*
                                        FROM ratings ra
                                        JOIN menu_items m ON ra.menu_item_id = m.item_id
                                        JOIN restaurants r ON ra.restaurant_id = r.restaurant_id
                                        WHERE ra.restaurant_id ='" . $_SESSION['restaurant_id'] . "' ORDER BY ra.created_at DESC
                                        LIMIT 10;";
                                $result = $conn->query($sql);	// Send SQL Query
                                if ($result->num_rows > 0) {	
                                    while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
                                        echo "
                                        <tr>
                                            <td>" . $row['menu_item_name'] . "</td>
                                            <td>" . $row['menu_item_rating'] . "</td>
                                            <td>" . $row['comment'] . "</td>
                                            <td>" . $row['created_at'] . "</td>
                                        </tr>";
                                        }
                                }
                                
                            ?>

                        </tbody>
                    </table>
                </div>

                <!-- ================= New Customers ================ -->
                <div class="recentCustomers">
                    <div class="cardHeader">
                        <h2>Recent Customers</h2>
                    </div>

                    <table>
                            <?php
                                // 包含 config.php
                                require_once('../../config/config.php');

                                // ******** update your personal settings ******** 
                                $sql = "SELECT u.user_id, u.first_name, u.delivery_address
                                FROM users u
                                WHERE u.user_id IN (
                                  SELECT DISTINCT o.user_id
                                  FROM orders o
                                  WHERE o.restaurant_id = $restaurant_id);";
                                $result = $conn->query($sql);	// Send SQL Query
                                if ($result->num_rows > 0) {	
                                    while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
                                        echo "
                                        <tr>
                                            <td width='60px'>
                                                <div class='imgBx'><img src='../../assets/imgs/user.png' alt=''></div>
                                            </td>
                                            <td>
                                                <h4>" . $row['first_name'] . "<br> <span>" . $row['delivery_address'] . "</span></h4>
                                            </td>
                                        </tr>";
                                        }
                                }
                                
                            ?>
    
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="../../../assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>