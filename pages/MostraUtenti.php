<?
    session_start();
    $id = $_SESSION['user'];
    if($id!=1){header("Location:../index.php");}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CyberReason Mostra utenti</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="../css/styleShowUsers.css?v=<?php echo time();?>">
        <!-- JavaScript Bundle with Popper -->
        <script src="../js/script.js?v=<?php echo time();?>"></script>
    </head>

    <body>
        <?php
            if(isset($_POST["cancella"])) {
                $id = intval($_POST['id']);
                $pdo = NEW PDO("mysql:host=localhost;port=3306","root", "mysql");
                $dbname="eserciziologin";
                $pdo->query("USE $dbname");
                $res = $pdo->query("DELETE from utente where codice=$id");
                $pdo = null;
                header("Refresh:0");
            }
            if(isset($_POST["status"])) {
                
                $status=$_POST["tipo"];
                $id = intval($_POST['id']);
                
                $pdo = NEW PDO("mysql:host=localhost;port=3306","root", "mysql");
                $dbname="eserciziologin";
                $pdo->query("USE $dbname");
                if ($status=='admin'){    
                    $res = $pdo->query("UPDATE utente set tipologia='customer' where codice = $id");
                }
                else{
                    $res = $pdo->query("UPDATE utente set tipologia='admin' where codice = $id");   
                }
                $pdo = null;
                header("Refresh:0");
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

        <h1 class="adminpagetitle" id="admin">ADMINISTRATIVE PAGE</h1>
            <?php
                echo "<table style='border: solid 1px black;' class='tabella'>"; 
                try {
                    $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql"); // DEFAULT PORT: 3306
                    $pdo->query("USE eserciziologin");
                    $headers = array("Codice","Nome","Cognome","Email","Password","Psalt","Tipologia","","");
                    $value=0;
                    echo ("<tr>");
                    
                    # headers delle estrazioni
                    for($row = 0; $row < count($headers); $row++) {
                        if($row==0){
                            echo ("<th class='headers'> ".$headers[$row]."</th>");
                        }
                        else{
                            echo ("<th class='headers'> ".$headers[$row]."</th>");
                        }
                    }
                    echo ("</tr>");

                    foreach ($pdo->query("SELECT codice, nome, cognome, email, password, psalt, tipologia, imgBackground, imgForeground FROM utente") as $row) {
                        $id=$row['codice'];
                        $tipo=$row['tipologia'];
                        $nome=$row['nome'];
                        $cognome=$row['cognome'];
                        $email=$row['email'];
                        $pass=$row['password'];
                        echo "<tr>
                        <td>$row[codice]</td>
                        <td>$row[nome]</td>
                        <td>$row[cognome]</td>
                        <td>$row[email]</td>
                        <td>$row[password]</td>
                        <td>$row[psalt]</td>
                        <td>$row[tipologia]</td>
                        <td class='cella'><form action='MostraUtenti.php' method='post'><input type='hidden' name='id' value='".$id."'><input type='submit' name='cancella' value='cancella' class='buttoncanc'></form></td>
                        <td class='cella'><form action='MostraUtenti.php' method='post'><input type='hidden' name='tipo' value='".$tipo."'><input type='hidden' name='id' value='".$id."'><input type='submit' name='status' value='cambia status' class='buttonstatus'></form></td>
                        </tr>";
                    }
                    echo('</table>');
                    
                }
                catch(PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $pdo = null;
            ?>
            

            <?php require "../components/footer.php"?>
    </body>
</html>