<?php
include('config.php');
session_start();
$admin_id=$_SESSION['admin_id'];
if(!isset($admin_id)){
header('location:login.php');
};
if(isset($_GET['delete'])){
$delete_id=$_GET['delete'];
mysqli_query($conn,"delete from message where id='$delete_id'") or die('query failed');
header('location:contacts.php');
}
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
<section class="messages">
<h1 class="title">Message</h1>
<div class="box-container">
<?php
$select_message=mysqli_query($conn,"select * from message") or die('query failed');
if(mysqli_num_rows($select_message)>0){
    while($fetch_message=mysqli_fetch_assoc($select_message)){
?>
<div class="box">
<p>User Id:<span><?php echo $fetch_message['user_id'];?></span></p>
<p>Name:<span><?php echo $fetch_message['name'];?></span></p>
<p>Number:<span><?php echo $fetch_message['number'];?></span></p>
<p>Email:<span><?php echo $fetch_message['email'];?></span></p>
<p>Message:<span><?php echo $fetch_message['message'];?></span></p>
<a href="contacts.php?delete=<?php echo $fetch_message['id'];?>"onclick="return confirm('Delete message');" class="delete-btn">Delete</a>
</div>
<?php
}
}else{
'<p class="empty">No Messages</p>';
}
?>
</div>
</section>
<script src="js/admin.js"></script></body></html>