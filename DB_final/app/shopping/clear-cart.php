<?php
// clear-cart.php
session_start(); // 確保在存取 $_SESSION 之前啟用 session

// 檢查是否按下清空購物車按鈕
if (isset($_POST['clear_cart'])) {
    // 清空購物車
    unset($_SESSION['cart']);
}
else{
    echo"anything wrong";
}


// 導向回購物車頁面或其他頁面
header('Location: ../user/restaurants.php');
exit();
?>