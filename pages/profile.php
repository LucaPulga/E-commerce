<?
    session_start();
    if(!isset($_SESSION['user']) || $_SESSION['user']==''){header("Location:../index.php");}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CyberReason Profilo</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="../css/styleProfile.css?v=<?php echo time();?>">
        <!-- JavaScript Bundle with Popper -->
        <script src="../js/script.js?v=<?php echo time();?>"></script>
    </head>

    <body>

    <?php
         $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql"); // DEFAULT PORT: 3306
         $pdo->query("USE eserciziologin");
        if(isset($_POST["btnSave"])) {
            $dbemail=$_POST['email'];
            $nome=$_POST['name'];
            $cognome=$_POST['surname'];
            $imgB=$_POST['imgB'];
            $imgF=$_POST['imgF'];
            
            $pdo = NEW PDO("mysql:host=localhost;port=3306","root", "mysql");
            $dbname="eserciziologin";
            $pdo->query("USE $dbname");
            $pdo->query("UPDATE utente set nome='$nome', cognome='$cognome',email='$dbemail',imgBackground='$imgB',imgForeground='$imgF' where codice=$id");
        }
    ?>
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

        <hr class="divisor">
        <div class="containerProfile">
        <?php
            $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql"); // DEFAULT PORT: 3306
            $pdo->query("USE eserciziologin");
            $stmt = $pdo->query("SELECT * FROM utente WHERE codice=$id");
            $dbemail='';
            $nome='';
            $cognome='';
            $imgB='';
            $imgF='';
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $r) {
                $password=$r['password'];
                $cognome=$r['cognome'];
                $nome=$r['nome'];
                $dbemail=$r['email'];
                $imgB=$r['imgBackground'];
                $imgF=$r['imgForeground']; 
            }

            echo('<img src="'.$imgB.'" class="imgback">');
            echo('<img src="'.$imgF.'" class="profilepicture">');

            echo('<h2 class="title">About me</h2>');
            echo('<div class="para">');
                echo('<p class="title">designer is a person who makes designs for objects. ... More formally, a designer is an agent that "specifies the structural properties of a design object". In practice, anyone who creates tangible or intangible objects, products, processes, laws, games, graphics, services, and experiences is referred to as a designer.</p>');
            echo('</div>');
            echo('<div class="content">');
                echo('<form action="profile.php">');
                    echo('<div class="user-details">');
                
                        echo('<div class="input-box">');
                                echo('<span class="details">Name</span>');
                                echo('<input type="text" name="name" placeholder="Enter your name" value='.$nome.' required>');
                            echo('</div>');
                            echo('<div class="input-box">');
                                echo('<span class="details">Surname</span>');
                                echo('<input type="text" name="surname" placeholder="Enter your surname" value='.$cognome.' required>');
                            echo('</div>');
                            echo('<div class="input-box">');
                                echo('<span class="details">Email</span>');
                                echo('<input type="email" name="email" placeholder="Enter your email" value='.$dbemail.' required>');
                            echo('</div>');
                            echo('<div class="input-box">');
                                echo('<span class="details">Background image</span>');
                                echo('<input type="text" name="imgB" placeholder="Enter your foreground image" value='.$imgB.' required>');
                            echo('</div>');
                            echo('<div class="input-box">');
                                echo('<span class="details">Foreground image</span>');
                                echo('<input type="text" name="imgF" placeholder="Enter your background image" value='.$imgF.' required>');
                            echo('</div>');

                echo('</div>');
                echo('<div class="button" id="save">');
                    echo('<input type="submit" value="Save" name="btnSave" class="save">');
                echo('</div>');
                
            echo('</form>');
            echo('</div>');
            $pdo = null;
            ?>
        </div>
        
        <?php require "../components/footer.php"?>
    </body>
</html>

