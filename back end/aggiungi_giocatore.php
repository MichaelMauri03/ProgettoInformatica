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

// Ricevi i dati del nuovo giocatore dal modulo di aggiunta
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$ruolo = $_POST['ruolo'];
$numero_gol = $_POST['numero_gol'];
$numero_assist = $_POST['numero_assist'];
$cartellini_gialli = $_POST['cartellini_gialli'];
$cartellini_rossi = $_POST['cartellini_rossi'];
$partite_giocate = $_POST['partite_giocate'];

// Query per aggiungere il nuovo giocatore al database
$sql = "INSERT INTO Giocatore (Nome, Cognome, Ruolo, Numero_gol_segnati, Numero_assist, 
        Cartellini_gialli, Cartellini_rossi, Partite_giocate) 
        VALUES ('$nome', '$cognome', '$ruolo', $numero_gol, $numero_assist, 
        $cartellini_gialli, $cartellini_rossi, $partite_giocate)";

if ($conn->query($sql) === TRUE) {
    // Reindirizza alla pagina della società dopo l'aggiunta del giocatore
    header('Location: pagina_societa.php');
    exit();
} else {
    echo "Errore durante l'aggiunta del giocatore: " . $conn->error;
}

// Chiudi la connessione al database
$conn->close();
?>