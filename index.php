<?php

include 'config.php';


if(isset($_POST['add_to_cart'])){

    header('location:login.php');

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>index</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<header class="header" >

   <div class="header-1" style="background-color:lightblue;" >
      <div class="flex">
         <div class="share">
        <b><a href="home.php" class="logo">USED BOOK HUB</a></b> 
         </div>
         <p><a href="login.php">login</a> | <a href="register.php">register</a> </p>
      </div>
   </div>

</header>

<section class="home">

   <div class="content">
      <h3>Welcome to USED Book Hub</h3>
      <p>"Second hand books are homeless books; they have come together in vast flocks of variegated feather."</p>
      
   </div>

</section>

<section class="products">

   <h1 class="title">latest books</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 5") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">Rs <?php echo $fetch_products['price']; ?>/-</div>
      <input type="hidden" min="1" max="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>

   <div class="load-more" style="margin-top: 2rem; text-align:center">
      
   </div>

</section>

<section class="about">

   <div class="flex">

      <div class="image">
         <img src="images/about-img.jpg" alt="">
      </div>

      <div class="content">
         <h3>about us</h3>
         <p> <br>

At <b>USED BOOK HUB</b>, we believe that every book has a story to tell, not just within its pages, but also in the journey it takes through the hands of its readers. Established 2023, we've been curating a diverse collection of pre-loved books for avid readers, collectors, and casual bookworms alike.</p>
         
      </div>

   </div>

</section>






<?php include 'footer.php'; ?>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>