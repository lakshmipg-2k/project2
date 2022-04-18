<?php
include('config.php');
session_start();
$admin_id=$_SESSION['admin_id'];
if(!isset($admin_id)){
header('location:login.php');
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<?php include('admin_header.php');?>
<section class="dashboard">
<h3 class="title"></h3>
<div class="box-container">
<div class="box">
<?php
$total_pendings=0;
$select_pendings=mysqli_query($conn,"select * from orders where payment_status='pending'")or die('query failed');
while($fetch_pendings=mysqli_fetch_assoc($select_pendings)){
$total_pendings+=$fetch_pendings['user_id'];};
?>
<h3> <?php echo $total_pendings;?></h3>
<p>Total Pendings</p>
</div>
<div class="box">
<?php
$total_completed=0;
$select_completed=mysqli_query($conn,"select * from orders where payment_status='completed'")or die('query failed');
while($fetch_completed=mysqli_fetch_assoc($select_completed)){
$total_completed+=$fetch_completed['user_id'];};
?>
<h3> <?php echo $total_completed;?></h3>
<p>Total completed</p>
</div>
<div class="box">
<?php
$select_orders=mysqli_query($conn,"select * from orders")or die('query failed');
$number_of_orders=mysqli_num_rows($select_orders);
?>
<h3><?php echo $number_of_orders;?></h3>
<p>Orders Placed</p>
</div>
<div class="box">
<?php
$select_products=mysqli_query($conn,"select * from products")or die('query failed');
$number_of_products=mysqli_num_rows($select_products);
?>
<h3><?php echo $number_of_products;?></h3>
<p>Products Added</p>
</div>
<div class="box">
<?php
$select_users=mysqli_query($conn,"select * from users where user_type='user'")or die('query failed');
$number_of_users=mysqli_num_rows($select_users);
?>
<h3><?php echo $number_of_users;?></h3>
<p>No of Users</p>
</div>
<div class="box">
<?php
$select_messages=mysqli_query($conn,"select * from message")or die('query failed');
$number_of_messages=mysqli_num_rows($select_messages);
?>
<h3><?php echo $number_of_messages;?></h3>
<p>No of Messages</p>
</div>
</div>    
</section>
<script src="js/admin.js"></script>
</body>
</html>