<?php
// 其他處理邏輯...

// 若購物車為空，無法進行結帳
if (empty($_SESSION['cart'])) {
    // 使用 JavaScript 顯示錯誤訊息的 alert
    echo "<script>
        alert('購物車為空，無法進行結帳。即將跳轉回餐廳列表');
        setTimeout(function() {
            window.location.href = '../user/restaurants.php';
        });
    </script>";
    // 結束腳本執行
    exit();
}
?>