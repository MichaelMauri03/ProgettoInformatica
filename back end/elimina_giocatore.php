<?php
// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "giocatori";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Verifica se è stato fornito l'ID del giocatore da eliminare
if (isset($_GET['id_giocatore'])) {
    $id_giocatore = $_GET['id_giocatore'];

    // Query per eliminare il giocatore
    $sql = "DELETE FROM Giocatore WHERE ID_giocatore = $id_giocatore";

    if ($conn->query($sql) === TRUE) {
        echo "Giocatore eliminato con successo";
    } else {
        echo "Errore durante l'eliminazione del giocatore: " . $conn->error;
    }
}

// Chiudi la connessione al database
$conn->close();
?>
    
