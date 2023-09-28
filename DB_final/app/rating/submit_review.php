<?php

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: app/user/login.php");
    exit;
}

// 連接資料庫並查詢用戶資訊
require_once('../../config/config.php');

// 獲取提交的評分和評論數據
$user_id = $_SESSION['user_id'];
$order_id = $_POST['order_id'];
$restaurant_id = $_POST['restaurant_id'];
$restaurant_rating = $_POST['restaurant_rating'];
$comment = $_POST['comment'];

// 獲取菜單項的評分和評論數據
$menu_item_ids = $_POST['menu_item_id'];
$menu_item_ratings = $_POST['menu_item_rating'];

// 執行插入評分和評論的 SQL 語句
// $insert_rating_sql = "INSERT INTO ratings (user_id,restaurant_id, order_id, rating, comment, created_at) 
//                       VALUES ('$user_id', '$restaurant_id', '$order_id', '$rating', '$comment', NOW())";

// 初始化變數
$insert_success = true;

foreach ($menu_item_ids as $key => $menu_item_id) {
    $menu_item_rating = $menu_item_ratings[$key];
    
    // 插入每個菜單項的評分和評論數據
    $insert_item_rating_sql = "INSERT INTO ratings (user_id,restaurant_id,menu_item_id,restaurant_rating, menu_item_rating, comment,created_at) 
                               VALUES ('$user_id', '$restaurant_id','$menu_item_id', '$restaurant_rating','$menu_item_rating','$comment', NOW())";

    if (!mysqli_query($conn, $insert_item_rating_sql)) {  
        $insert_success = false;
        break; // 中止迴圈
    }

}

if ($insert_success) {
    // 全部成功插入後，執行跳轉
    echo "<script>";
    echo "alert('評分和評論已提交成功，將返回首頁');";
    echo "setTimeout(function() { window.location.href = '../user/dashboard.php'; });";
    echo "</script>";
} else {
    echo "<script>";
    echo "alert('提交評分和評論時發生錯誤');";
    echo "</script>";
}



?>