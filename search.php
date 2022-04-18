<?php
include ('config.php');
session_start();
$user_id=$_SESSION['user_id'];
if(!isset($user_id)){
header('location:login.php');
}
if(isset($_POST['add_to_cart'])){
$id = $_POST['id'];
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];
$quantity = $_POST['quantity'];
$sql = mysqli_query($conn, "select * from `cart` where name = '$name' AND user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($sql) > 0){
$message[] = 'Already added to cart';
}else{
$sql =  "insert into cart(user_id, name,price,quantity,image) VALUES('$user_id', '$name', '$price','$quantity','$image')";
$result=mysqli_query($conn,$sql);
$message[]='Added to cart';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>search page</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="css/home.css">
<link rel="stylesheet" href="css/pro.css">
</head>
<body>
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
<?php
$select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
$cart_num_rows = mysqli_num_rows($select_cart_count);
?>
<a href="cart.php" class="fas fa-shopping-cart"><span>(<?php echo $cart_num_rows; ?>)</span></a>
<a href="search.php" class="fas fa-search"></a>
</div>
</header>
<section class="heading">
<h3>search page</h3>
</section>
<section class="search-form">
<form action="" method="POST">
<input type="text" class="box" placeholder="search products..." name="search_box">
<input type="submit" class="btn" value="search" name="search_btn">
</form>
</section>
<section class="products" style="padding-top: 0;">
<div class="box-container">
<?php
if(isset($_POST['search_btn'])){
$search_box = mysqli_real_escape_string($conn, $_POST['search_box']);
$select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE name LIKE '%{$search_box}%'") or die('query failed');
if(mysqli_num_rows($select_products)>0 ){
while($fetch_products = mysqli_fetch_assoc($select_products)){
?>
<form action="" method="POST" class="box">
<div class="price">Rs<?php echo $fetch_products['price']; ?>/-</div>
<img src="images/<?php echo $fetch_products['image']; ?>" alt="" class="image">
<div class="name"><?php echo $fetch_products['name']; ?></div>
<input type="number" name="quantity" value="1" min="0" class="qty">
<input type="hidden" name="id" value="<?php echo $fetch_products['id']; ?>">
<input type="hidden" name="name" value="<?php echo $fetch_products['name']; ?>">
<input type="hidden" name="price" value="<?php echo $fetch_products['price']; ?>">
<input type="hidden" name="image" value="<?php echo $fetch_products['image']; ?>">
<input type="submit" value="add to cart" name="add_to_cart" class="btn">
</form>
<?php
}
}else{
echo '<p class="empty">no result found!</p>';
}
}else{
echo '<p class="empty">search something!</p>';
}
?></div></section></body></html>