<?php
    try {
        $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql"); // DEFAULT PORT: 3306
        $dbname="eserciziologin";
        $verifica = $pdo->query("USE $dbname");
        
        if(!$verifica){ // se null, allora creo
            $pdo->query("CREATE DATABASE $dbname");
        }
        $pdo = null;
    }
    catch (PDOException $err) {
        echo "Errore di connessione al database $dbname\n".$err->getMessage();
    }    
?>