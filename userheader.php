<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>


<header class="header">
<div class="header-1" style="background-color:lightblue;" >
      <div class="flex">
         <div class="share">
        <b><a href="home.php" class="logo">USED BOOK HUB</a></b> 
         </div>
         
      </div>
   </div>

   <div class="flex">

     

      <nav class="navbar">
      <nav class="navbar">
            <a href="home.php">Home</a>
            <a href="about.php">About</a>
            <a href="shop.php">Shop</a>
            <a href="contact.php">Contact</a>
            <a href="orders.php">My orders</a>
            <a href="sellbook.php">Sell book</a>
          
         </nav>
         
        
      </nav>
      
      
      
   

      <div class="account-box">
         <p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a></div>
      </div>

   </div>

</header>