<?php
    session_start(); // 開始 Session
    if (!isset($_SESSION['admin_id'])) {
        header("Location: login.php");
        exit;
    }
    //echo $_GET['user_id'];
    //echo $_SESSION['admin_id'];

    $user_id = $_GET['user_id'];

    require_once('../../config/config.php');

    $delete_sql = "DELETE
            FROM users
            WHERE user_id = $user_id";


    if(isset($_POST['admin_id']))
    {
        if($_POST['admin_id'] ===  $_SESSION['admin_id'])
        {
            if ($conn->query($delete_sql) === TRUE) {
                // echo "修改成功!!<br> <a href='main.php'>返回主頁</a>";
                // 重定向用戶到下一頁
                echo '<script>';
                echo 'alert("資料已成功刪除，按下確定後返回首頁");';
                echo 'setTimeout(function(){ window.location.href = "user_info.php"; });';
                echo '</script>';
            } else {
                echo "<h2 align='center'><font color='antiquewith'>修改失敗!!</font></h2>";
            }
        }
        else
        {
            echo '<script>';
            echo 'alert("ADMIN 帳號輸入錯誤請確認是否真的要刪除");';
            echo 'setTimeout(function(){ window.location.href = "user_info.php"; });';
            echo '</script>';
        }
    }


?>


<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>User Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="../../assets/css_custom/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="login-form-wrap">
  <h2>刪除用戶資訊確認</h2>
  <form id="login-form" action="delete_user_account.php?user_id= <?php echo $user_id; ?>" method="post">
    <p>
    <input type="text" id="admin_id" name="admin_id" placeholder="Admin ID" required>
    </p>
    <p>
    <input type="submit" id="confirm" value="confirm">
    </p>
  </form>
  <div id="create-account-wrap">
    <p><a href="user_info.php">取消</a><p>
  </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
<!-- partial -->



  
</body>
</html>