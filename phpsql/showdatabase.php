<?php
    try {
        $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql"); // DEFAULT PORT: 3306
        $dbname="eserciziologin";
        $verifica = $pdo->query("USE $dbname");
        $stmt = $pdo->query("SHOW DATABASES");
        foreach ($stmt->fetchAll(PDO::FETCH_COLUMN) as $row) {
            print $row."<br>";
        }
        $pdo = null;
    }
    catch (PDOException $err) {
        echo "Errore di connessione al database $dbname\n".$err->getMessage();
    }

    
?>