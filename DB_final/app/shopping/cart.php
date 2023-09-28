<?php
	session_start();

	
	//判斷是否為登入，否則轉到登入註冊頁
	if(empty($_SESSION['user_id'])){
		header("location:login.php");
		exit();
	}
	
	// 檢查是否有購物車的 Session
	if (isset($_SESSION['cart'])) {
		$cart = $_SESSION['cart'];
	} else {
		$cart = []; // 初始化購物車為空陣列
	}

    // 檢查是否有接收到購物車參數
    if (isset($_GET['cart'])) {
        $serializedCart = $_GET['cart'];
        $cart = unserialize(urldecode($serializedCart));
        $_SESSION['cart'] = $cart; // 將購物車儲存在 Session 中
    }
	
?>


<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>購物車</title>
        <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
        <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
        <style>@import url('https://fonts.googleapis.com/css2?family=PT+Sans:wght@700&family=Poppins:wght@600&display=swap');

* {
    box-sizing: border-box
}

body {
    background-color: #d9ecf2;
    font-family: 'Poppins', sans-serif;
    color: #666
}

.h2 {
    color: #444;
    font-family: 'PT Sans', sans-serif
}

thead {
    font-family: 'Poppins', sans-serif;
    font-weight: bolder;
    font-size: 20px;
    color: #666
}

img {
    width: 40px;
    height: 40px
}

.name {
    display: inline-block
}

.bg-blue {
    background-color: #EBF5FB;
    border-radius: 8px
}

.fa-check,
.fa-minus {
    color: blue
}

.bg-blue:hover {
    background-color: #3e64ff;
    color: #eee;
    cursor: pointer
}

.bg-blue:hover .fa-check,
.bg-blue:hover .fa-minus {
    background-color: #3e64ff;
    color: #eee
}

.table thead th,
.table td {
    border: none
}

.table tbody td:first-child {
    border-bottom-left-radius: 10px;
    border-top-left-radius: 10px
}

.table tbody td:last-child {
    border-bottom-right-radius: 10px;
    border-top-right-radius: 10px
}

#spacing-row {
    height: 10px
}

.action-button {
    color: #000; /* 按鈕字的顏色 */
}

.button-container {
  display: flex;
}

.button-container .button {
  margin-right: 10px;
}

.button-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 10px;
}


@media(max-width:575px) {
    .container {
        width: 125%;
        padding: 20px 10px
    }
}</style>


<script type='text/javascript' src=''></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div class="container rounded mt-5 bg-white p-md-5">
    <div class="h2 font-weight-bold" align='center'>購物車內商品</div>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">餐廳名稱</th>
                    <th scope="col">商品名稱</th>
                    <th scope="col">價錢</th>
                    <th scope="col">數量</th>
                </tr>
            </thead>
            <tbody>

            <!-- php -->
            <?php

                echo "<form method='post' action='checkout.php'>";

                // 檢查是否有購物車的 Session
                if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {	
                    $totalAmount = 0; // 初始化總金額為0

                    // 取得購物車內的商品資料
                    $cartItems = $_SESSION['cart'];
                    
                    // 顯示購物車內所有商品
                    foreach ($cartItems as $item) {
                        echo "
                        <tr class='bg-blue'>
                            <td class='pt-3'>" . $item["item_id"] . "</td>
                            <input type='hidden' name='item_id[]' value='" . $item['item_id'] . "'>
                            <input type='hidden' name='user_id' value='" . $_SESSION['user_id'] . "'>

                            <td class='pt-3 mt-1'>" . $item['restaurant_name'] . "</td>
                            <input type='hidden' name='restaurant_name[]' value='" . $item['restaurant_name'] . "'>
                            <input type='hidden' name='restaurant_id[]' value='" . $item['restaurant_id'] . "'>

                            <td class='pt-3'>" . $item["name"] . "</td>
                            <input type='hidden' name='name[]' value='" . $item['name'] . "'>
                            
                            <td class='pt-3'>" . $item["price"] . "</td>
                            <input type='hidden' name='price[]' value='" . $item['price'] . "'>

                            <td></td><td class='pt-3'>" . $item["quantity"] . "</td>
                            <input type='hidden' name='quantity[]' value='" . $item['quantity'] . "' min='0'>
                        </tr>

                        <tr id='spacing-row'>
                            <td></td>
                        </tr>";
                        $subtotal = $item['price'] * $item['quantity'];
                        $totalAmount += $subtotal;
                    }
                    echo "<tr><td colspan='5' style='text-align: center;'>購物車總金額： $totalAmount 元</td></tr>";
                    echo "<input type='hidden' name='totalAmount' value='" . $totalAmount . "'>";
                }else {
                    echo "<tr><td colspan='6' style='text-align: center;'>尚未新增菜單</td></tr>";
                }

                echo "<!-- 結帳按鈕 -->
                <td colspan='7' style='text-align: center;'><button type='submit' name='submit_order'>結帳</button></td>";
                
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


		        ?>
            </tbody>
        </table>
            
    </div>
</div>
<script type='text/javascript'></script>
</body>
</html>