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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera i dati dalla richiesta POST
    $id_giocatore = $_POST["id_giocatore"];
    $numero_gol = $_POST["numero_gol"];
    $numero_assist = $_POST["numero_assist"];
    $cartellini_gialli = $_POST["cartellini_gialli"];
    $cartellini_rossi = $_POST["cartellini_rossi"];
    $partite_giocate = $_POST["partite_giocate"];
}

// Query per aggiornare le statistiche del giocatore nel database
$sql = "UPDATE Giocatore SET Numero_gol_segnati = $numero_gol, Numero_assist = $numero_assist, 
        Cartellini_gialli = $cartellini_gialli, Cartellini_rossi = $cartellini_rossi, 
        Partite_giocate = $partite_giocate WHERE ID_giocatore = $id_giocatore";

if ($conn->query($sql) === TRUE) {
    // Reindirizza alla pagina della società dopo l'aggiornamento delle statistiche
    header('Location: dashboard società.php');
    exit();
} else {
    echo "Errore durante l'aggiornamento delle statistiche del giocatore: " . $conn->error;
}

// Chiudi la connessione al database
$conn->close();
?>
