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

// Verifica se l'utente è autenticato come società
session_start();
if (!isset($_SESSION['username']) || $_SESSION['ruolo'] !== 'societa') {
    // Se l'utente non è autenticato o non è una società, reindirizza alla pagina di login
    header("Location: login.php");
    exit();
}

// Ricevi il nome della società dall'autenticazione
$nome_societa = $_SESSION['username'];

// Query per trovare l'ID della società
$query = "SELECT ID_societa FROM Societa WHERE Nome_societa = '$nome_societa'";
$result = $conn->query($query);

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $id_societa = $row['ID_societa'];

    // Ricevi i dati del nuovo giocatore dal modulo di aggiunta
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email']
    $password = $_POST['password'];
    $numero_gol = $_POST['numero_gol'];
    $numero_assist = $_POST['numero_assist'];
    $cartellini_gialli = $_POST['cartellini_gialli'];
    $cartellini_rossi = $_POST['cartellini_rossi'];
    $partite_giocate = $_POST['partite_giocate'];

    // Controlla se esiste già un giocatore con lo stesso nome e cognome
    $giocatore_check_query = "SELECT * FROM Giocatore WHERE Nome = '$nome' AND Cognome = '$cognome'";
    $giocatore_check_result = $conn->query($giocatore_check_query);

    if ($giocatore_check_result->num_rows > 0) {
        echo "Errore durante l'aggiunta del giocatore: il giocatore esiste già nel database.";
    } else {
        // Query per aggiungere il nuovo giocatore al database
        $sql = "INSERT INTO Giocatore (ID_societa, Nome, Cognome, Email_giocatore, Password_giocatore, Ruolo, Numero_gol_segnati, Numero_assist, 
                Cartellini_gialli, Cartellini_rossi, Partite_giocate) 
                VALUES ($id_societa, '$nome', '$cognome', '$email', '$password', '$ruolo', $numero_gol, $numero_assist, 
                $cartellini_gialli, $cartellini_rossi, $partite_giocate)";

        if ($conn->query($sql) === TRUE) {
            // Reindirizza alla dashboard della società dopo l'aggiunta del giocatore
            header('Location: dashboard società.php');
            exit();
        } else {
            echo "Errore durante l'aggiunta del giocatore: " . $conn->error;
        }
    }
} else {
    echo "Società non trovata.";
}

// Chiudi la connessione al database
$conn->close();
?>

