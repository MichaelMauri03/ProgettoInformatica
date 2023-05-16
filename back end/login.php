<?php
// Connessione al database (assumendo che tu abbia configurato correttamente le credenziali di connessione)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "giocatori";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Ricevi i dati di accesso inviati dal modulo di login
$email = $_POST['email'];
$password = $_POST['password'];

// Verifica se l'email e la password corrispondono a una società
$sqlSocieta = "SELECT * FROM Societa WHERE Email_amministratore = '$email' AND Password_amministratore = '$password'";
$resultSocieta = $conn->query($sqlSocieta);

// Verifica se l'email e la password corrispondono a un giocatore
$sqlGiocatore = "SELECT * FROM Giocatore WHERE Email_giocatore = '$email' AND Password_giocatore = '$password'";
$resultGiocatore = $conn->query($sqlGiocatore);

// Gestisci il reindirizzamento in base all'appartenenza a una società o a un giocatore
if ($resultSocieta->num_rows > 0) {
    // L'email appartiene a una società, reindirizzamento alla pagina della società
    header('Location: dashboard società.php');
    exit();
} elseif ($resultGiocatore->num_rows > 0) {
    // L'email appartiene a un giocatore, reindirizzamento alla pagina del giocatore
    header('Location: pagina_giocatore.php');
    exit();
} else {
    // Credenziali non valide, reindirizzamento alla pagina di accesso con messaggio di errore
    header('Location: accesso.php?errore=1');
    exit();
}

// Chiudi la connessione al database
$conn->close();
?>
