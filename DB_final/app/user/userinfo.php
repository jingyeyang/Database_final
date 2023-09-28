<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: app/user/login.php");
  exit;
}

$user_id = $_SESSION['user_id'];

// 連接資料庫並查詢用戶資訊
require_once('../../config/config.php');

$sql = "SELECT * FROM users WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $first_name = $row['first_name'];
  $last_name = $row['last_name'];
  $email = $row['email'];
  $phone_number = $row['phone_number'];
  $delivery_address = $row['delivery_address'];
  $_SESSION['delivery_address'] = $delivery_address;
} else {
  echo "No user found with ID $user_id.";
  exit;
}

//update
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['phone_number']) && isset($_POST['delivery_address'])) {
	// 取得使用者輸入的值
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$phone_number = $_POST['phone_number'];
    $delivery_address = $_POST['delivery_address'];

	$update_sql = "UPDATE users SET first_name = '$first_name' , last_name = '$last_name' , email = '$email' , phone_number='$phone_number', delivery_address='$delivery_address'  WHERE user_id= $user_id;"; 
	
	if ($conn->query($update_sql) === TRUE) {
		// echo "修改成功!!<br> <a href='main.php'>返回主頁</a>";
		// 重定向用戶到下一頁
        echo '<script>';
        echo 'alert("資料已成功更新，按下確定後返回首頁");';
        echo 'setTimeout(function(){ window.location.href = "dashboard.php"; });';
        echo '</script>';
	} else {
		echo "<h2 align='center'><font color='antiquewith'>修改失敗!!</font></h2>";
	}

}



// mysqli_close($conn);
?>

<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>User Info</title>
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
    <div class="h2 font-weight-bold">會員資料</div>
    <div class="table-responsive">
        <table class="table">
            <form id="userinfo-form" action="userinfo.php" method="post">
                <tbody>
                    <tr class="bg-blue">
                        <th><strong>First_name</strong></th>
                        <td class="pt-1">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                            <input type="text" id="first_name" name="first_name" value=<?php echo $first_name; ?>>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>

                    <tr class="bg-blue">
                        <th><strong>Last_name</strong></th>
                        <td class="pt-2">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                            <input type="text" id="last_name" name="last_name" value=<?php echo $last_name; ?>>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>

                    <tr class="bg-blue">
                        <th><strong>Email</strong></th>
                        <td class="pt-3">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                                <input type="email" id="email" name="email" value= <?php echo $email; ?> readonly>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>


                    <tr class="bg-blue">
                        <th><strong>Phone Number</strong></th>
                        <td class="pt-4">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                                <input type="text" id="phone_number" name="phone_number" value= <?php echo $phone_number; ?>>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>

                    <tr class="bg-blue">
                        <th><strong>Delivery Address</strong></th>
                        <td class="pt-6">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                                <input type="text" id="delivery_address" name="delivery_address" value= <?php echo $delivery_address; ?>>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>

                    
                    <tr id="spacing-row">
                        <td>
                            
                        <td>
                    </tr>
                    <tr>
                        <td class="pt-6">
                        <input type="submit" id="update" value="update">
                        <a href="dashboard.php"><input type="button" id="backindex" value="返回首頁"></td></a>
                        </td>
                    </tr>

                </tbody>
            </form>
        </table>
    </div>
</div>
<script type='text/javascript'></script>
</body>
</html>