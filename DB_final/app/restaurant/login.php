<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // query the user table to check if the user exists
    // and verify the password
    require_once('../../config/config.php');
    
    // get the user input
    $phone_number = $_POST["phone_number"];
    $password = $_POST["passwd"];

    $stmt = $conn->prepare("SELECT * FROM restaurants WHERE phone_number = ?");
    $stmt->bind_param("s", $phone_number);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if ($password === $row["passwd"]) {
            // password is correct, login successful
            $_SESSION["restaurant_id"] = $row["restaurant_id"];
            header("Location: dashboard.php");
            // header("Location: menu_items.php?restaurant_id=" . $row['restaurant_id']);
            exit;
        } else {
            // password is incorrect, show error message
            $error_message = "Incorrect password";
            echo $error_message;
        }
    
    } else {
        // user not found, show error message
        // $error_message = "User not found";
        // echo $error_message;
        // 登入失敗時，執行以下 JavaScript 腳本
        echo '<script>';
        echo 'alert("登入失敗，請檢查您的帳號和密碼。");';
        echo '</script>';
    }
}

?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Resaurant Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="../../assets/css_custom/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="login-form-wrap">
  <h2>Resaurant Login</h2>
  <form id="login-form" action="login.php" method="post">
    <p>
    <input type="text" id="phone_number" name="phone_number" placeholder="886123456789" required>
    </p>
    <p>
    <input type="password" id="passwd" name="passwd" placeholder="password" required>
    </p>
    <p>
    <input type="submit" id="login" value="Login">
    </p>
  </form>
  <div id="create-account-wrap">
    <p>Not a member? <a href="register-restaurant.php">Create Account</a><p>
    <p><a href="../../index.php">返回首頁</a><p>
  </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
<!-- partial -->
  
</body>
</html>
