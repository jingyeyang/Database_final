<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>修改菜單資料</title>
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
    <div class="h2 font-weight-bold" align='center'>修改菜單資料</div>

    <form action="doupdate.php" method="post">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">商品ID</th>
                    <th scope="col">餐廳名稱</th>
                    <th scope="col">商品名稱</th>
                    <th scope="col">描述</th>
                    <th scope="col">價錢</th>
                </tr>
            </thead>
            <tbody>

            <!-- php -->
            <?php
                // 包含 config.php
                require_once('../../config/config.php');

                $item_id = $_GET['item_id'];
			    $restaurant_name = urldecode($_GET['restaurant_name']);

                if (isset($item_id)){

                    $select_sql = "SELECT * FROM `menu_items` WHERE item_id='$item_id';"; // ******** update your personal settings ******** 
				    $result = $conn->query($select_sql);

                    if ($result->num_rows > 0) {	
                        $row = mysqli_fetch_array ( $result, MYSQLI_ASSOC );
                        echo "
                        <tr class='bg-blue'>
                            <td class='pt-3'>" . $item_id . "</td>
                            <input type='hidden' name='item_id' value='" . $item_id . "'>

                            <td class='pt-3 mt-1'>" . $restaurant_name . "</td>
                            <input type='hidden' name='restaurant_name' value='" . $restaurant_name . "'>

                            <td class='pt-3'><input type='text' name='name' value='" . $row['name'] . "'></td>

                            <td class='pt-3'><input type='text' name='description' value='" . $row['description'] . "'></td>
                            
                            <td class='pt-3'><input type='text' name='price' value='" . $row['price'] . "'></td>
                            
                            
                        </tr>

                        <tr id='spacing-row'>
                            <td></td>
                        </tr>";
                        
                    } else {
                        echo "<tr><td colspan='6' style='text-align: center;'>尚未新增菜單</td></tr>";
                    }
                }else{
                    echo "資料不完全";
                }

                

                
                echo "<td colspan='7' style='text-align: center;'><button type='submit' >更新</button></td>";

		        ?>
            </tbody>
        </table>
        
        <p align='center'><a href='../restaurant/dashboard.php'>返回首頁</a><p>
            
    </div>
    </form>
</div>
<script type='text/javascript'></script>
</body>
</html>