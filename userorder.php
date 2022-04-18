<?php
include('config.php');
session_start();
$user_id=$_SESSION['user_id'];
if(!isset($user_id)){
header('location:login.php');
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
<section class="heading">
<h3>your orders</h3>
</section>
<section class="placed-orders">
<h1 class="title"></h1>
<div class="box-container">
<?php
$select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('query failed');
if(mysqli_num_rows($select_orders) > 0){
while($fetch_orders = mysqli_fetch_assoc($select_orders)){
?>
<div class="box">
<p> Placed on :<span><?php echo $fetch_orders['placed_on']; ?></span> </p>
<p> Name : <span><?php echo $fetch_orders['name']; ?></span> </p>
<p> Number : <span><?php echo $fetch_orders['number']; ?></span> </p>
<p> Email :  <span><?php echo $fetch_orders['email']; ?></span> </p>
<p> Address : <span><?php echo $fetch_orders['address']; ?></span> </p>
<p> Total Products : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
<p> Total price : <span>Rs<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
<p> Payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){echo 'red'; }else{echo 'green';} ?>"><?php echo $fetch_orders['payment_status']; ?></span> </p>
</div>
<?php
}
}else{
echo '<p class="empty">no orders placed yet!</p>';
}
?>
</div>
</section>
</body>
</html>