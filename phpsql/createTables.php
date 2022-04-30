<?php
    try 
    {
        $pdo=new PDO('mysql:dbname=eserciziologin;host=localhost;port=3306', 'root', 'mysql');

        // sql to create table
        $utente = "CREATE TABLE utente (
            codice INT(6) PRIMARY KEY,
            nome VARCHAR(30) NOT NULL,
            cognome VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL,
            password text NOT NULL,
            psalt text NOT NULL,
            tipologia varchar(30) not null,
            imgBackground varchar(200),
            imgForeground varchar(200)
            )";

        $ordini = "CREATE TABLE ordini (
            codice INT(6),
            importo INT(6) NOT NULL,
            indirizzo VARCHAR(30) NOT NULL,
            email VARCHAR(30) NOT NULL,
            dataConsegna DATE NOT NULL,
            stato VARCHAR(30) NOT NULL, 
            utenteID int(6),
            PRIMARY KEY (codice),
            FOREIGN KEY (utenteID) REFERENCES utente(codice)
            )";

        $categorieProdotti = "CREATE TABLE categorieProdotti (
            codice INT(6) PRIMARY KEY,
            categoria varchar(30) not null,
            descrizione text not null,
            prodottoID int(6),
            FOREIGN KEY (prodottoID) REFERENCES prodotti(codice)
            )";
            
        $prodotti = "CREATE TABLE prodotti (
            codice INT(6) PRIMARY KEY,
            nome varchar(30) not null,
            name varchar(30) not null,
            prezzo float(6) not null,
            descrizione text not null,
            description text not null,
            imageurl text not null,
            qtaRimanente int(6) not null
            )";

        $pdo->query($prodotti);
        $pdo->query($utente);
        $pdo->query($ordini);
        $pdo->query($categorieProdotti);
        
    }
    catch (PDOException $err) {
        echo "Errore di connessione al database $dbname\n".$err->getMessage();
    }
    $pdo = null;
?>
        