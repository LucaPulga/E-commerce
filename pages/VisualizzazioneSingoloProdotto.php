<?
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user']==''){header("Location:../index.php");}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CyberReason Prodotto</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="../css/styleSingleProduct.css?v=<?php echo time();?>">
        <!-- JavaScript Bundle with Popper -->
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
            <a href="../index.php" class="ahome" id=""><i class="fa fa-home" aria-hidden="true" id="icon"></i>Home</a>

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
        
        <hr class="divisor">
        
        <div class="container">
            <div style="text-align:center">
               <h2>Buy Now whatever you want!</h2>
               <p>Swing by for a cup of coffee, or leave us a message</p>
            </div>
            <?php
            $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql");
            $dbname = "eserciziologin"; //Database utilizzato
            $tabellaprova = "prodotti";
            
            $pdo->query("USE $dbname");
            $prodottoselezionato = $_GET['dato'];
            $prodotto = $pdo->query("SELECT * FROM $tabellaprova WHERE codice = $prodottoselezionato");
            
            $img='';
            $codice='';
            $nome='';
            $prezzo='';
            $descrizione='';
            $qtaRimanente='';

            foreach ($prodotto->fetchAll(PDO::FETCH_ASSOC) as $results){
               $img=$results['imageurl'];
               $codice=$results['codice'];
               $nome=$results['nome'];
               $prezzo=$results['prezzo'];
               $descrizione=$results['descrizione'];
               $qtaRimanente=$results['qtaRimanente'];
            }
            echo('<div class="row">');
               echo('<div class="column">');
                  echo('<img src="'.$img.'" style="width:100%">');
               echo('</div>');
               echo('<div class="column">');
                  echo('<form action="#" method="post">');
                     echo('<h1>'.$nome.'</h1>');
                     echo('<p>'.$descrizione.'</p>');
                     echo('<h3>€ '.$prezzo.'</h3>');
                     echo('<input type="number" name="quantity" class="quantity" required></input>');
                     echo('<input class="add" type="submit" name="buy" value="Aggiungi al carrello"></input>');
                  echo('</form>');
               echo('</div>');
               ?>
            </div>
         </div>
         <?php
            if(isset($_POST['buy']))
            {
                if(isset($_COOKIE["shopping_cart"]))
                {
                    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                    $cart_data = json_decode($cookie_data, true);
                }
                else
                {
                    $cart_data = array();
                }
                $item_id_list = array_column($cart_data, 'item_id');
            
                if(in_array($codice, $item_id_list))
                {
                    foreach($cart_data as $keys => $values)
                    {
                        if($cart_data[$keys]["item_id"] == $codice)
                        {
                            $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
                        }
                    }
                }
                else
                {
                    $item_array = array(
                    'item_id'   => $codice,
                    'item_name'   => $nome,
                    'item_price'  => $prezzo,
                    'item_quantity'  => $_POST['quantity'],
                    'item_img' => $img, 
                    'item_descr' => $descrizione
                    );
                    $cart_data[] = $item_array;
                }
                $item_data = json_encode($cart_data);
                setcookie('shopping_cart', $item_data, time() + (86400 * 30), '/');
                header("location:shoppingCart.php?codice=".$codice);
            }
        ?>
        <?php require "../components/footer.php"?>
    </body>
</html>