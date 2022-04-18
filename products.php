<?php
include('config.php');
session_start();
$admin_id=$_SESSION['admin_id'];
if(!isset($admin_id)){
header('location:login.php');
};
if(isset($_POST['add_product'])){
$name=mysqli_real_escape_string($conn, $_POST['name']);
$price=mysqli_real_escape_string($conn, $_POST['price']);
$details=mysqli_real_escape_string($conn, $_POST['details']);
$image = $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_folder = "images./".$image; 
$select_product_name = mysqli_query($conn,"select name from products where name='$name'") or die('query failed');
if(mysqli_num_rows($select_product_name) > 0){
$message[]='product name already exist';
}else{
$insert_product = mysqli_query($conn, "insert into products (name,details,price,image) values('$name','$details','$price','$image')") or die('query failed');
if($insert_product){
if($image_size > 20000000){
$message[]='image size is too large';
}else{
move_uploaded_file($image_tmp_name, $image_folder);
$message[]='Product added successfully';
}}}   }
if(isset($_GET['delete'])){
$delete_id = $_GET['delete'];
$selete_delete_image=mysqli_query($conn,"select image from products where id='$delete_id'") or die('query failed');
$fetch_delete_image=mysqli_fetch_assoc($selete_delete_image);
unlink('images/'.$fetch_delete_image['image']);
mysqli_query($conn,"delete from products where id='$delete_id'") or die('query failed');
mysqli_query($conn,"delete from cart where id='$delete_id'") or die('query failed');
header('location:products.php');    
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
<section class="add-products">
<form action="" method="POST" enctype="multipart/form-data">    
<h3>Add New Product</h3>
<input type="text" class="box" required placeholder="Enter Product Name" name="name">
<input type="number" min="0"  class="box" required placeholder="Enter Product price" name="price">  
<textarea name="details" class="box" required placeholder="Enter Details" cols="25" rows="10"></textarea>  
<input type="file" accept="image/jpg, image/jpeg, image/png, image/webp" required class="box" name="image">
<input type="submit" value="Add product" name="add_product" class="btn">
</form>
</section>
<!--displaying products-->
<section class="show-products">
<div class="box-container">
<?php
$select_products=mysqli_query($conn,"select * from products") or die('query failed');
if(mysqli_num_rows($select_products)> 0){
while($fetch_products=mysqli_fetch_assoc($select_products)){
?>
<div class="box">
<img class="image" src="images/<?php echo $fetch_products['image'];?>" alt="">
<div class="price"><?php echo 'Rs' . $fetch_products['price'].'/-';?></div>
<div class="name"><?php echo $fetch_products['name'];?></div>
<div class="details"><?php echo $fetch_products['details'];?></div>
<a href="update.php?update=<?php echo $fetch_products['id'];?>"class="option-btn">Update</a>
<a href="products.php?delete=<?php echo $fetch_products['id'];?>"class="delete-btn" onclick="return confirm('Delete the product?');">Delete</a>
</div>
<?php
}
}
?>
</div>    
</section><script src="js/admin.js"></script></body></html>