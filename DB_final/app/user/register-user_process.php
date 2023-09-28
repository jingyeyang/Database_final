<?php

// ******** update your personal settings ******** 

require_once('../../config/config.php');

if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['phone_number']) && isset($_POST['delivery_address'])) {
	// 取得使用者輸入的值
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$phone_number = $_POST['phone_number'];
	$delivery_address = $_POST['delivery_address'];

	$hashed_password = password_hash($password, PASSWORD_DEFAULT);

	
	$stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

	// Validate password strength
	$uppercase = preg_match('@[A-Z]@', $password);
	$lowercase = preg_match('@[a-z]@', $password);
	$number    = preg_match('@[0-9]@', $password);
	$specialChars = preg_match('@[^\w]@', $password);


	// Validate phone number
	$phone_num = preg_match('@[0-9]@', $phone_number);



	if ($result->num_rows == 1) {
		//echo "value already exists, do not insert";
		echo "<script>alert('account has already exists, please create another one.'); 
		window.location.href = 'register-user.php';</script>";
		exit;
		
	} 
	elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8)
	{
		//echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
		echo "<script>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.'); 
		window.location.href = 'register-user.php';</script>";
		exit;
	}
	elseif(!$phone_num)
	{
		echo "<script>alert('wrong construct of the phone number, please check'); 
		window.location.href = 'register-user.php';</script>";
		exit;
	}
	else {
		$insert_sql = "INSERT INTO users (first_name, last_name, email, password, phone_number, delivery_address)
						VALUES ('$first_name', '$last_name', '$email', '$password', '$phone_number', '$delivery_address')";


		if ($conn->query($insert_sql) === TRUE) {
			// 重定向用戶到下一頁
			echo "<script>alert('註冊成功!'); 
				window.location.href = 'login.php';</script>";
			exit;
		} else {
			echo "<script>alert('註冊失敗!'); 
				window.location.href = 'login.php';</script>";
			exit;
		}
	}

}else{
	echo "<script>alert('資料不完整，註冊失敗!'); 
				window.location.href = 'login.php';</script>";
	exit;
}
				
?>

