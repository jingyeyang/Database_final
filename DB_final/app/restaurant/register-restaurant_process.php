<?php

// ******** update your personal settings ******** 

require_once('../../config/config.php');

if (isset($_POST['name']) && isset($_POST['passwd']) && isset($_POST['description']) && isset($_POST['address']) && isset($_POST['phone_number'])) {
	// 取得使用者輸入的值
	$name = $_POST['name'];
	$passwd = $_POST['passwd'];
	$description = $_POST['description'];
	$address = $_POST['address'];
	$phone_number = $_POST['phone_number'];

	# process logo
	$file_name = $_FILES['logo']['name'];
    $file_size =$_FILES['logo']['size'];
    $file_tmp =$_FILES['logo']['tmp_name'];
    $file_type=$_FILES['logo']['type'];

    // 將文件數據讀入到一個變量中
    $fp = fopen($file_tmp, 'r');
    $file_data = fread($fp, filesize($file_tmp));
    $file_data = addslashes($file_data);
    fclose($fp);


	$stmt = $conn->prepare("SELECT * FROM restaurants WHERE phone_number=?");
    $stmt->bind_param("s", $phone_number);
    $stmt->execute();
    $result = $stmt->get_result();



	// Validate password strength
	$uppercase = preg_match('@[A-Z]@', $passwd);
	$lowercase = preg_match('@[a-z]@', $passwd);
	$number    = preg_match('@[0-9]@', $passwd);
	$specialChars = preg_match('@[^\w]@', $passwd);


	// Validate phone number
	$phone_num = preg_match('@[0-9]@', $phone_number);
	

	$insert_sql = "INSERT INTO restaurants (name,passwd, description, address, logo, phone_number)
					VALUES ('$name', '$passwd' , '$description', '$address', '$file_data', '$phone_number')";
	
	if ($result->num_rows == 1) {
		//echo "value already exists, do not insert";
		echo "<script>alert('account has already exists, please create another one.'); 
		window.location.href = 'register-restaurant.php';</script>";
		exit;
		
	} 
	elseif(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($passwd) < 8)
	{
		//echo 'Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.';
		echo "<script>alert('Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.'); 
		window.location.href = 'register-restaurant.php';</script>";
		exit;
	}
	elseif(!$phone_num)
	{
		echo "<script>alert('wrong construct of the phone number, please check'); 
		window.location.href = 'register-restaurant.php';</script>";
		exit;
	}
	elseif ($conn->query($insert_sql) === TRUE) {
		// 重定向用戶到下一頁
		echo "<script>alert('新增餐廳成功!'); 
			window.location.href = 'login.php';</script>";
    	exit;
	} else {
		echo "<script>alert('新增餐廳失敗!'); 
			window.location.href = 'login.php';</script>";
    	exit;
	}

}else{
	echo "<script>alert('新增餐廳失敗!'); 
			window.location.href = 'login.php';</script>";
	exit;
}
				
?>

