<?php
// Connessione al database

function getGiocatori() {
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "giocatori";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Query per ottenere l'elenco dei giocatori
$sql = "SELECT * FROM Giocatore";
$result = $conn->query($sql);

$giocatori = array();

// Popola l'array con i dati dei giocatori
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $giocatori[] = $row;
    }
}

// Chiudi la connessione al database
$conn->close();

// Restituisci l'array dei giocatori
return $giocatori;
}
?>
