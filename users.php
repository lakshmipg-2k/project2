<?php
include('config.php');
session_start();
$admin_id=$_SESSION['admin_id'];
if(!isset($admin_id)){
header('location:login.php');
};
if(isset($_GET['delete'])){
$delete_id=$_GET['delete'];
mysqli_query($conn,"delete from users where id='$delete_id'") or die('query failed');
header('location:users.php');
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
<section class="users">
<h1 class="title">Users Account</h1>
<div class="box-container">
<?php
$select_users=mysqli_query($conn,"select * from users") or die('query failed');
if(mysqli_num_rows($select_users)>0){
while($fetch_users=mysqli_fetch_assoc($select_users)){
?>
<div class="box">
<p>User Id:<span><?php echo $fetch_users['id'];?></span></p>
<p>Username:<span><?php echo $fetch_users['name'];?></span></p>
<p>Email:<span><?php echo $fetch_users['email'];?></span></p>
<p>User Type : <span style="color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'blue'; }; ?>"><?php echo $fetch_users['user_type']; ?></span></p>
<a href="users.php?delete=<?php echo $fetch_users['id'];?>" onclick="return confirm('Delete user');"class="delete-btn">Delete</a>
</div>
<?php
}
}
?>
</div>
</section>
<script src="js/admin.js"></script>
</body>
</html>