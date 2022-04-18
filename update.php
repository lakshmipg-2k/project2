<?php
include('config.php');
session_start();
$admin_id=$_SESSION['admin_id'];
if(!isset($admin_id)){
header('location:login.php');
};
if(isset($_POST['update_product'])){
$update_p_id=$_POST['update_p_id'];
$name=mysqli_real_escape_string($conn,$_POST['name']);
$price=mysqli_real_escape_string($conn,$_POST['price']);
$details=mysqli_real_escape_string($conn,$_POST['details']);
mysqli_query($conn,"update products set name='$name',details='$details',price='$price' where id='$update_p_id'") or die('query failed');
$image = $_FILES['image']['name'];
$image_size = $_FILES['image']['size'];
$image_tmp_name = $_FILES['image']['tmp_name'];
$image_folder = "images./".$image;
if(!empty($image)){
if($image_size>20000000){
$message[]='image size is large';
}else{
mysqli_query($conn,"update products set image='$image' where id='$update_p_id'") or die('query failed');
move_uploaded_file($image_tmp_name,$image_folder);
unlink('images/'.$old_image);
$message[]='Image Updated';
}
}
$message[]='Products Updated';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>
<body>
<?php include('admin_header.php');?>
<section class="update-product">
<?php
$update_id=$_GET['update'];
$select_products=mysqli_query($conn,"select * from products where id='$update_id'") or die('query failed');
if(mysqli_num_rows($select_products)>0){
while($fetch_products=mysqli_fetch_assoc($select_products)){
?>
<form action="" method="POST" enctype="multipart/form-data">    
<img src="images/<?php echo $fetch_products['image'];?>" class="image" alt="">
<input type="hidden" value="<?php echo $fetch_products['id'];?>" name="update_p_id">
<input type="hidden" value="<?php echo $fetch_products['image'];?>" name="update_p_image">
<input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="Update Product Name" name="name">
<input type="number" min="0" class="box" value="<?php echo $fetch_products['price']; ?>"required placeholder="Update Product price" name="price">  
<textarea name="details" class="box"  required placeholder="Update Details" cols="25" rows="10"><?php echo $fetch_products['details'];?></textarea>  
<input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
<input type="submit" value="Update product" name="update_product" class="btn">
<a href="products.php" class="option-btn">Back</a>
</form>
<?php
}
}
?>
</section>
<script src="js/admin.js"></script>
</body>
</html>