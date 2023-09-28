<?php
session_start();

// 取得計數器的值
$counter = $_SESSION['counter'];


// 清除所有的 session 變數
session_unset();

// 銷毀 session
session_destroy();


session_start();
if (!isset($_SESSION['counter'])) {
    $_SESSION['counter'] = 0;
}
$_SESSION['counter'] = $counter;

echo "<script>";
echo "alert('已登出');";
echo "setTimeout(function() { window.location.href = '../../index.php'; });";
echo "</script>";
?>