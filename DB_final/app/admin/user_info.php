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
        <title>ADMIN使用者資訊</title>
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
    <div class="h2 font-weight-bold" align='center'>使用者資訊</div>
    <div class="table-responsive">
        <table class="table">

            <thead>
                <tr>
                    <th scope="col">操作</th>
                    <th></th>
                    <th scope="col">搜尋</th>
    
   

                </tr>
                <tr>
                    <form action = "" method = "post" class = "form">
                    <th><input type="submit" name = "create_user_acount" value="建立新帳號"></th>
                    <th></th>
                    </form>

                    <form action = "" method = "post" class = "form">
                    <th> 帳號 : <input type="text" name = "search_eamil" size="13"></th>
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
                        $email = $_POST['search_eamil'];
                    

                        $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
                        $stmt->bind_param("s", $email);
                        $stmt->execute();
                        $result = $stmt->get_result();


                        if ($result->num_rows > 0) 
                        {
                            $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC );

                            

                            echo "
                            <thead>
                            <tr><th scope='col'>搜尋結果 : </th></tr>
                            <tr>
                                <th scope='col'>User ID</th>
                                <th scope='col'>名字</th>
                                <th scope='col'>帳號</th>
                                <th scope='col'>密碼</th>
                                <th scope='col'>電話</th>
                                <th scope='col'>地址</th>
                                <th scope='col'></th>
                            </tr>
                        </thead>
                        <tbody>

                        <tr class='bg-blue'>
                            <td class='pt-3 mt-1'>" . $row['user_id'] . "</td>
                            <td class='pt-3'>" . $row["first_name"] ." ". $row["last_name"] . "</td>
                            <td class='pt-3'>" . $row["email"] . "</td>
                            <td class='pt-3'>" . $row["password"] . "</td>
                            <td class='pt-3'>" . $row["phone_number"] . "</td>
                            <td class='pt-3'>" . $row["delivery_address"] . "</td>
                            <td class='pt-3'> <p align='center'><a href='modify_user_info.php?user_id=" . $row['user_id']. "&delivery_address=". $row['delivery_address'] . "'>修改資訊</a><p></td>
                            <td class='pt-3'><a href='delete_user_account.php?user_id=" . $row['user_id']."'><input type='submit' id='delete_user_account' value='刪除使用者資訊'></a></td>

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
                                <th scope='col'>查無此用戶 !!!</th>
                                </tr>
                            </thead>
                            <tbody>";
                        }


                        
                    }
                ?>


            </tbody>



            <thead>
                <tr><th scope='col'>全部使用者 : </th></tr>
                <tr>
                    <th scope="col">User ID</th>
                    <th scope="col">名字</th>
                    <th scope="col">帳號</th>
                    <th scope="col">密碼</th>
                    <th scope="col">電話</th>
                    <th scope="col">地址</th>
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
                            FROM users";
                            

                    $result = $conn->query($sql);	// Send SQL Query

                    if ($result->num_rows > 0) {	
                        while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {

                            
                            //$_SESSION['user_id'] = $row['user_id'];
                            echo "
                            <tr class='bg-blue'>
                                <td class='pt-3 mt-1'>" . $row['user_id'] . "</td>
                                <td class='pt-3'>" . $row["first_name"] ." ". $row["last_name"] . "</td>
                                <td class='pt-3'>" . $row["email"] . "</td>
                                <td class='pt-3'>" . $row["password"] . "</td>
                                <td class='pt-3'>" . $row["phone_number"] . "</td>
                                <td class='pt-3'>" . $row["delivery_address"] . "</td>
                                <td class='pt-3'> <p align='center'><a href='modify_user_info.php?user_id=" . $row['user_id']. "&delivery_address=". $row['delivery_address'] . "'>修改資訊</a><p></td>
                                <td class='pt-3'><a href='delete_user_account.php?user_id=" . $row['user_id']."'><input type='submit' id='delete_user_account' value='刪除使用者資訊'></a></td>

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