<?php


session_start(); // 開始 Session
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

?>

<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>餐廳資訊</title>
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
<body oncontextmenu='return false' class='snippet-body' onload="setTimeout('location.reload()', 500000)">
<div class="container rounded mt-5 bg-white p-md-5">
    <div class="h2 font-weight-bold" align='center'>餐廳資訊</div>
    <div class="table-responsive">
        <table class="table">

        <thead>
                <tr>
                    <th></th>
                    <!--<th scope="col">操作</th>-->
                    <th></th>
                    <th></th>
                    <th scope="col">搜尋</th>
    
   

                </tr>
                <tr>
                    <form action = "" method = "post" class = "form">
                    <!--<th><input type="submit" name = "create_user_acount" value="建立新帳號"></th>-->
                    <th></th>
                    <th></th>
                    </form>
                    <th></th>
                    <form action = "" method = "post" class = "form">
                    <th> 電話 : <input type="text" name = "phone_num" size="13"></th>
                    <th><input type="submit" name = "search_user_acount" value="Search"></th>
                    <th></th>
                    </form>
                </tr>
            </thead>

            <tbody>
                <!-- php -->
                <?php
                    require_once('../../config/config.php');

                    if(array_key_exists('create_user_acount', $_POST))
                    {
                        $url = "create_user_account.php";
                        echo "<script type='text/javascript'>";
                        echo "window.location.href='$url'";
                        echo "</script>"; 
                    }



                    if(array_key_exists('search_user_acount', $_POST))
                    {
                        $phone_num = $_POST['phone_num'];

                        $sql = "SELECT  *
                                FROM  restaurants
                                WHERE phone_number = $phone_num";


                        $result = $conn->query($sql);
                        
                        if ($result->num_rows > 0) 
                        {
                            $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC );

                            $imageData = base64_encode($row['logo']);
                            $imageSrc = "data:image/jpeg;base64," . $imageData;

                            echo "
                            <thead>
                            <tr><th scope='col'>搜尋結果 : </th></tr>
                            <tr>
                            <th scope='col'>Restaurant ID</th>
                            <th scope='col'>名字</th>
                            <th scope='col'>密碼</th>
                            <th scope='col'>簡介</th>
                            <th scope='col'>LOGO</th>
                            <th></th>
                            <th scope='col'>地址</th>
                            <th scope='col'>電話</th>
                            <th scope='col'>評分</th>
                            <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>

                        <tr class='bg-blue'>
                            <td class='pt-3 mt-1'>" . $row['restaurant_id'] . "</td>
                            <td class='pt-3'>" . $row["name"] ."</td>
                            <td class='pt-3'>" . $row["passwd"] . "</td>
                            <td class='pt-3'>" . $row["description"] . "</td>
                            <td width='60px'>
                            <div class='imgBx'><img src='" . $imageSrc ."' alt=''></div>
                            </td>
                            <td></td>
                            <td class='pt-3'>" . $row["address"] . "</td>
                            <td class='pt-3'>" . $row["phone_number"] . "</td>
                            <td class='pt-3'>" . $row["rating"] . "</td>
                            <td class='pt-3'> <p align='center'><a href='modify_restaurant_info.php?restaurant_id=" . $row['restaurant_id']. "&address=". $row['address'] . "'>修改資訊</a><p></td>
                            <td class='pt-3'><a href='delete_restaurant_account.php?restaurant_id=" . $row['restaurant_id']."'><input type='submit' id='delete_user_account' value='刪除餐廳'></a></td>

                         </tr>
    
                        <tr id='spacing-row'>
                             <td></td>
                        </tr>

                        </tbody>
                        
                        
                        ";
                        }
                        else
                        {
                             echo "
                            <thead>
                                <tr><th scope='col'>搜尋結果 :</th></tr>
                                <tr>
                                <th scope='col'></th>
                                <th scope='col'></th>
                                <th scope='col'></th>
                                <th scope='col'>查無此餐廳 !!!</th>
                                </tr>
                            </thead>
                            <tbody>";
                        }


                        
                    }
                ?>


            </tbody>










            <thead>
                <tr><th scope='col'>全部餐廳 : </th></tr>
                <tr>
                    <th scope="col">Restaurant ID</th>
                    <th scope="col">名字</th>
                    <th scope="col">密碼</th>
                    <th scope="col">簡介</th>
                    <th scope="col">LOGO</th>
                    <th></th>
                    <th scope="col">地址</th>
                    <th scope="col">電話</th>
                    <th scope="col">評分</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <!-- php -->
                <?php
                    // 包含 config.php
                    require_once('../../config/config.php');

                    // 獲取當前用戶的 ID
                    $admin_id = $_SESSION['admin_id'];
                    //echo $restaurant_id;
        
                    // ******** update your personal settings ******** 
                    // 從資料庫中檢索當前存在之訂單

                    $sql = "SELECT * 
                            FROM restaurants";
                            

                    $result = $conn->query($sql);	// Send SQL Query

                    if ($result->num_rows > 0) {	
                        while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {

                            $imageData = base64_encode($row['logo']);
                            $imageSrc = "data:image/jpeg;base64," . $imageData;

                            echo "
                            <tr class='bg-blue'>
                                <td class='pt-3 mt-1'>" . $row['restaurant_id'] . "</td>
                                <td class='pt-3'>" . $row["name"] ."</td>
                                <td class='pt-3'>" . $row["passwd"] . "</td>
                                <td class='pt-3'>" . $row["description"] . "</td>
                                <td width='60px'>
                                <div class='imgBx'><img src='" . $imageSrc ."' alt=''></div>
                                </td>
                                <td></td>
                                <td class='pt-3'>" . $row["address"] . "</td>
                                <td class='pt-3'>" . $row["phone_number"] . "</td>
                                <td class='pt-3'>" . $row["rating"] . "</td>
                                <td class='pt-3'> <p align='center'><a href='modify_restaurant_info.php?restaurant_id=" . $row['restaurant_id']. "&address=". $row['address'] . "'>修改資訊</a><p></td>
                                <td class='pt-3'><a href='delete_restaurant_account.php?restaurant_id=" . $row['restaurant_id']."'><input type='submit' id='delete_user_account' value='刪除餐廳'></a></td>
                            </tr>
        
                            <tr id='spacing-row'>
                                 <td></td>
                            </tr>";
                                    
                        }


                        }
                    else {
                        // echo "No user found with ID $user_id.";
                        echo "<td colspan='7' style='text-align: center;'>尚未有訂單</td>";

                    }




                ?>

            </tbody>
        </table>
        <p align='center'><a href='dashboard.php'>返回主頁面</a><p>
    </div>
</div>
<script type='text/javascript'></script>
</body>
</html>