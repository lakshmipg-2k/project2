<?php
include ('config.php');
session_start();
$user_id=$_SESSION['user_id'];
if(!isset($user_id)){
header('location:login.php');
}
if(isset($_POST['send'])){
$name =  $_POST['name'];
$email =  $_POST['email'];
$number = $_POST['number'];
$message =  $_POST['message'];
$sql =  "insert into message(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$message')";
$result=mysqli_query($conn,$sql);
if($result){
echo '<script>alert("Sent")</script>';
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>contact</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="css/pro.css">
<link rel="stylesheet" href="css/home.css">
</head>
<body>
<header>
<input type="checkbox"  id="toggler">
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
<a href="search.php" class="fas fa-search"></a></div>
</header>
<section class="messages">
<div class="box-container">
<div class="box">
<form  action="" method="POST">
<h3>send us message!</h3>
<input type="text" name="name" placeholder="enter your name" class="box" required> 
<input type="email" name="email" placeholder="enter your email" class="box" required>
<input type="number" name="number" placeholder="enter your number" class="box" required>
<textarea name="message" class="box" placeholder="enter your message" required cols="30" rows="10"></textarea>
<input type="submit" value="send message" name="send" class="btn">
</form>
</div>
</div>
</section>
</body>
</html>