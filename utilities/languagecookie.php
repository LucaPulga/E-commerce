<?php
    if(isset($_COOKIE['language'])){
        if($_COOKIE['language'] == 'it'){
            echo('<i id="languageSetting" class="flag-icon flag-icon-it"></i>');
            setcookie("language","it",time()+3600*60,'/');
        }
        else{
            echo('<i id="languageSetting" class="flag-icon flag-icon-gb"></i>');
            setcookie("language","en",time()+3600*60,'/');
        }
    }else{
        echo('<i id="languageSetting" class="flag-icon flag-icon-gb"></i>');
        setcookie("language","en",time()+3600*60,'/');
    }
?>