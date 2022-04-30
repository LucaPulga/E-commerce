<?php
    if(isset($_COOKIE['orario'])){
        date_default_timezone_set('Europe/Rome');
        setcookie('orario',date('l jS \of F Y h:i:s A'));
        echo "Last access ".$_COOKIE['orario'];
    }
    else{
        echo "Benvenuto!";
        date_default_timezone_set('Europe/Rome');
        setcookie('orario',date('l jS \of F Y h:i:s A'),time()+24000);
    }
?>