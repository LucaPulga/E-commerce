<?
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user']==''){header("Location:../index.php");}
?>
<?php 
   if(isset($_GET["action"]))
   {
      if($_GET["action"] == "delete")
      {
         $cookie_data = stripslashes($_COOKIE['shopping_cart']);
         $cart_data = json_decode($cookie_data, true);
         foreach($cart_data as $keys => $values)
         {
            if($cart_data[$keys]['item_id'] == $_GET["id"])
            {
               unset($cart_data[$keys]);
               $item_data = json_encode($cart_data);
               setcookie("shopping_cart", $item_data, time() + (86400 * 30),'/');
            }
         }
         header("Location:shoppingCart.php");
      }
      if($_GET["action"] == "clear")
      {
         setcookie("shopping_cart", "", time() - 3600,'/');
         header("Location:shoppingCart.php");
      }
   }
?>

<!DOCTYPE html>
<html>
   <head>
      <title>CyberReason Carrello</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" rel="stylesheet"/>
      <link rel="stylesheet" type="text/css" href="../css/styleshoppingCart.css?v=<?php echo time();?>">
      <script src="../js/script.js?v=<?php echo time();?>"></script>
   </head>
   <body>
      <div class="topnav" id="myTopnav">
         <img src="../img/loog.png" class="logo">
         <span class="rightalignement">
            <div class="dropdown">
               <button class="dropbtn">
                  <?php include "../utilities/languagecookie.php"?>
               </button>
               <div class="dropdown-content">
                  <a id="en" onclick="changeToGb()"><i class="flag-icon flag-icon-gb"></i> </a>
                  <a id="it" onclick="changeToIta()"><i class="flag-icon flag-icon-it"></i> </a>
               </div>
            </div>
         </span>
         <a href="profile.php" class="asignup" id="asignup"><i class="fa fa-user-circle-o" aria-hidden="true" id="icon"></i></a>
         <a href="shoppingCart.php" class="asignup" id="asignup"><i class="fa fa-shopping-cart" aria-hidden="true" id="icon"></i></a>

         <?php
            $id = $_SESSION['user'];
            if($id == ''){
               //header("Location:pages/Login.php");
            }
            else if($id == 1){
               echo('<a href="logout.php" class="alogin" id="alogout"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Logout</a>');
               echo('<a href="MostraUtenti.php" class="afooter" id="ausers"><i class="fa fa-database" aria-hidden="true" id="icon"></i>Show users</a>');
               echo('<a href="MostraProdotti.php" class="afooter" id="ashowproducts"><i class="fa fa-database" aria-hidden="true" id="icon"></i>Show products</a>');
               echo('<a href="Prodotti.php" class="afooter" id="ainsproduct"><i class="fa fa-product-hunt" aria-hidden="true" id="icon"></i>Insert products</a>');
               echo('<a href="../index.php" class="ahome" id=""><i class="fa fa-home" aria-hidden="true" id="icon"></i>Home</a>');
            }
            else{
               echo('<a href="logout.php" class="alogin" id="alogout"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Logout</a>');
               echo('<a href="../index.php" class="ahome" id=""><i class="fa fa-home" aria-hidden="true" id="icon"></i>Home</a>');
               $pdo=new PDO('mysql:dbname=eserciziologin;host=localhost;port=3306', 'root', 'mysql');
               $sql = $pdo->query("SELECT * FROM utente WHERE codice='$id'");
               foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $r){
                  $name = $r['nome'];
               }
            }
         ?>
         <a href="javascript:void(0);" class="icon" onclick="hamburger()">&#9776;</a>
      </div>

   <div class="products">
      <?php
         if(isset($_COOKIE["shopping_cart"]))
         {  
            $total = 0;
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);
            $cart_data = json_decode($cookie_data, true);
            foreach($cart_data as $keys => $values)
            {
      ?>
      <div class="item">
         <div class="buttons">
            <span class="delete-btn"><a href="shoppingCart.php?action=delete&id=<?php echo $values['item_id']; ?>"><i class="fa fa-times" aria-hidden="true"></i></a></span>
            <span class="like-btn"></span>
         </div>
      
         <div class="image">
            <img src="<?php echo $values['item_img']; ?>" alt="" class="img"/>
         </div>
      
         <div class="description">
            <span><?php echo $values["item_name"]; ?></span>
         </div>
      
         <div class="quantity">
            <button class="plus-btn" type="button" name="button">
            <img src="../img/plus.svg" alt="" />
            </button>
            <input type="text" name="name" value="<?php echo $values['item_quantity']; ?>">
            <button class="minus-btn" type="button" name="button">
            <img src="minus.svg" alt="" />
            </button>
         </div>
      
         <div class="total-price"><?php echo $values['item_price']; ?>€</div>
      </div>


      <hr>
      <?php
         $total = $total + ($values["item_quantity"] * $values["item_price"]);
      }
      echo('<h3>TOTAL: </h3>');
      echo('<h1>'.number_format($total, 2).'</h1>');
   }
   else{
      echo('<h1>NO item in cart</h1>');
   }
   
   ?>
   <a href="shoppingCart.php?action=clear" class="clearall"><strong>Clear Cart</strong></a>

   </div>
      <?php require "../components/footer.php"?>
   </body>
</html>