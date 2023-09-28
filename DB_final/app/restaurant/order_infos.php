<?php


session_start(); // 開始 Session
if (!isset($_SESSION['restaurant_id'])) {
    header("Location: login.php");
    exit;
}

?>

<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>訂單</title>
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
<div class="container rounded mt-5 bg-white p-md-5">
    <div class="h2 font-weight-bold" align='center'>訂單資訊</div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">訂單編號</th>
                    <th scope="col">下單時間</th>
                </tr>
            </thead>
            <tbody>

            <!-- php -->
            <?php
                // 包含 config.php
                require_once('../../config/config.php');

                // 獲取傳遞的參數
                $order_id = $_GET['order_id'];
                $order_time = $_GET['order_time'];
                //echo $order_id;
                // 獲取當前用戶的 ID
                $restaurant_id = $_SESSION['restaurant_id'];
    
                // ******** update your personal settings ******** 
                // 從資料庫中檢索當前查看之訂單
                        echo "
                        <tr class='bg-blue'>
                            <td class='pt-3 mt-1'>" . $order_id . "</td>
                            <td class='pt-3'>" . $order_time . "</td>
                        </tr>

                        <tr id='spacing-row'>
                            <td></td>
                        </tr>";

            ?>

            </tbody>
            <thead>
                <tr>
                    <th scope="col">下單餐點</th>
                </tr>
            </thead>
            <tbody>
                <!-- php -->
                <?php
                // 包含 config.php
                //require_once('../../config/config.php');

                // 獲取當前用戶的 ID
                //$restaurant_id = $_SESSION['restaurant_id'];
    
                // ******** update your personal settings ******** 
                // 從資料庫中檢索當前存在之訂單

                $sql = "SELECT *
                        FROM recent_order reo
                        JOIN orders o ON o.order_id = reo.order_id";

                $sql = "SELECT *
                        FROM order_items as oi
                        JOIN menu_items mi ON mi.item_id = oi.item_id
                        WHERE oi.order_id = $order_id";

                $sql = "SELECT *
                        FROM menu_items as mi
                        JOIN order_items oi ON oi.item_id = mi.item_id
                        JOIN orders o ON o.order_id = oi.order_id
                        WHERE oi.order_id = $order_id && o.restaurant_id = $restaurant_id";


                $result = $conn->query($sql);	// Send SQL Query

                if ($result->num_rows > 0) {	
                    while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
                        
                        echo "
                        <tr class='bg-blue'>
                            <td class='pt-3 mt-1'>" . $row['item_id'] . "</td>
                            <td class='pt-3 mt-1'>" . $row['name'] . "</td>
                            <td class='pt-3 mt-1'>" . $row['quantity'] . " 份</td>
                        </tr>

                        <tr id='spacing-row'>
                            <td></td>
                        </tr>";
                    }
                } else {
                    // echo "No user found with ID $user_id.";
                    echo "<td colspan='7' style='text-align: center;'>尚未新增評論</td>";

                }
            ?>
            </tbody>
            <thead>
                <tr>
                    <th scope="col">訂單狀況</th>
                </tr>
                <tr>
                    <!--<th><button>oder check</button></th>-->
                    <form action = "" method = "post" class = "form">
                    <th><input type="submit" name = "order_check" value="ORDER CHECK"></th>
                    <th><input type="submit" name = "finish_cook" value="FINISH COOK"></th>
                    <th><input type="submit" name = "delivering" value="DELIVERING"></th>
                    </form>
                </tr>
            </thead>
            <tbody>
                <!-- php -->
                <?php
                // 包含 config.php
                //require_once('../../config/config.php');

                // 獲取當前用戶的 ID
                //$restaurant_id = $_SESSION['restaurant_id'];
    
                //echo $order_id;
                if(array_key_exists('order_check', $_POST))
                {
                    //echo "hahaha";
                    $sql = "UPDATE recent_order
                            SET recent_order.state = 'reataurant has check your order'
                            WHERE recent_order.order_id = $order_id";

                    $result = $conn->query($sql);
                }

                if(array_key_exists('finish_cook', $_POST))
                {
                    //echo "hahaha";
                    $sql = "UPDATE recent_order
                            SET recent_order.state = 'finish cooking , wait to deliver'
                            WHERE recent_order.order_id = $order_id";

                    $result = $conn->query($sql);
                }

                if(array_key_exists('delivering', $_POST))
                {
                    //echo "hahaha";
                    $sql = "UPDATE recent_order
                            SET recent_order.state = 'delivering your food'
                            WHERE recent_order.order_id = $order_id";

                    $result = $conn->query($sql);

                    
                    $url = "tracing_order.php";
                    echo "<script type='text/javascript'>";
                    echo "window.location.href='$url'";
                    echo "</script>"; 
                }


            ?>
            </tbody>
        </table>
        <p align='center'><a href='tracing_order.php'>返回訂單</a><p>
    </div>
</div>
<script type='text/javascript'></script>
</body>
</html>