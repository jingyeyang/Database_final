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
<body oncontextmenu='return false' class='snippet-body' onload="setTimeout('location.reload()', 5000)">
<div class="container rounded mt-5 bg-white p-md-5">
    <div class="h2 font-weight-bold" align='center'>目前訂單</div>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">訂單編號</th>
                    <th scope="col">下單時間</th>
                    <th scope="col">訂單客戶編號</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>

            <!-- php -->
            <?php
                // 包含 config.php
                require_once('../../config/config.php');

                // 獲取當前用戶的 ID
                $restaurant_id = $_SESSION['restaurant_id'];
                //echo $restaurant_id;
    
                // ******** update your personal settings ******** 
                // 從資料庫中檢索當前存在之訂單

                $sql = "SELECT *
                        FROM recent_order as reo
                        JOIN orders o ON o.order_id = reo.order_id
                        WHERE o.restaurant_id = $restaurant_id";
                        

                $result = $conn->query($sql);	// Send SQL Query

                if ($result->num_rows > 0) {	
                    while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
                        
                        echo "
                        <tr class='bg-blue'>
                            <td class='pt-3 mt-1'>" . $row['order_id'] . "</td>
                            <td class='pt-3'>" . $row["order_time"] . "</td>
                            <td class='pt-3'>" . $row["user_id"] . "</td>
                            <td class='pt-3'> <p align='center'><a href='order_infos.php?order_id=" . $row['order_id']. "&order_time=". $row['order_time'] . "'>訂單資訊</a><p></td>
                        </tr>

                        <tr id='spacing-row'>
                            <td></td>
                        </tr>";
                    }
                } else {
                    // echo "No user found with ID $user_id.";
                    echo "<td colspan='7' style='text-align: center;'>尚未有訂單</td>";

                }
            ?>

            </tbody>
        </table>
        <p align='center'><a href='dashboard.php'>返回首頁</a><p>
    </div>
</div>
<script type='text/javascript'></script>
</body>
</html>