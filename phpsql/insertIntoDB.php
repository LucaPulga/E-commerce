<?php
if(isset($_REQUEST['btnInsert'])){
    $name =  $_REQUEST['name'];
    $price = $_REQUEST['price'];
    $description =  $_REQUEST['description'];
    $urlImage = $_REQUEST['urlImage'];
    $quantity = $_REQUEST['quantity'];

    try 
    {
        $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql"); // DEFAULT PORT: 3306
        $dbname="eserciziologin";
        $tabella="prodotti";
        
        $verifica = $pdo->query("USE $dbname");

        $sqlCountId = "SELECT MAX(codice) as current_max from $tabella";
        $cont = $pdo->query($sqlCountId);
        $supercont = $cont->fetch(PDO::FETCH_ASSOC);
        $tmp = intval($supercont['current_max']);

        $sqlInsert = "INSERT INTO $tabella (codice, nome, prezzo, descrizione, imageurl, qtaRimanente) VALUES ($tmp+1,'$name','$price','$description','$urlImage','$quantity')";

        $pdo->query($sqlInsert);
        $pdo = null;
    }
    catch (PDOException $err) {
        echo "Errore di connessione al database $dbname\n".$err->getMessage();
    }
}   
?>