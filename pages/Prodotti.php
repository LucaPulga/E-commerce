<?php
    session_start();
    $id = $_SESSION['user'];
    if($id!=1){header("Location:../index.php");}
?>
<!DOCTYPE html>
<html>  
    <head>
        <meta charset="UTF-8">
        <title>CyberReason inserisci prodotto</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="../css/styleInsertProdotti.css?v=<?php echo time();?>">
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
                    $pdo = null;
                }
            ?>
            <a href="javascript:void(0);" class="icon" onclick="hamburger()">&#9776;</a>
        </div>
        <hr class="divisor">

        <div class="container2">
            <div class="title">Add products</div>
            <div class="content">   
                <form action="Prodotti.php" method="POST">
                    <div class="user-details">
                    <div class="input-box">
                        <span class="details">Nome</span>
                        <input type="text" name="nome" placeholder="Inserisci nome prodotto" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input type="text" name="name" placeholder="Enter product name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Prezzo</span>
                        <input type="number" step="0.01" name="price" placeholder="Enter price" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Descrizione</span>
                        <input type="text" name="descrizione" placeholder="Inserisci descrizione" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Description</span>
                        <input type="text" name="description" placeholder="Enter description" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Url image</span>
                        <input type="text" name="urlImage" placeholder="Enter image url" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Quantity</span>
                        <input type="number" name="quantity" placeholder="Enter quantity" required>
                    </div>
                </div>
                <div class="button" id="insert">
                    <input type="submit" value="Insert" name="btnInsert">
                </div>
                <?php
                    if(isset($_POST['btnInsert'])){
                        $nome = $_POST['nome'];
                        $name =  $_POST['name'];
                        $price = $_POST['price'];
                        $description =  $_POST['description'];
                        $descrizione =  $_POST['descrizione'];
                        $urlImage = $_POST['urlImage'];
                        $quantity = $_POST['quantity'];

                        try 
                        {
                            $pdo=new PDO('mysql:dbname=eserciziologin;host=localhost;port=3306', 'root', 'mysql');
                            
                            $sqlCountId = "SELECT MAX(codice) as current_max from prodotti";
                            $cont = $pdo->query($sqlCountId);
                            $supercont = $cont->fetch(PDO::FETCH_ASSOC);
                            $tmp = intval($supercont['current_max']);
                            $sqlInsert = "INSERT INTO prodotti (codice, nome, name, prezzo, descrizione, description, imageurl, qtaRimanente) VALUES ($tmp+1,'$nome','$name',$price,'$descrizione','$description','$urlImage',$quantity)";
                            
                            $pdo->query($sqlInsert);
                            echo("<script language='javascript'> alert('ok');</script>");
                        }
                        catch (PDOException $err) {
                            echo "Errore di connessione al database $dbname\n".$err->getMessage();
                        }
                        $pdo = null;
                    }   
                ?>
            </form>
            </div>
        </div>

        <?php require "../components/footer.php"?>
    </body>
</html>