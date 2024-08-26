<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
   header('location:login.php');
}

if (isset($_POST['cancel_order'])) {
   $order_id_to_cancel = $_POST['order_id'];

   // Assuming $conn is your database connection variable
   $cancel_query = mysqli_query($conn, "DELETE FROM `orders` WHERE id = '$order_id_to_cancel'");

   if ($cancel_query) {
      echo '<script>alert("Order canceled successfully!");</script>';
      // You may want to refresh the page or redirect the user after cancellation
      // header('Refresh: 2; URL=orders.php');
   } else {
      echo '<script>alert("Failed to cancel order. Please try again.");</script>';
   }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Orders</title>

   <!-- Font Awesome CDN link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="css/style.css">
   

</head>
<body>
<body>

   <?php include 'header.php'; ?>

   <div class="heading">
      <h3>My orders</h3>
   </div>

   <section class="placed-orders">
      <div class="box-container">

         <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE user_id = '$user_id'") or die('Query failed');
         if (mysqli_num_rows($order_query) > 0) {
            while ($fetch_orders = mysqli_fetch_assoc($order_query)) {
         ?>
               <div class="box">
                  <p>Placed on: <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                  <p>Name: <span><?php echo $fetch_orders['name']; ?></span></p>
                  <!-- <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p> -->
         <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
         <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
         <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>Rs <?php echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> Delivery status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>

                  <form method="post" action="" onsubmit="return confirm('Are you sure you want to cancel this order?');">
                     <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                     <button type="submit" name="cancel_order" style="background-color: #8e44ad; color: #fff; padding: 8px 12px; border: none; cursor: pointer; border-radius: 4px;">Cancel order</button>

                  </form>
               </div>
         <?php
            }
         } else {
            echo '<p class="empty">No orders placed yet!</p>';
         }
         ?>
      </div>
   </section>

   <?php include 'footer.php'; ?>

   <!-- Custom JS file link -->
   <script src="js/script.js"></script>

</body>

</html>
