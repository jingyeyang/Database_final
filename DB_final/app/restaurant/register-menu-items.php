<?php
	session_start();

	//判斷是否有選購商品
	// if(!empty($_GET['item'])){
	// 	$_SESSION['item'][$_GET['item']]=$_GET['qt'];
	// }
	
	//判斷是否為登入，否則轉到登入註冊頁
	if(empty($_SESSION['restaurant_id'])){
		header("location:login.php");
		exit();
	}
?>


<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>新增菜單</title>
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
    <div class="h2 font-weight-bold" align='center'>新增菜單</div>

    <?php
		$restaurant_id = $_GET['restaurant_id'];
		$_SESSION['restaurant_id'] = $restaurant_id;
	?>

    <div class="table-responsive">
    <form action="../menu-items/register-menu-items.php" method="post" enctype="multipart/form-data">	

        <table class="table">
            <thead>
                <tr>
                    <!-- <th scope="col">商品ID</th> -->
                    <th scope="col">商品名稱</th>
                    <th scope="col">描述</th>
                    <th scope="col">價錢</th>
                </tr>
            </thead>
            <tbody>
                <tr class='bg-blue'>
                    
                    <!-- <td class='pt-3'>預設</td> -->
                    <input type='hidden' name='restaurant_id' value="<?php echo $restaurant_id; ?>">

                    <td class='pt-3'><input type='text' id="name"  name='name' required></td>
                    
                    <td class='pt-3'><input type='text' id="description" name='description' required></td>

                    
                    <td class='pt-3'><input type='text' id="price" name='price' required></td>
                    
                    
                </tr>

                <tr id='spacing-row'>
                    <td></td>
                </tr>
            <!-- php -->
            <?php

                echo "<form method='post'>";

                echo "<td colspan='7' style='text-align: center;'><button type='submit'>建立菜單</button></td>";
                echo "</form>";

		        ?>


            </tbody>
        </table>
    </form>
        <p align='center'>
            <a href="menu_items.php?restaurant_id=<?php echo $restaurant_id; ?>">
                <button type='button' name='goBack'>返回菜單管理</button>
            </a>
        </p>
            
    </div>
</div>
<script type='text/javascript'></script>
</body>
</html>