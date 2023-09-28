<?php

// ******** update your personal settings ******** 

require_once('../../config/config.php');

$restaurant_id = $_POST['restaurant_id'];

if (isset($_POST['restaurant_id']) && isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])) {
	// 取得使用者輸入的值
	$restaurant_id = $_POST['restaurant_id'];
	$name = $_POST['name'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	

	$insert_sql = "INSERT INTO menu_items (restaurant_id,name, description, price)
					VALUES ($restaurant_id,'$name', '$description', '$price')";
	
	if ($conn->query($insert_sql) === TRUE) {
		// echo "新增成功!!<br> <a href='main.php'>返回主頁</a>";
		// 重定向用戶到下一頁
		header("Location: ../restaurant/menu_items.php?restaurant_id=" . $restaurant_id);
		exit;
	} else {
		echo "<h2 align='center'><font color='antiquewith'>新增失敗!!</font></h2>";
	}

}else{
	echo "資料不完全";
}
				
?>

