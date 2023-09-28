<?php
	session_start();

	//判斷是否有選購商品
	// if(!empty($_GET['item'])){
	// 	$_SESSION['item'][$_GET['item']]=$_GET['qt'];
	// }
	
	//判斷是否為登入，否則轉到登入註冊頁
	if(empty($_SESSION['user_id'])){
		header("location:login.php");
		exit();
	}
	
	// 檢查是否有購物車的 Session
	if (isset($_SESSION['cart'])) {
		// $_SESSION['cart'] = [];
		$cart = $_SESSION['cart'];
	} else {
		$cart = []; // 初始化購物車為空陣列
	}
	// 檢查是否存在購物車，如果不存在則初始化
	// if (!isset($_SESSION['cart'])) {
	// 	$_SESSION['cart'] = array();
	// }
?>


<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>菜單列表</title>
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


<!-- 加入購物車後跳出alert -->
<script>
function addToCart() {
  // 顯示提示訊息
  alert("已經加入購物車");
}
</script>

<script type='text/javascript' src=''></script>
<script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
<script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
</head>
<body oncontextmenu='return false' class='snippet-body'>
<div class="container rounded mt-5 bg-white p-md-5">
    <div class="h2 font-weight-bold" align='center'>菜單列表</div>

    <?php
		$restaurant_id = $_GET['restaurant_id'];
		$_SESSION['restaurant_id'] = $restaurant_id;
	?>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">餐廳名稱</th>
                    <th scope="col">商品名稱</th>
                    <th scope="col">描述</th>
                    <th scope="col">價錢</th>
                    <th scope="col">數量</th>
                </tr>
            </thead>
            <tbody>

            <!-- php -->
            <?php
                // 包含 config.php
                require_once('../../config/config.php');

                // ******** update your personal settings ******** 
                $sql = "SELECT menu_items.item_id, menu_items.name, menu_items.description, menu_items.price, restaurants.name AS restaurant_name 
                FROM menu_items 
                INNER JOIN restaurants ON menu_items.restaurant_id = restaurants.restaurant_id WHERE menu_items.restaurant_id = '$restaurant_id'";	// set up your sql query
                $result = $conn->query($sql);	// Send SQL Query

                echo "<form method='post'>";

                if ($result->num_rows > 0) {	
                    while ( $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC ) ) {
                        // echo "<tr>";
                        // echo "<td>" . $row["restaurant_id"] . "</td>";
                        // echo "<td>" . $row["name"] . "</td>";
                        // echo "<td>" . $row["description"] . "</td>";
                        // echo "<td>" . $row["address"] . "</td>";
                        // echo "<td>" . $row["phone_number"] . "</td>";
                        // echo "<td>" . $row["rating"] . "</td>";
                        // echo "<td><a href='menu_items.php?restaurant_id=" . $row['restaurant_id'] . "'>查看</a></td>";
                        
                        echo "
                        <tr class='bg-blue'>
                            <td class='pt-3'>" . $row["item_id"] . "</td>
                            <input type='hidden' name='item_id[" . $row['item_id'] ."]' value='" . $row['item_id'] . "'>

                            <td class='pt-3 mt-1'>" . $row['restaurant_name'] . "</td>
                            <input type='hidden' name='restaurant_name[" . $row['item_id'] ."]' value='" . $row['restaurant_name'] . "'>
                            <input type='hidden' name='restaurant_id[" . $row['item_id'] ."]' value='" . $restaurant_id . "'>

                            <td class='pt-3'>" . $row["name"] . "</td>
                            <input type='hidden' name='name[" . $row['item_id'] ."]' value='" . $row['name'] . "'>

                            <td class='pt-3'>" . $row["description"] . "</td>
                            
                            <td class='pt-3'>" . $row["price"] . "</td>
                            <input type='hidden' name='price[" . $row['item_id'] ."]' value='" . $row['price'] . "'>

                            <td><input type='number' name='quantity[" . $row['item_id'] ."]' value='0' min='0'></td>
                            
                        </tr>

                        <tr id='spacing-row'>
                            <td></td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align: center;'>尚未新增菜單</td></tr>";
                }
                echo "<td colspan='7' style='text-align: center;'><button type='submit' name='add_to_cart' onclick='addToCart()'>加入購物車</button></td>";
                echo "</form>";

                

                // 檢查是否有加入購物車的請求
                if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add_to_cart'])) {
                    // 檢查必要的資料是否存在
                    if (isset($_POST['item_id']) && isset($_POST['restaurant_name']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['quantity'])) {
                        // 取得表單資料
                        $item_ids = $_POST['item_id'];
                        $restaurant_names = $_POST['restaurant_name'];
                        $restaurant_id = $restaurant_id;
                        $names = $_POST['name'];
                        $prices = $_POST['price'];
                        $quantities = $_POST['quantity'];
                        
                        // 使用迴圈處理每個菜單的數量
                        foreach ($quantities as $itemId => $quantity) {
                            // 在這裡處理將商品資訊存入購物車的相關邏輯
                            if ($quantity > 0){
                                // echo "商品編號: " . $itemId . ", 數量: " . $quantity . "<br>";
                                $item = [
                                    'item_id' => $item_ids[$itemId],
                                    'restaurant_name' => $restaurant_names[$itemId],
                                    'restaurant_id' => $restaurant_id,
                                    'name' => $names[$itemId],
                                    'price' => $prices[$itemId],
                                    'quantity' => $quantities[$itemId]
                                ];
                    
                                $cart[] = $item;
                                
                                $_SESSION['cart'] = $cart;
                            };
                        }
                    }else{
                        echo "NO";
                    }
                }

		        ?>
            </tbody>
        </table>
        
        <!-- 結帳按鈕 -->
        <div style="display: flex; justify-content: center;">
            <div style="margin-right: 10px;">
                <p align='center'><a href="../shopping/cart.php?cart=<?php echo urlencode(serialize($cart)); ?>&session_id=<?php echo session_id(); ?>">查看購物車</a></p>
                
            </div>
            <div style="margin-right: 10px;">
                <p align='center'><a href='restaurants.php'>返回餐廳列表</a></p>
            </div>
            
            <div style="margin-right: 10px;">
                <p align='center'><a href='dashboard.php'>返回首頁</a></p>
            </div>
        </div>
            
    </div>
</div>
<script type='text/javascript'></script>
</body>
</html>