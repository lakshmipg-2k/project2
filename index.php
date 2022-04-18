<?php include('config.php') ;
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
    <title>project2</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
<!--header-->
<header>
<input type="checkbox" name="" id="toggler">
<label for="toggler" class="fas fa-bars"></label>
<label style="font-size:20px;"class="fa-solid fa-seedling" ></label> 
<nav class="navbar">
<a href="#home">Home</a>
<a href="#about">About</a>
<a href="home.php">Products</a>
<a href="userorder.php">Orders</a>
<a href="login.php">Login</a>
<a href="message.php">Contact</a></nav>
<div class="icons">
<?php
$select_cart_count=mysqli_query($conn,"select * from cart where user_id='$user_id'") or die('query failed');
$cart_num_rows=mysqli_num_rows($select_cart_count);
?>
<a href="cart.php" class="fas fa-shopping-cart"><span>(<?php echo $cart_num_rows; ?>)</span></a>    
<a href="search.php" class="fas fa-search"></a></div> 
<div class="account-box">
<p>Username:<span><?php echo $_SESSION['user_name'];?></span></p>
<p>Email:<span><?php echo $_SESSION['user_email'];?></span></p>
<a href="logout.php" class="delete-btn">Logout</a></div>
</header>
<section class="home" id="home">
<div class="content">
<h3>Fresh Flowers and Plants</h3>
<span>Natural and Beautiful</span>
<p>"What you plant today</br>you will harvest</br>tomorrow"</p>
<a href="home.php" class="btn">Shop now</a></div>
</section>
<!--abt sec-->
<section class="about" id="about">
<h1 class="heading"><span>About</span> Us</h1>
<div class="row">
<div class="video-container">
<video src="images/v1.mp4" loop autoplay muted></video>
<h3>Best Sellers</h3></div>
<div class="content">
<h3>why choose us?</h3>
<p>Best supply, on time delivery, full time service</p>
<a href="#" class="btn">Learn more</a></div>
</div>
</section>
<!--abt1-->
<section class="about1" id="about">
<div class="flex">
<div class="content">
<h3>what we sell?</h3>
<p>Fresh Flowers and plants, flower bookey with free delivery</p>
<a href="home.php" class="btn">Learn more</a></div>
<div class="image">
<img src="images/2p.jpeg"></div>
</div>
<div class="flex">
<div class="image">
<img src="images/8f.jpeg"></div>    
<div class="content">
<h3>Any queries?</h3>
<p>Contact Us, available full time</p>
<a href="message.php" class="btn">Learn more</a></div>
</div>
</section>
<!--icons-->
<section class="icons-container">
<div class="icons">
<img src="images/d.jpeg">
<div class="info">
<h3>Free delivery</h3>
<span>On  orders</span></div></div> 
<div class="icons">
<img src="images/r.jpeg">
<div class="info">
<h3>7 days returns</h3>
<span>Moneyback garantee</span></div></div> 
<div class="icons">
<img src="images/g.jpeg">
<div class="info">
<h3>Offers and gifts</h3>
<span>on orders</span></div></div>  
<div class="icons">
<img src="images/s.jpeg">
<div class="info">
 <h3>Secure payments</h3>
 <span>On all orders</span></div>   </div> 
</section>
<section class="footer">
<div class="box-container">
<div class="box">
<h3>Quick Links</h3>
<a href="#home">Home</a>
<a href="#about">About</a>
<a href="#">Products</a>
<a href="#">Review</a>
<a href="#">Contact</a></div>
<div class="box">
<h3>Locations</h3>
<a href="#">Kolar</a>
<a href="#">Bengaluru</a>
<a href="#">Maluru</a></div>
<div class="box">
<h3>Contact Information</h3>
<a href="#">+934 653 1684</a>
<a href="#">test@gmail.com</a>
<a href="#">Kolar, India</a></div></div>
<div class="credit">&copy Created by <span>Lakshmi</span></div></section>
<script src="js/admin.js"></script></body></html>