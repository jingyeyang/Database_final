<?php

require_once('../../config/config.php');

if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])) {
	// 取得使用者輸入的值
	$name = $_POST['name'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$item_id = $_POST['item_id'];

	$update_sql = "UPDATE menu_items SET name = '$name' , description = '$description' , price = $price   WHERE item_id= $item_id";	// ******** update your personal settings ******** 
	
	if ($conn->query($update_sql) === TRUE) {
		// echo "修改成功!!<br> <a href='main.php'>返回主頁</a>";
		// 重定向用戶到下一頁

		$stmt = $conn->prepare("SELECT restaurant_id FROM menu_items WHERE item_id=?");
		$stmt->bind_param("s", $item_id);
		$stmt->execute();
		$result = $stmt->get_result();
		
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();

			echo "<script>";
			echo "alert('更新成功');";
			echo "setTimeout(function() { window.location.href = '../restaurant/menu_items.php?restaurant_id=" . $row["restaurant_id"] . "'; }, 0);";
			echo "</script>";
			exit;
		} else{
			echo "<script>";
			echo "alert('更新失敗，找不到餐廳ID');";
			echo "setTimeout(function() { window.location.href = '../restaurant/menu_items.php?restaurant_id=" . $row["restaurant_id"] . "'; }, 0);";
			echo "</script>";
			exit;
		}
		

	} else {
		echo "<h2 align='center'><font color='antiquewith'>修改失敗!!</font></h2>";
	}

}else{
	echo "資料不完全";
}
				
?>