
<?php
session_start();
include 'config.php';

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $genre = mysqli_real_escape_string($conn, $_POST['genre']);
$description = mysqli_real_escape_string($conn, $_POST['description']);
$author = mysqli_real_escape_string($conn, $_POST['author']);
$cust_id=$_SESSION['user_id'];

   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already added';
   }else{
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(cust_id,name, price, image, genre, description, author) VALUES('$cust_id','$name', '$price', '$image', '$genre', '$description', '$author')") or die('query failed');

      if($add_product_query){
         if($image_size > 2000000){
            $message[] = 'image size is too large';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'product added successfully!';
         }
      }else{
         $message[] = 'product could not be added!';
      }
   }
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_products.php');
}

if(isset($_POST['update_product'])){

   $update_p_id = $_POST['update_p_id'];
   $update_name = $_POST['update_name'];
   $update_price = $_POST['update_price'];

   mysqli_query($conn, "UPDATE `products` SET name = '$update_name', price = '$update_price', genre = '$update_genre', description = '$update_description', author = '$update_author' WHERE id = '$update_p_id'") or die('query failed');

   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_size = $_FILES['update_image']['size'];
   $update_folder = 'uploaded_img/'.$update_image;
   $update_old_image = $_POST['update_old_image'];

   if(!empty($update_image)){
      if($update_image_size > 2000000){
         $message[] = 'image file size is too large';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($update_image_tmp_name, $update_folder);
         unlink('uploaded_img/'.$update_old_image);
      }
   }

   header('location:admin_products.php');

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <style>
   
   .heading{
   min-height: 30vh;
   display: flex;
   flex-flow: column;
   align-items: center;
   justify-content: center;
   gap:1rem;
   background: url('./images/heading-bg.webp') no-repeat;
   background-size: cover;
   background-position: center;
   text-align: center;
}
.heading h3{
   font-size: 5rem;
   color:var(--black);
   text-transform: uppercase;
}
.heading p{
   font-size: 2.5rem;
   color:var(--light-color);
}

.heading p a{
   color:var(--purple);
}

.heading p a:hover{
   text-decoration: underline;
}


</style>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
   
<?php include 'userheader.php'; ?>

<!-- product CRUD section starts  -->
<div class="heading">
   <h3>sell your book</h3>
   
</div>
<section class="add-products">
   
   <form action="" method="post" enctype="multipart/form-data">
      
      <h3>Sell your old books!</h3>
      <input type="text" name="name" class="box" placeholder="enter book name" required>
      <input type="number" min="0" name="price" class="box" placeholder="enter book price" required>
      <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
      <input type="text" name="genre" class="box" placeholder="enter genre" required>
<textarea name="description" class="box" placeholder="enter description" required></textarea>
<input type="text" name="author" class="box" placeholder="enter author" required>

      <input type="submit" value="add book" name="add_product" class="btn">
   </form>

</section>
<!-- custom admin js file link  -->
<script src="js/admin_script.js"></script>

</body>

</html>