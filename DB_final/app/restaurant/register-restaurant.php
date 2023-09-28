<!doctype html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>建立餐廳</title>
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
    <div class="h2 font-weight-bold">建立餐廳</div>


    <div class="table-responsive">
    <form action="register-restaurant_process.php" method="post" enctype="multipart/form-data">	

        <table class="table">
            <!-- <thead>
                <tr>
                    <th scope="col">餐廳名稱</th>
                    <th scope="col">密碼</th>
                    <th scope="col">餐廳描述</th>
                    <th scope="col">餐廳logo</th>
                    <th scope="col">餐廳地址</th>
                    <th scope="col">餐廳電話號碼</th>
                </tr>
            </thead> -->
            <tbody>
                <th scope="col">餐廳名稱</th>
                <tr class='bg-blue'>
                    
                    <!-- <td class='pt-3'>預設</td> -->
                    <td class='pt-3'><input type='text' id="name" name="name" required></td>
                </tr>

                <th scope="col">密碼</th>
                <tr class='bg-blue'>
                    <td class='pt-3'><input type='text' id="passwd"  name='passwd' required></td>
                </tr>

                <th scope="col">餐廳描述</th>
                
                <tr class='bg-blue'>
                    <td class='pt-3'><input type='text' id="description" name='description' required></td>
                </tr>
                
                <th scope="col">餐廳logo</th>
                <tr class='bg-blue'>
                    <td class='pt-3'><input type='file' id="logo" name='logo' required></td>
                </tr>

                <th scope="col">餐廳地址</th>
                <tr class='bg-blue'>
                    <td class='pt-3'><input type='text' id="address" name='address' required></td>
                </tr>

                <th scope="col">餐廳電話號碼</th>
                <tr class='bg-blue'>
                    <td class='pt-3'><input type='text' id="phone_number" name='phone_number' required></td>
                </tr>
                

                <tr id='spacing-row'>
                    <td colspan='7' style='text-align: center;'><button type='submit'>建立餐廳</button></td>
                </tr>
            


            </tbody>
        </table>
    </form>

        <p align='center'>
            <a href="../../index.php">
                <button type='button' name='goBack'>返回首頁</button>
            </a>
        </p>
            
    </div>
</div>
<script type='text/javascript'></script>
</body>
</html>