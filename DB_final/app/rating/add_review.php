<?php
	session_start();

	if (!isset($_SESSION['user_id'])) {
        header("Location: ../user/login.php");
        exit;
    };

?>


<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>評分與評論</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <style>@import url('https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&family=Poppins:wght@600&display=swap');

* {
    box-sizing: border-box
}

body {
    background-color: #d9ecf2;
    font-family: 'Poppins', sans-serif;
    color: #666
}

.h2 {
    color: #444;
    font-family: 'PT Sans', sans-serif
}

thead {
    font-family: 'Poppins', sans-serif;
    font-weight: bolder;
    font-size: 20px;
    color: #666
}

img {
    width: 40px;
    height: 40px
}

.name {
    display: inline-block
}

.bg-blue {
    background-color: #EBF5FB;
    border-radius: 8px
}

.fa-check,
.fa-minus {
    color: blue
}

.bg-blue:hover {
    background-color: #3e64ff;
    color: #eee;
    cursor: pointer
}

.bg-blue:hover .fa-check,
.bg-blue:hover .fa-minus {
    background-color: #3e64ff;
    color: #eee
}

.table thead th,
.table td {
    border: none
}

.table tbody td:first-child {
    border-bottom-left-radius: 10px;
    border-top-left-radius: 10px
}

.table tbody td:last-child {
    border-bottom-right-radius: 10px;
    border-top-right-radius: 10px
}

#spacing-row {
    height: 10px
}

.action-button {
    color: #000; /* 按鈕字的顏色 */
}

.button-container {
  display: flex;
}

.button-container .button {
  margin-right: 10px;
}

.button-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}


@media(max-width:575px) {
    .container {
        width: 125%;
        padding: 20px 10px
    }
}</style>


<script type='text/javascript' src=''></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>

<!-- form -->
<?php echo "<form method='post' action='submit_review.php'>";?>

<div class="container rounded mt-5 bg-white p-md-5">
    

    <div class="h2 font-weight-bold" align='center'>餐廳評分</div>

    <div class="table-responsive">
        

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">訂單編號</th>
                    <th scope="col">餐廳名稱</th>
                    <th scope="col">評分(1-5分)</th>
                </tr>
            </thead>
            <tbody>

            <!-- php -->
            <?php
                // 連接資料庫並查詢用戶資訊
                require_once('../../config/config.php');

                // 獲取傳遞的參數
                $order_id = $_GET['order_id'];
                $restaurant_name = $_GET['restaurant_name'];
                // 在資料庫中查詢訂單詳細資訊
                $select_order_items_sql = "SELECT menu_items.item_id AS menu_item_id,menu_items.restaurant_id,menu_items.name, menu_items.description , menu_items.price FROM order_items
                INNER JOIN menu_items ON order_items.item_id = menu_items.item_id
                WHERE order_items.order_id = $order_id";

                $result = mysqli_query($conn, $select_order_items_sql);

                if ($result) {	
                    // echo "<tr>";
                    // echo "<td>" . $row["restaurant_id"] . "</td>";
                    // echo "<td>" . $row["name"] . "</td>";
                    // echo "<td>" . $row["description"] . "</td>";
                    // echo "<td>" . $row["address"] . "</td>";
                    // echo "<td>" . $row["phone_number"] . "</td>";
                    // echo "<td>" . $row["rating"] . "</td>";
                    // echo "<td><a href='menu_items.php?restaurant_id=" . $row['restaurant_id'] . "'>查看</a></td>";
                    
                    echo "
                    <tr class='bg-blue'>
                        <td class='pt-3'>" . $order_id . "</td>
                        <td class='pt-3 mt-1'>" . $restaurant_name . "</td>
                        
                        <td><input type='number' name='restaurant_rating' min='1' max='5' required></td>
                        
                    </tr>

                    <tr id='spacing-row'>
                        <td></td>
                    </tr>";


                    // menu items rating
                    
                    // menu items rating

                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>尚未新增菜單</td></tr>";
                }
                
		        ?>
            </tbody>
        </table>
        

        <br><br><br><br>

    <!-- 菜單評分 -->
    <div class="h2 font-weight-bold" align='center'>菜單評分</div>

    <div class="table-responsive">
        
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">菜單名稱</th>
                    <th scope="col">菜單敘述</th>
                    <th scope="col">價格</th>
                    <th scope="col">評分(1-5分)</th>
                </tr>
            </thead>
            <tbody>

            <!-- php -->
            <?php
                // 連接資料庫並查詢用戶資訊
                require_once('../../config/config.php');

                // // 獲取傳遞的參數
                // $order_id = $_GET['order_id'];
                // $restaurant_name = $_GET['restaurant_name'];
                // 在資料庫中查詢訂單詳細資訊


                while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {	
                    // echo "<tr>";
                    // echo "<td>" . $row["restaurant_id"] . "</td>";
                    // echo "<td>" . $row["name"] . "</td>";
                    // echo "<td>" . $row["description"] . "</td>";
                    // echo "<td>" . $row["address"] . "</td>";
                    // echo "<td>" . $row["phone_number"] . "</td>";
                    // echo "<td>" . $row["rating"] . "</td>";
                    // echo "<td><a href='menu_items.php?restaurant_id=" . $row['restaurant_id'] . "'>查看</a></td>";
                    
                    echo "
                    <tr class='bg-blue'>
                        <input type='hidden' name='user_id' value='" . $_SESSION['user_id'] . "'>
                        <input type='hidden' name='restaurant_id' value='" . $row["restaurant_id"] . "'>
                        <input type='hidden' name='menu_item_id[]' value='" . $row["menu_item_id"] . "'>
                        <td class='pt-3'>" . $row["name"] . "</td>
                        <td class='pt-3 mt-1'>" . $row["description"] . "</td>
                        <td class='pt-3'>" . $row["price"] . "</td>
                        <td><input type='number' name='menu_item_rating[]' min='1' max='5' required></td>
                        
                    </tr>

                    <tr id='spacing-row'>
                        <td></td>
                    </tr>";


                    // menu items rating
                    
                    // menu items rating

                }
                echo "<tr>";
                echo "<td><label for='comment'>評論:</label></td>";
                echo "<td><textarea name='comment' required></textarea></td>";
                echo "</tr>";
                echo "<tr>";
                echo "<input type='hidden' name='order_id' value='" . $order_id . "'>";
                echo "<br><td colspan='7' style='text-align: center;'><button type='submit'>確認送出</button></td>";
                echo "</tr>";
		        ?>
            </tbody>
        </table>


        <p align='center'><a href='../user/order_history.php'>返回訂單紀錄</a><p>
        <p align='center'><a href='../user/dashboard.php'>返回首頁</a><p>
            
    </div>
    
    

</div>

<?php
    echo "</form>";
?>


<script type='text/javascript'></script>
</body>
</html>