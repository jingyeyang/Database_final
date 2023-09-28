<?php

// ******** update your personal settings ******** 
require_once('../../config/config.php');

$item_id = $_GET['item_id'];
$restaurant_id = $_GET['restaurant_id'];

if (isset($item_id)) {
    $delete_sql = "DELETE FROM `menu_items` WHERE item_id='$item_id';"; // ******** update your personal settings ******** 

	if ($conn->query($delete_sql) === TRUE) {
        // echo "刪除成功!<a href='main.php'>返回主頁</a>";
        // 重定向用戶到下一頁
        echo "<script>";
        echo "alert('刪除成功');";
        echo "setTimeout(function() { window.location.href = '../restaurant/menu_items.php?restaurant_id=" . $restaurant_id . "'; }, 0);";
        echo "</script>";
        exit;
    }else{
        echo "<script>";
        echo "alert('刪除失敗');";
        echo "setTimeout(function() { window.location.href = '../restaurant/menu_items.php?restaurant_id=" . $restaurant_id . "'; }, 0);";
        echo "</script>";
        exit;
	}

}else{
	echo "資料不完全";
}
				
?>