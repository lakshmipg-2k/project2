<?php
include('config.php');
session_start();
$user_id=$_SESSION['user_id'];
if(!isset($user_id)){
header('location:login.php');
}
if(isset($_POST['order'])){
$name = mysqli_real_escape_string($conn, $_POST['name']);
$number = mysqli_real_escape_string($conn, $_POST['number']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$address = mysqli_real_escape_string($conn,  $_POST['flat'].', '. $_POST['city'].' - '. $_POST['pin_code']);
$placed_on = date('d-M-Y');
$cart_total = 0;
$cart_products[] = '';
$cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($cart_query) > 0){
while($cart_item = mysqli_fetch_assoc($cart_query)){
$cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
$sub_total = ($cart_item['price'] * $cart_item['quantity']);
$cart_total += $sub_total;
}
}
$total_products = implode($cart_products);
$order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND  address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');
if($cart_total == 0){
$message[] = 'your cart is empty!';
}elseif(mysqli_num_rows($order_query) > 0){
$message[] = 'order placed already!';
}else{
mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
$message[] = 'order placed successfully!';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/pro.css">
</head>
<body>
<!--header-->
<header>
<input type="checkbox" name="" id="toggler">
<label for="toggler" class="fas fa-bars"></label>
<label style="font-size:20px;"class="fa-solid fa-seedling" ></label> 
<nav class="navbar">
<a href="index.php">Home</a>
<a href="index.php#about">About</a>
<a href="home.php">Products</a>
<a href="userorder.php">Orders</a>
<a href="message.php">Contact</a>
</nav>
<div class="icons">
<a href="search.php" class="fas fa-search"></a>
</div>
<div class="account-box">
<p>Username:<span><?php echo $_SESSION['user_name'];?></span></p>
<p>Email:<span><?php echo $_SESSION['user_email'];?></span></p>
<a href="logout.php" class="delete-btn">Logout</a></div>
</header>
<?php
if(isset($message)){
foreach($message as $message){
echo '<div class="message">
<span>'.$message.'</span>
<i class="fas fa-times" onclick="this.parentElement.remove();"></i>
</div>';
}
}
?>
<section class="heading">
<h3>checkout order</h3>
</section>
<section class="display-order">
<?php
$grand_total = 0;
$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select_cart) > 0){
while($fetch_cart = mysqli_fetch_assoc($select_cart)){
$total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
$grand_total += $total_price;
?>    
<p> <?php echo $fetch_cart['name'] ?> <span>(<?php echo '$'.$fetch_cart['price'].'/-'.' x '.$fetch_cart['quantity']  ?>)</span> </p>
<?php
}
}else{
echo '<p class="empty">your cart is empty</p>';
}
?>
<div class="grand-total">grand total : <span>Rs<?php echo $grand_total; ?>/-</span></div>
</section>
<section class="checkout">
<form action="" method="POST">
<h3>place your order</h3>
<div class="flex">
<div class="inputBox">
<span>your name :</span>
<input type="text" name="name" placeholder="enter your name" required>
</div>
<div class="inputBox">
<span>your number :</span>
<input type="number" name="number" min="0" placeholder="enter your number"required>
</div>
<div class="inputBox">
<span>your email :</span>
<input type="email" name="email" placeholder="enter your email" required>
</div>
<div class="inputBox">
<span>payment method :</span>
<select name="method">
<option value="cash on delivery">cash on delivery</option>
</select>
</div>
<div class="inputBox">
<span>address</span>
<input type="text" name="flat" required> 
</div>

<div class="inputBox">
<span>Place :</span>
<input type="text" name="city" required>
</div>
<div class="inputBox">
<span>state :</span>
<input type="text" name="state"  required>
</div>
<div class="inputBox">
<span>pin code :</span>
<input type="number" min="0" name="pin_code" required >
</div>
</div>
<input type="submit" name="order" value="order now" class="btn">
</form>
</section>
</body>
</html>