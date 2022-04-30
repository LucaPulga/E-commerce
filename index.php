<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CyberReason E-commerce</title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/4.1.5/css/flag-icons.min.css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="css/style.css?v=<?php echo time();?>">
        <!-- JavaScript Bundle with Popper -->
        <script src="js/script.js?v=<?php echo time();?>"></script>
    </head>

    <body>
        <?php include "phpsql/createDB.php";?>
        <?php include "phpsql/createTables.php";?>
        <p class="cookie">
            <?php include "utilities/timecookie.php"?>
        </p>
        <div class="topnav" id="myTopnav">
            <img src="img/loog.png" class="logo">
            <span class="rightalignement">
                <div class="dropdown">
                    <button class="dropbtn">
                        <?php include "utilities/languagecookie.php"?>
                    </button>
                    <div class="dropdown-content">
                        <a id="en" onclick="changeToGb()" name="en"><i class="flag-icon flag-icon-gb"></i> </a>
                        <a id="it" onclick="changeToIta()" name="it"><i class="flag-icon flag-icon-it"></i> </a>
                    </div>
                </div>
            </span>
            
            <a href="pages/Login.php" class="alogin" id="alogin"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Login</a> 
            <a href="pages/Registration.php" class="asignup" id="asignup"><i class="fa fa-user-plus" aria-hidden="true" id="icon"></i>Sign up</a>
            
            <?php
                session_start();
                $id = $_SESSION['user'];
                if($id == ''){
                    //header("Location:pages/Login.php");
                    // echo('<a href="pages/Login.php" class="alogin" id="alogin"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Login</a> ');
                    // echo('<a href="pages/Registration.php" class="asignup" id="asignup"><i class="fa fa-user-plus" aria-hidden="true" id="icon"></i>Sign up</a>');
                }
                else if($id == 1){
                    echo('<a href="pages/profile.php" class="asignup" id="asignup"><i class="fa fa-user-circle-o" aria-hidden="true" id="icon"></i></a>');
                    echo('<a href="pages/shoppingCart.php" class="asignup" id="asignup"><i class="fa fa-shopping-cart" aria-hidden="true" id="icon"></i></a>');
                    echo('<a href="pages/logout.php" class="alogin" id="alogout"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Logout</a>');
                    echo('<a href="pages/MostraUtenti.php" class="afooter" id="ausers"><i class="fa fa-database" aria-hidden="true" id="icon"></i>Show users</a>');
                    echo('<a href="pages/MostraProdotti.php" class="afooter" id="ashowproducts"><i class="fa fa-database" aria-hidden="true" id="icon"></i>Show products</a>');
                    echo('<a href="pages/Prodotti.php" class="afooter" id="ainsproduct"><i class="fa fa-product-hunt" aria-hidden="true" id="icon"></i>Insert products</a>');
                    echo('<a href="index.php" class="ahome" id=""><i class="fa fa-home" aria-hidden="true" id="icon"></i>Home</a>');
                    
                }
                else{
                    echo('<a href="pages/profile.php" class="asignup" id="asignup"><i class="fa fa-user-circle-o" aria-hidden="true" id="icon"></i></a>');
                    echo('<a href="pages/shoppingCart.php" class="asignup" id="asignup"><i class="fa fa-shopping-cart" aria-hidden="true" id="icon"></i></a>');
                    echo('<a href="pages/logout.php" class="alogin" id="alogout"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Logout</a>');
                    echo('<a href="index.php" class="ahome" id=""><i class="fa fa-home" aria-hidden="true" id="icon"></i>Home</a>');
                    
                    $pdo=new PDO('mysql:dbname=eserciziologin;host=localhost;port=3306', 'root', 'mysql');
                    $sql = $pdo->query("SELECT * FROM utente WHERE codice='$id'");
                    foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $r){
                        $name = $r['nome'];
                    }
                }
            ?>
            <a href="javascript:void(0);" class="icon" onclick="hamburger()">&#9776;</a>
        </div>
        <br>
        <hr class="divisor">
        
        <video autoplay muted loop id="myVideo">
            <source src="img/spot.mp4" type="video/mp4">
        </video>

        <!-- timer pronto per login e signup con modal, inserire solo codice del modal-->
        <script>
            var date1 = new Date();
            var dateToMilliseconds = date1.getTime();
            var userMinutes = 0.1;
            var addedMinutes = dateToMilliseconds + (60000*userMinutes);
            
            // Set the date we're counting down to
            var countDownDate = new Date(addedMinutes).getTime();

            // Update the count down every 1 second
            var x = setInterval(function() {

                // Get today's date and time
                var now = new Date().getTime();

                // Find the distance between now and the count down date
                var distance = countDownDate - now;

                // Time calculations for days, hours, minutes and seconds
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // If the count down is finished, write some text
                if (distance < 0) {
                    clearInterval(x);
                    
                }
            }, 1000);
        </script>
        
        <div class="container">
            <div class="cardContainer">

                <?php
                    $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql"); // DEFAULT PORT: 3306
                    $dbname="eserciziologin";
                    
                    $verifica = $pdo->query("USE $dbname");
            
                    $tabella="prodotti";
                    $stmt = $pdo->query("SELECT * FROM $tabella");

                    foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
                        $descrizione = substr($row["descrizione"], 0, 20)." ...";
                        echo('<div class="card">');
                        echo('<div class="card__content">');
                        echo('<a href="pages/VisualizzazioneSingoloProdotto.php?dato='.$row["codice"].'">');
                        echo('<img class="imgcard" src="'.$row['imageurl'].'" style="width:100%">');
                        echo('</a>');
                        if(isset($_COOKIE['language'])){
                            if($_COOKIE['language'] == 'it'){
                                echo('<p class="card__info">'.$row['nome'].'</p>');
                            }
                            else{
                                echo('<p class="card__info">'.$row['name'].'</p>');
                            }
                        }else{
                            echo('<p class="card__info">'.$row['name'].'</p>');
                        }
                        echo('</div>');
                        echo('</div>');
                    }
                    $pdo = null;
                ?>
            </div>
        </div>
        
        <div class="container2">
            <div class="row">
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="main-block4__item">
                        <img data-src="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/starterkits-xl@1x.jpg" data-srcset="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/starterkits-xl@2x.jpg 2x" class="cover-media loaded" alt="" srcset="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/starterkits-xl@2x.jpg 2x" src="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/starterkits-xl@1x.jpg" data-was-processed="true">
                        <div class="main-block4__item-content">
                            <h2>Kit di base</h2>
                            <a href="https://ajax.systems/it/products/starterkits/" class="learn-more__link" ><span>Scopri di più</span><span class="icon" aria-hidden="true"><svg width="8" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.385.923L6 6l-4.615 5.077" stroke="currentColor" stroke-width="2"></path></svg></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="main-block4__item">
                        <img data-src="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/hubs-xl@1x.jpg" data-srcset="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/hubs-xl@2x.jpg 2x" class="cover-media loaded" alt="" srcset="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/hubs-xl@2x.jpg 2x" src="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/hubs-xl@1x.jpg" data-was-processed="true">
                        <div class="main-block4__item-content">
                            <h2>Unità centrali</h2>
                            <a href="https://ajax.systems/it/products/hubs/" class="learn-more__link" ><span>Scopri di più</span><span class="icon" aria-hidden="true"><svg width="8" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.385.923L6 6l-4.615 5.077" stroke="currentColor" stroke-width="2"></path></svg></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="main-block4__item">
                        <img data-src="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/leaks-xl@1x.jpg" data-srcset="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/leaks-xl@2x.jpg 2x" class="cover-media loaded" alt="" srcset="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/leaks-xl@2x.jpg 2x" src="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/leaks-xl@1x.jpg" data-was-processed="true">
                        <div class="main-block4__item-content">
                            <h2>Rilevatori allagamenti</h2>
                            <a href="https://ajax.systems/it/products/leaks/" class="learn-more__link" ><span>Scopri di più</span><span class="icon" aria-hidden="true"><svg width="8" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.385.923L6 6l-4.615 5.077" stroke="currentColor" stroke-width="2"></path></svg></span></a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="main-block4__item">
                        <img data-src="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/motion-detectors-xl@1x.jpg" data-srcset="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/motion-detectors-xl@2x.jpg 2x" class="cover-media loaded" alt="" srcset="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/motion-detectors-xl@2x.jpg 2x" src="https://ajax.systems/wp-content/themes/ajax/assets/images/template/frontpage/block4/motion-detectors-xl@1x.jpg" data-was-processed="true">
                        <div class="main-block4__item-content">
                            <h2>Rilevatori di movimento</h2>
                            <a href="https://ajax.systems/it/products/motion-detectors/" class="learn-more__link" ><span>Scopri di più</span><span class="icon" aria-hidden="true"><svg width="8" height="12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.385.923L6 6l-4.615 5.077" stroke="currentColor" stroke-width="2"></path></svg></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="middlePart">
        <div style="text-align:center">
            <h2>Contact Us</h2>
            <p>Swing by for a cup of coffee, or leave us a message:</p>
        </div>
        <div class="row">
            <div class="column">
            <div class="mapouter"><div class="gmap_canvas"><iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=2880%20Broadway,%20New%20York&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><a href="https://fmovies-online.net">fmovies</a><br><style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}</style><a href="https://www.embedgooglemap.net">google maps widget html</a><style>.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style></div></div>
            
            </div>
            <div class="column">
            <form action="">
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="firstname" placeholder="Your name.." class="text">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lastname" placeholder="Your last name.." class="text">

                <label for="subject">Subject</label>
                <textarea id="subject" name="subject" placeholder="Write something.." style="height:170px"></textarea>
                <input type="submit" value="Submit" class="sub">
            </form>
            </div>
        </div>
        </div>

        <?php require "components/footer.php"?>
    </body>
</html>