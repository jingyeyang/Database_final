<?php
// 檢查是否有存儲計數器的 session，若無則初始化為 0
session_start();
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}

// 將計數器值加 1
$_SESSION['counter']++;

// 取得計數器的值
$counter = $_SESSION['counter'];

require_once('config/config.php');
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
    <title>Dashboard</title>
    <!-- ======= Styles ====== -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- =============== Navigation ================ -->
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="book-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">總覽</span>
                    </a>
                </li>

                <li>
                    <a href="app/user/login.php">
                        <span class="icon">
                            <ion-icon name="log-in-outline"></ion-icon>
                        </span>
                        <span class="title">會員登入</span>
                    </a>
                </li>

                <li>
                    <a href="app/user/login.php">
                        <span class="icon">
                            <ion-icon name="people-outline"></ion-icon>
                        </span>
                        <span class="title">會員資料修改</span>
                    </a>
                </li>
                <li>
                    <a href="app/user/login.php">
                        <span class="icon">
                            <ion-icon name="list-outline"></ion-icon>
                        </span>
                        <span class="title">餐廳列表</span>
                    </a>
                </li>

                <li>
                    <a href="app/user/login.php">
                        <span class="icon">
                            <ion-icon name="bookmarks-outline"></ion-icon>
                        </span>
                        <span class="title">訂單紀錄</span>
                    </a>
                </li>

                <li>
                    <a href="app/restaurant/login.php">
                        <span class="icon">
                            <ion-icon name="storefront-outline"></ion-icon>
                        </span>
                        <span class="title">餐廳管理系統</span>
                    </a>
                </li>

                 <li>
                    <a href="app/admin/login.php">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">系統管理者</span>
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
                    <a href="app/user/login.php"><img src="assets/imgs/customer.jpg" alt=""></a>
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
                        <div class="numbers"><?php echo $user_count;?></div>
                        <div class="cardName">Total user</div>
                    </div>

                    <div class="iconBx">
                        <ion-icon name="people-outline"></ion-icon>
                    </div>
                </div>
            </div>

            <!-- ================ Order Details List ================= -->
            <div class="details">
                <div class="recentOrders">
                    <div class="cardHeader">
                        <h2>Restaurant list</h2>
                        <a href="app/user/restaurants.php" class="btn">View All</a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>logo</td>
                                <td>Name</td>
                                <td>description</td>                           
                                <td>address</td>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                // 包含 config.php
                                require_once('config/config.php');

                                // ******** update your personal settings ******** 
                                $sql = "SELECT * FROM restaurants LIMIT 13;";
                                $result = $conn->query($sql);	// Send SQL Query

                                if ($result->num_rows > 0) {	
                                    while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
                                        $imageData = base64_encode($row['logo']);
                                        $imageSrc = "data:image/jpeg;base64," . $imageData;
                                        echo "
                                        <tr>
                                            <td width='20%'>
                                                <div class='imgBx'><img src=" . $imageSrc ." alt='' style='width: 40px; height: auto;'></div>
                                            </td>
                                            <td>" . $row['name'] . "</td>
                                            <td>" . $row['description'] . "</td>
                                            <td>" . $row['address'] . "</td>
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
                        <h2>Recommended dishes</h2>
                    </div>

                    <table>
                        
                        <?php
                            // 包含 config.php
                            require_once('config/config.php');

                            // ******** update your personal settings ******** 
                            $sql = "SELECT m.name AS menu_item_name, r.logo,r.name
                                    FROM ratings ra
                                    JOIN menu_items m ON ra.menu_item_id = m.item_id
                                    JOIN restaurants r ON ra.restaurant_id = r.restaurant_id
                                    ORDER BY ra.menu_item_rating DESC
                                    LIMIT 12;";

                            $result = $conn->query($sql);	// Send SQL Query
                            if ($result->num_rows > 0) {	
                                while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
                                    $imageData = base64_encode($row['logo']);
                                    $imageSrc = "data:image/jpeg;base64," . $imageData;
                                    echo "
                                    <tr>
                                        <td width='60px'>
                                            <div class='imgBx'><img src='" . $imageSrc ."' alt=''></div>
                                        </td>
                                        <td>
                                            <h4>". $row['menu_item_name'] ."<br> <span>" . $row['name'] . "</span></h4>
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
    <script src="assets/js/main.js"></script>

    <!-- ====== ionicons ======= -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>