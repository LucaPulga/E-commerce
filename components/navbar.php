<?php
    echo('<div class="topnav" id="myTopnav">');
        echo('<img src="'.$srcimg.'" class="logo">');
        echo('<span class="rightalignement">');
            echo('<div class="dropdown">');
                echo('<button class="dropbtn">');
                    echo('<i id="languageSetting" class="flag-icon flag-icon-gb"></i>');
                echo('</button>');
                echo('<div class="dropdown-content">');
                    echo('<a id="en" onclick="changeToGb()"><i class="flag-icon flag-icon-gb"></i> </a>');
                    echo('<a id="it" onclick="changeToIta()"><i class="flag-icon flag-icon-it"></i> </a>');
                echo('</div>');
            echo('</div>');
        echo('</span>');
        echo('<a href="#services" class="asignup" id="asignup"><i class="fa fa-user-circle-o" aria-hidden="true" id="icon"></i></a>');
        echo('<a href="#services" class="asignup" id="asignup"><i class="fa fa-shopping-cart" aria-hidden="true" id="icon"></i></a>');
        echo('<a href="'.$signup.'" class="asignup" id="asignup"><i class="fa fa-user-plus" aria-hidden="true" id="icon"></i>Sign up</a>');
        echo('<a href="'.$login.'" class="alogin" id="alogin"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Login</a>');
        session_start();
        $id = $_SESSION['user'];
        if($id=''){

        }
        if($id == 1){
            echo('<a href="'.$logout.'" class="alogin" id="alogout"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Logout</a>');
            echo('<a href="'.$showusers.'" class="afooter" id="ausers"><i class="fa fa-database" aria-hidden="true" id="icon"></i>Show users</a>');
            echo('<a href="'.$showproducts.'" class="afooter" id="ashowproducts"><i class="fa fa-database" aria-hidden="true" id="icon"></i>Show products</a>');
            echo('<a href="'.$insertproducts.'" class="afooter" id="ainsproduct"><i class="fa fa-product-hunt" aria-hidden="true" id="icon"></i>Insert products</a>');
        }
        else{
            echo('<a href="'.$logout.'" class="alogin" id="alogout"><i class="fa fa-sign-in" aria-hidden="true" id="icon"></i>Logout</a>');
            $pdo=new PDO('mysql:dbname=eserciziologin;host=localhost;port=3306', 'root', 'mysql');
            $sql = $pdo->query("SELECT * FROM utente WHERE codice='$id'");
            foreach($sql->fetchAll(PDO::FETCH_ASSOC) as $r){
                $name = $r['nome'];
            }
        }
    echo('<a href="javascript:void(0);" class="icon" onclick="hamburger()">&#9776;</a>');
    echo('</div>');
?>