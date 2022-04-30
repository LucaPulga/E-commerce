
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CyberReason Registrazione</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="../css/styleRegistration.css?v=<?php echo time();?>">
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
            <a href="Login.php" class="alogin" id="alogin"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Login</a> 
            <a href="Registration.php" class="asignup" id="asignup"><i class="fa fa-user-plus" aria-hidden="true" id="icon"></i>Sign up</a>
            <a href="../index.php" class="ahome" id=""><i class="fa fa-home" aria-hidden="true" id="icon"></i>Home</a>

            <a href="javascript:void(0);" class="icon" onclick="hamburger()">&#9776;</a>
        </div>
        <hr class="divisor">

        <div class="container2">
            <div class="title">Registration</div>
            <div class="content">   
                <form action="Registration.php" method="POST">
                    <div class="user-details">
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input type="text" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Surname</span>
                        <input type="text" name="surname" placeholder="Enter your surname" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Email</span>
                        <input type="email"  name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Password</span>
                        <input type="password"  name="password" placeholder="Enter your password" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Background image</span>
                        <input type="text" name="imgB" placeholder="Enter your background image url" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Foreground image</span>
                        <input type="text" name="imgF" placeholder="Enter your foreground image url" required>
                    </div>
                </div>
                <div class="button" id="register">
                    <input type="submit" value="Register" name="btnRegister">
                </div>
                
                <?php
                    if(isset($_POST['btnRegister'])){
                        $nome=$_POST['name'];
                        $cognome=$_POST['surname'];
                        $email=$_POST['email'];
                        $password=$_POST['password'];
                        $imgB = $_POST['imgB'];
                        $imgF = $_POST['imgF'];
                        try 
                        {
                            $pdo=new PDO('mysql:dbname=eserciziologin;host=localhost;port=3306', 'root', 'mysql');

                            $sqlInsert = "SELECT COUNT(*) FROM utente WHERE email='$email'";
                            $sql = $pdo->query($sqlInsert);

                            if($sql->fetchColumn()!=0){
                                echo("<script language='javascript'> alert('User already exists.');</script>");
                            }
                            else
                            {
                                function rand_string($length) {
                                    $str="";
                                    $chars = "subinsblogabcdefghijklmanopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
                                    $size = strlen($chars);
                                    for($i = 0;$i < $length;$i++) {
                                        $str .= $chars[rand(0,$size-1)];
                                    }
                                    return $str;
                                }
                                $p_salt = rand_string(20);
                                $site_salt="subinsblogsalt"; /*Common Salt used for password storing on site.*/
                                $salted_hash = hash('sha256', $password.$site_salt.$p_salt);

                                $sqlCountId = "SELECT MAX(codice) as current_max from utente";
                                $cont = $pdo->query($sqlCountId);
                                $supercont = $cont->fetch(PDO::FETCH_ASSOC);
                                $tmp = intval($supercont['current_max']);
                                if($tmp == 0){
                                    $tipologia = 'admin'; // il primo iscritto sarà il super-admin
                                }
                                else{
                                    $tipologia='customer';
                                }
                                
                                $sqlInsert = "INSERT INTO utente (codice, nome, cognome, email, password, psalt, tipologia, imgBackground, imgForeground) VALUES ($tmp+1,'$nome','$cognome','$email','$salted_hash','$p_salt','$tipologia','$imgB','$imgF')";
                                $pdo->query($sqlInsert);
                                echo("<script language='javascript'> alert('Benvenuto!');</script>");
                            }
                            $pdo = null;
                        }
                        catch (PDOException $err) {
                            echo "Errore di connessione al database $dbname\n".$err->getMessage();
                        }
                    }

                ?>
            </form>
            </div>
        </div>

        <?php require "../components/footer.php"?>
    </body>
</html>