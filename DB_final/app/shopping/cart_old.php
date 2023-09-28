<?php


session_start(); // 開始 Session

// 檢查是否有購物車的 Session
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
} else {
    $cart = []; // 初始化購物車為空陣列
};

// 檢查是否有接收到購物車參數
if (isset($_GET['cart'])) {
    $serializedCart = $_GET['cart'];
    $cart = unserialize(urldecode($serializedCart));
    $_SESSION['cart'] = $cart; // 將購物車儲存在 Session 中
}


echo "<h1 align='center'>購物車內商品</h1>";

echo "<form method='post' action='checkout.php' >";
echo "<table style='width:50%' align='center'>
		<tr><th>id</th><th>餐廳名稱</th><th>商品名稱</th><th>價錢</th><th>數量</th></tr>";

// 檢查是否有購物車的 Session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {

    $totalAmount = 0; // 初始化總金額為0

    // 取得購物車內的商品資料
    $cartItems = $_SESSION['cart'];
    
    // 顯示購物車內所有商品
    

    foreach ($cartItems as $item) {
        // echo "商品編號：" . $item['item_id'] . "<br>";
        echo "<tr>";
        echo "<td>" . $item['item_id'] . "</td>";
        echo "<input type='hidden' name='item_id[]' value='" . $item['item_id'] . "'>";
        echo "<input type='hidden' name='user_id' value='" . $_SESSION['user_id'] . "'>";
        
        echo "<td>" . $item["restaurant_name"] . "</td>";
        echo "<input type='hidden' name='restaurant_name[]' value='" . $item['restaurant_name'] . "'>";
        echo "<input type='hidden' name='restaurant_id[]' value='" . $item['restaurant_id'] . "'>";
        
        echo "<td>" . $item["name"] . "</td>";
        echo "<input type='hidden' name='name[]' value='" . $item['name'] . "'>";
        
        echo "<td>" . $item["price"] . "</td>";
        echo "<input type='hidden' name='price[]' value='" . $item['price'] . "'>";

        echo "<td>" . $item['quantity'] ."</td>";
        echo "<input type='hidden' name='quantity[]' value='" . $item['quantity'] . "'>";

        echo "</tr>";
        // echo "餐廳名稱：" . $item['restaurant_name'] . "<br>";
        // echo "商品名稱：" . $item['name'] . "<br>";
        // echo "價錢" . $item['price'] . "<br>";
        // echo "數量：" . $item['quantity'] . "<br><br>";
        $subtotal = $item['price'] * $item['quantity'];
        $totalAmount += $subtotal;
    }
    // echo "購物車總金額：" . $totalAmount . "元";
    echo "<tr><td colspan='5' style='text-align: center;'>購物車總金額： $totalAmount 元</td></tr>";
    echo "<input type='hidden' name='totalAmount' value='" . $totalAmount . "'>";
} else {
    echo "<tr><td colspan='6' style='text-align: center;'>尚未新增菜單</td></tr>";
}



echo "</table>";

echo "<!-- 結帳按鈕 -->
<button style='text-align: center;' type='submit' name='submit_order'>結帳</button>";

echo "</form>";

$restaurant_id = $_SESSION['restaurant_id'];


// <!-- 提交按鈕 -->
echo "
<div style='text-align: center;'>
    <form method='post' action='clear-cart.php' >
        <button type='submit' name='clear_cart'>清空購物車</button>
        <a href='../user/restaurants.php'><button type='button'>回到餐廳列表</button></a>
        <a href='../user/menu_items.php?restaurant_id=" . $restaurant_id . "'><button type='button' name='goBack'>返回上一頁</button></a>
    </form>
</div>
";


// echo "
//     <form style='text-align: center;' method='post'>
//         <div>
//         <button type='submit' formaction='clear-cart.php'>清空購物車</button>
//         <a href='restaurants.php'><button type='button'>回到餐廳列表</button></a>
//         <a href='menu_items.php?restaurant_id=" . $restaurant_id . "'><button type='button' name='goBack'>返回上一頁</button></a>
//         <button type='submit' formaction='checkout.php' submit_order>結帳</button>
//         </div>
//     </form>
// ";

?>


<style>
	table, th, td {
	border: 1px solid black;
	border-collapse: collapse;
	}
	th, td {
	padding: 5px;
	text-align: left;    
	}
</style>