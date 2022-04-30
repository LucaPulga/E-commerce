<?
    session_start();
    if(isset($_SESSION['user']) && $_SESSION['user']!=''){header("Location:../index.php");}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CyberReason Login</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="../css/styleLogin.css?v=<?php echo time();?>">
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

            <?php
                $id = $_SESSION['user'];
                //$isAdmin = $_SESSION['isAdmin'];
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
        
        <div class="main_div">
            <div class="title">Login Form</div>
            <div class="social_icons">
            <a href="https://it-it.facebook.com/"><i class="fa fa-facebook" aria-hidden="true"></i><span>Facebook</span></a>
            <a href="https://twitter.com/i/flow/login"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twitter</span></a>
            </div>
            <form action="Login.php" method="POST">
                <div class="input_box">
                    <input type="email" name="email" placeholder="Email" required>
                    <div class="icon"><i class="fa fa-envelope" aria-hidden="true"></i></div>
                </div>
                <div class="input_box">
                    <input type="password" name="password" placeholder="Password" required>
                    <div class="icon"><i class="fa fa-unlock-alt" aria-hidden="true"></i></div>
                </div>
                <div class="option_div">
                    <div class="check_box">
                    <input type="checkbox" name="rememberme">
                    <span class="pad">Remember me</span>
                    </div>
                    <div class="forget_div">
                    <a href="#" class="pad">Forgot password?</a>
                    </div>
                </div>
                <div class="input_box button">
                    <input type="submit" value="Login" name="login">
                </div>
                <div class="sign_up" class="pad">
                     <a href="Registration.php" class="pad"> Not a member? Signup now</a>
                </div>
                <?php
                    $pdo=new PDO('mysql:dbname=eserciziologin;host=localhost;port=3306', 'root', 'mysql');

                    if(isset($_POST['email']) && isset($_POST['password'])){

                        $email=$_POST['email'];
                        $psw=$_POST['password'];

                        $password=''; //admin: subinsiby
                        $p_salt='';
                        $id=0;
                        $name='';
                        $dbemail='';
                        $nome='';

                        $sql = $pdo->query("SELECT * FROM utente WHERE email='$email'");
                        if($sql->rowCount() > 0){
                            foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $r){
                                $password=$r['password'];
                                $p_salt=$r['psalt'];
                                $id=$r['codice'];
                                $name=$r['nome'];
                                $dbemail=$r['email'];
                                $nome=$r['nome'];
                            }
                        }
                        $site_salt="subinsblogsalt";/*Common Salt used for password storing on site. You can't change it. If you want to change it, change it when you register a user.*/
                        $salted_hash = hash('sha256',$psw.$site_salt.$p_salt);
                        
                        if($password==$salted_hash){
                            $_SESSION['user']=$id;
                            echo("<script language='javascript'> alert('Benvenuto $nome'); window.location.href='../index.php'</script>");
                        }
                        else{
                            echo("<script language='javascript'> alert('Utente non registrato'); </script>");
                        }
                    }
                ?>
            </form>
        </div>

        
        <?php require "../components/footer.php"?>
    </body>
</html>