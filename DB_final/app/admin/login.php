<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // query the user table to check if the user exists
    // and verify the password
    require_once('../../config/config.php');
    
    // get the user input
    $Employee_ID = $_POST["Employee_ID"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admin WHERE ssn=?");
    $stmt->bind_param("s", $Employee_ID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // while ($row = $result->fetch_assoc()) {
    //     echo "email: " . $row["email"] . "<br>";
    //     echo "passwd: " . $row["password"] . "<br>";
    // };

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

    
        if ($password === $row["password"]) {
            // password is correct, login successful
            $_SESSION["admin_id"] = $row["ssn"];
            $_SESSION["Employee_ID"] = $row["Employee_ID"];
            header("Location: dashboard.php");
            echo "OK";
            exit;
        } else {
            // password is incorrect, show error message
            //$error_message = "Incorrect password";
            //echo $error_message;
            echo '<script>alert("登入失敗，密碼錯誤。");</script>';
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
  <title>User Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="../../assets/css_custom/style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div id="login-form-wrap">
  <h2>Admins Login</h2>
  <form id="login-form" action="login.php" method="post">
    <p>
    <input type="text" id="Employee_ID" name="Employee_ID" placeholder="Employee ID" required>
    </p>
    <p>
    <input type="password" id="password" name="password" placeholder="password" required>
    </p>
    <p>
    <input type="submit" id="login" value="Login">
    </p>
  </form>
  <div id="create-account-wrap">
    <p><a href="../../index.php">返回首頁</a><p>
  </div><!--create-account-wrap-->
</div><!--login-form-wrap-->
<!-- partial -->
  
</body>
</html>
