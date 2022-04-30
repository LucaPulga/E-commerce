<?php
    try 
    {
        $pdo = new PDO("mysql:host=localhost;port=3306", "root", "mysql"); // DEFAULT PORT: 3306
        $dbname="eserciziologin";
        $pdo->query("USE $dbname");

        echo("----------UTENTE----------<br>");
        $tabella="utente";
        $stmt = $pdo->query("SELECT * FROM $tabella");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            echo($row['codice'].' '.$row['nome'].' '.$row['cognome'].' '.$row['email'].' '.$row['password'].' '.$row['psalt'].' '.$row['tipologia'].' '.$row['imgBackground'].' '.$row['imgForeground']."<br>");
        }
        echo("----------ORDINI----------<br>");
        $tabella="ordini";
        $stmt = $pdo->query("SELECT * FROM $tabella");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            echo($row['codice'].' '.$row['importo'].' '.$row['indirizzo'].' '.$row['email'].' '.$row['dataConsegna'].' '.$row['stato'].' '.$row['utenteID'].' '.$row['qta']."<br>");
        }
        echo("----------CATERGORIE PRODOTTI----------<br>");
        $tabella="categorieprodotti";
        $stmt = $pdo->query("SELECT * FROM $tabella");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            echo($row['codice'].' '.$row['categoria'].' '.$row['descrizione'].' '.$row['prodottoID']."<br>");
        }
        echo("----------PRODOTTI----------<br>");
        $tabella="prodotti";
        $stmt = $pdo->query("SELECT * FROM $tabella");
        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $row) {
            echo($row['codice'].' '.$row['nome'].' '.$row['prezzo'].' '.$row['descrizione'].' '.$row['imageurl'].' '.$row['qtaRimanente']."<br>");
        }
        $pdo = null;
    }
    catch (PDOException $err) {
        echo "Errore di connessione al database $dbname\n".$err->getMessage();
    }
?>
        