<?php
include('config.php');
session_start();
$admin_id=$_SESSION['admin_id'];
if(!isset($admin_id)){
header('location:login.php');
};
if(isset($admin_id)){
$order_id=$_POST['order_id'];
$update_payment=$_POST['update_payment'];
mysqli_query($conn, "update orders set payment_status='$update_payment' where id='$order_id'") or die('query failed');
$message[]='Payment status updated';
}
if(isset($_GET['delete'])){
$delete_id=$_GET['delete'];
mysqli_query($conn,"delete from orders where id='$delete_id'") or die('query failed');
header('location:orders.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<?php include('admin_header.php');?>
<section class="placed-orders">
<h1 class="title">Placed Orders</h1>
<div class="box-container">
<?php
$select_orders=mysqli_query($conn,"select * from orders")or die('query failed');
if(mysqli_num_rows($select_orders)>0){
while($fetch_orders=mysqli_fetch_assoc($select_orders)){
?>
<div class="box">
<p>User id:<span><?php echo $fetch_orders['user_id'];?></span></p>
<p>Placed On:<span><?php echo $fetch_orders['placed_on'];?></span></p> 
<p>Name:<span><?php echo $fetch_orders['name'];?></span></p>  
<p>Number:<span><?php echo $fetch_orders['number'];?></span></p> 
<p>Email:<span><?php echo $fetch_orders['email'];?></span></p>
<p>Address:<span><?php echo $fetch_orders['address'];?></span></p>
<p>Total Products:<span><?php echo $fetch_orders['total_products'];?></span></p>
<p>Total Price:<span><?php echo $fetch_orders['total_price'];?></span></p>
<form action="" method="POST">
<input type="hidden" name="order_id" value="<?php echo $fetch_orders['id'];?>">
<select name="update_payment">
<option disabled selected><?php echo $fetch_orders['payment_status'];?></option>
<option value="pending">Pending</option>
<option value="completed">completed</option>    </select>
<input type="submit" name="update_order" value="update" class="option-btn">
<a href="orders.php?delete=<?php echo $fetch_orders['id'];?>" class="delete-btn" onclick="return confirm('Delete order?');">Delete</a>
</form>
</div>
<?php
}
}else{
echo '<p class="empty">Orders Not Placed</p>';
}
?>
</div></section> <script src="js/admin.js"></script></body></html>