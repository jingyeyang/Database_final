<?php
session_start();

require_once('../../config/config.php');

// 檢查購物車是否為空
if (empty($_SESSION['cart'])) {
  // 購物車為空，跳轉到 error.php
  header("Location: error.php");
  exit(); // 確保在跳轉之後立即停止腳本執行
}


if (isset($_POST['submit_order'])) {
    // 獲取商品選擇
    $item_ids = $_POST['item_id'];
    $user_id = $_POST['user_id'];
    $restaurant_names = $_POST['restaurant_name'];
    $restaurant_ids = $_POST['restaurant_id'];
    $unique_restaurant_ids = array_unique($restaurant_ids);
    $names = $_POST['name'];
    $prices = $_POST['price'];
    $quantitys = $_POST['quantity'];
    $totalAmount = $_POST['totalAmount'];

    // 輸出不重複的 restaurant_ids
    // foreach ($unique_restaurant_ids as $id) {
    //   echo $id . "<br>";
    // }

    // 獲取送貨地址
    $delivery_address = $_SESSION['delivery_address'];

    // 其他表單欄位處理
    date_default_timezone_set("Asia/Taipei");
    $order_time = date('Y-m-d H:i:s');
    // echo $order_time;
    $delivery_time = date('Y-m-d H:i:s', strtotime('+20 minutes', strtotime($order_time)));  // 加上 20 分鐘後的時間
    // echo $delivery_time;

    // 將商品資訊存入資料庫
    foreach ($unique_restaurant_ids as $restaurant_id) {
        
        // 初始化餐點總金額
        $restaurant_total = 0;

        // 遍歷餐點資訊，找出屬於目前餐廳的餐點並計算總金額
        for ($j = 0; $j < count($item_ids); $j++) {

            if ($restaurant_ids[$j] == $restaurant_id) {
                $price = $prices[$j];
                $quantity = $quantitys[$j];
                $subtotal = $price * $quantity;
                $restaurant_total += $subtotal;
            }
        };
        // echo "<br>restaurant_total = " . $restaurant_total . "<br>";


        // $item_id = $item_ids[$i];
        // // $restaurant_name = $restaurant_names[$i];
        // $restaurant_id = $unique_restaurant_ids[$i];
        // // $name = $names[$i];
        // $price = $prices[$i];
        // $quantity = $quantitys[$i];
        // $subtotal = $price * $quantity;

        // 執行資料庫操作，將商品資訊插入資料庫
        $insert_sql = "INSERT INTO orders (user_id,restaurant_id,order_time, delivery_time, delivery_address,total_price)
          VALUES ('$user_id','$restaurant_id','$order_time', '$delivery_time', '$delivery_address','$restaurant_total')";

        if ($result = $conn->query($insert_sql) === TRUE) {
            // 獲取新插入行的 ID
            $order_id = $conn->insert_id;
            
            // 檢查是否成功插入行
            if ($result && $order_id) {
                // echo "訂單已成功插入，訂單 ID 為：" . $order_id;
                //if ($restaurant_ids[$i] == $restaurant_id)
                
                
                // 遍歷餐點資訊，找出屬於目前餐廳的餐點並計算總金額
                for ($i = 0; $i < count($item_ids); $i++) {
                  if ($restaurant_ids[$i] == $restaurant_id){
                        $item_id = $item_ids[$i];
                        $quantity = $quantitys[$i];
                        $sql = "INSERT INTO order_items (order_id, item_id, quantity) VALUES ($order_id, $item_id, $quantity)";
                        //$recent_insert = "INSERT INTO recent_order (order_id) VALUES ($order_id)";

                        if ($conn->query($sql) === TRUE) {
                            echo "";
                        } else {
                            echo "<script>
                            // 顯示結帳失敗的alert
                            alert('結帳失敗！請重新嘗試。');
                            // 三秒後跳轉回購物車頁面
                            setTimeout(function() {
                                window.location.href = 'cart.php';
                            }, 3000);
                        </script>";
                        }
                    }
                      
                };
                                
                $recent_insert = "INSERT INTO recent_order (order_id) VALUES ($order_id)";
                if($conn->query($recent_insert) === TRUE)
                {
                    echo "";
                }
            
            } else {
                echo "插入訂單時發生錯誤";
                echo "<script>
                // 顯示結帳失敗的alert
                alert('結帳失敗！請重新嘗試。');
                // 三秒後跳轉回購物車頁面
                setTimeout(function() {
                    window.location.href = 'cart.php';
                }, 3000);
            </script>";
            }
          
        }
    };


// 清空購物車
$_SESSION['cart'] = array();

echo "<script>
    // 顯示結帳成功的alert
    alert('結帳成功！購物車已清空。即將跳轉回首頁');
    // 三秒後跳轉回餐廳頁面
    setTimeout(function() {
        window.location.href = '../user/dashboard.php';
    });
</script>";


  }
?>

