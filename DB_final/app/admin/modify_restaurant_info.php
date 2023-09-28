<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
  header("Location: login.php");
  exit;
}

//$restaurant_id = $_SESSION['restaurant_id'];

$restaurant_id = $_GET['restaurant_id'];
$address = $_GET['address'];

// 連接資料庫並查詢用戶資訊
require_once('../../config/config.php');

$sql = "SELECT * FROM restaurants WHERE restaurant_id = '$restaurant_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $description = $row['description'];
  $logo = $row['logo'];
  // 將 BLOB 轉換為可用於顯示的格式，例如圖片
  $imageData = base64_encode($logo);
  $imageSrc = "data:image/jpeg;base64," . $imageData;

  $address = $row['address'];
  $phone_number = $row['phone_number'];
  $rating = $row['rating'];
} else {
  echo "No user found with ID $restaurant_id.";
  exit;
}

//update
if (isset($_POST['name']) && isset($_POST['description']) && isset($_POST['address']) && isset($_POST['phone_number']) && isset($_POST['rating']) ) {
	// 取得使用者輸入的值
	$name = $_POST['name'];
	$description = $_POST['description'];
	$address = $_POST['address'];
	$phone_number = $_POST['phone_number'];
    $rating = $_POST['rating'];

    if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] === UPLOAD_ERR_OK){
        # process logo
        $file_name = $_FILES['logo']['name'];
        $file_size =$_FILES['logo']['size'];
        $file_tmp =$_FILES['logo']['tmp_name'];
        $file_type=$_FILES['logo']['type'];

        // $fileContent = file_get_contents($file_tmp);

        // 將文件數據讀入到一個變量中
        $fp = fopen($file_tmp, 'r');
        $file_data = fread($fp, filesize($file_tmp));
        $file_data = addslashes($file_data);
        fclose($fp);
        $update_sql = "UPDATE restaurants SET name = '$name' , logo = '$file_data',  description = '$description' , 
                    address = '$address' , phone_number='$phone_number', 
                    rating='$rating'  WHERE restaurant_id= $restaurant_id;"; 
	
        if ($conn->query($update_sql) === TRUE) {
            // echo "修改成功!!<br> <a href='main.php'>返回主頁</a>";
            // 重定向用戶到下一頁
            echo '<script>';
            echo 'alert("資料已成功更新，按下確定後返回首頁");';
            echo 'setTimeout(function(){ window.location.href = "restaurant_info.php"; });';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("資料更新失敗，按下確定後返回");';
            echo 'setTimeout(function(){ window.location.href = "restaurant_info.php"; });';
            echo '</script>';
        }

    }else{
        $update_sql = "UPDATE restaurants SET name = '$name' ,  description = '$description' , 
                    address = '$address' , phone_number='$phone_number', 
                    rating='$rating'  WHERE restaurant_id= $restaurant_id;"; 
	
        if ($conn->query($update_sql) === TRUE) {
            // echo "修改成功!!<br> <a href='main.php'>返回主頁</a>";
            // 重定向用戶到下一頁
            echo '<script>';
            echo 'alert("除logo外，資料已成功更新，按下確定後返回首頁");';
            echo 'setTimeout(function(){ window.location.href = "restaurant_info.php"; });';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("除logo外，資料更新失敗，按下確定後返回##");';
            echo 'setTimeout(function(){ window.location.href = "restaurant_info.php"; });';
            echo '</script>';
        }
    }
    


	
}



// mysqli_close($conn);
?>

<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Restaurant Info</title>
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
    <div class="h2 font-weight-bold">餐廳資料</div>
    <div class="table-responsive">
        <table class="table">
            <form id="userinfo-form" action="modify_restaurant_info.php?restaurant_id= <?php echo $restaurant_id; ?> &address= <?php echo $address; ?>" method="post" enctype="multipart/form-data">
                <tbody>
                    <tr class="bg-blue">
                        <th><strong>Name</strong></th>
                        <td class="pt-1">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                            <input type="text" id="name" name="name" value=<?php echo $name; ?>>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>

                    <tr class="bg-blue">
                        <th><strong>description</strong></th>
                        <td class="pt-2">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                            <input type="text" id="description" name="description" value=<?php echo $description; ?>>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>

                    <tr class="bg-blue">
                        <th><strong>logo</strong></th>
                        <td class="pt-3">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                                
                                <img src="<?php echo $imageSrc; ?>" alt="no image">
                                <input type="file" id="logo" name="logo">
                                
                                
                                <!-- <?php if (!$imageSrc): ?>
                                    <input type="hidden" type id="logo" name="logo" value="<?php echo $imageData; ?>">
                                <?php endif; ?> -->

                                

                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>



                    <tr class="bg-blue">
                        <th><strong>address</strong></th>
                        <td class="pt-3">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                                <input type="text" id="address" name="address" value= <?php echo $address; ?>>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>


                    <tr class="bg-blue">
                        <th><strong>Phone Number</strong></th>
                        <td class="pt-4">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                                <input type="text" id="phone_number" name="phone_number" readonly value= <?php echo $phone_number; ?>>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>

                    <tr class="bg-blue">
                        <th><strong>rating</strong></th>
                        <td class="pt-6">
                            <div class="pl-lg-5 pl-md-3 pl-1 name">
                                <input type="text" id="rating" name="rating" readonly value= <?php echo $rating; ?>>
                            </div>
                        </td>
                    </tr>
                    <tr id="spacing-row">
                        <td></td>
                    </tr>

                    
                    <tr id="spacing-row">
                        <td>
                            
                        <td>
                    </tr>
                    <tr>
                        <td class="pt-6">
                        <input type="submit" id="update" value="update">
                        <a href="restaurant_info.php"><input type="button" id="backindex" value="返回餐廳資訊"></td></a>
                        </td>
                    </tr>

                </tbody>
            </form>
        </table>
    </div>
</div>
<script type='text/javascript'></script>
</body>
</html>