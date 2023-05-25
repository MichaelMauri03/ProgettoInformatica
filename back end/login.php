<?php
// Avvia la sessione
session_start();

// Connessione al database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "giocatori";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connessione al database fallita: " . $conn->connect_error);
}

// Verifica se l'utente è già autenticato
if (isset($_SESSION['username'])) {
    // Se l'utente è già autenticato, reindirizza alla dashboard corrispondente
    if ($_SESSION['ruolo'] === 'societa') {
        header("Location: dashboard società.php");
    } else {
        header("Location: dashboard giocatore.php");
    }
    exit();
}

// Verifica se è stato inviato il modulo di login
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query per cercare una società con l'email e password specificate
    $query = "SELECT * FROM Societa WHERE Email_amministratore = '$email' AND Password_amministratore = '$password'";
    $result = $conn->query($query);

    if ($result->num_rows === 1) {
        // Autenticazione riuscita: l'utente è una società
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['Nome_societa'];
        $_SESSION['ruolo'] = 'societa';
        header("Location: dashboard società.php");
        exit();
    } else {
        // Query per cercare un giocatore con l'email e password specificate
        $query = "SELECT * FROM Giocatore WHERE Email_giocatore = '$email' AND Password_giocatore = '$password'";
        $result = $conn->query($query);

        if ($result->num_rows === 1) {
            // Autenticazione riuscita: l'utente è un giocatore
            $row = $result->fetch_assoc();
            $_SESSION['username'] = $row['Nome'];
            $_SESSION['ruolo'] = 'giocatore';
            header("Location: dashboard giocatore.php");
            exit();
        } else {
            // Autenticazione fallita
            $error = "Email o password non validi";
        }
    }
}

// Chiudi la connessione al database
$conn->close();
?>