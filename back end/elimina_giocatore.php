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

// Ricevi l'ID del giocatore da eliminare dalla query string
$id = $_GET['id'];

// Query per eliminare il giocatore dal database
$sql = "DELETE FROM Giocatore WHERE ID_giocatore = $id";

if ($conn->query($sql) === TRUE) {
// Reindirizza alla pagina della società dopo l'eliminazione del giocatore
header('Location: pagina_societa.php');
exit();
} else {
echo "Errore durante l'eliminazione del giocatore: " . $conn->error;
}

// Chiudi la connessione al database
$conn->close();
?>
    
