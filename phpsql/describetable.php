<?php
    try 
    {
        $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql"); // DEFAULT PORT: 3306
        $dbname="eserciziologin";
        $tabella= array("utente","ordini","prodotti","categorieprodotti");

        $pdo->query("USE $dbname");
        foreach($tabella as $current){
            echo("---------------<br>");
            echo("TABLE: $current <br>");
            $stmt = $pdo->query("DESCRIBE $current");
            foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $row) {
                print $row."<br>";
            }
        }
        $pdo = null;
    }
    catch (PDOException $err) {
        echo "Errore di connessione al database $dbname\n".$err->getMessage();
    }
?>
        