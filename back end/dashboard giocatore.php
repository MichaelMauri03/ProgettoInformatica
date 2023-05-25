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
                
                // Verifica se l'utente è autenticato come giocatore
                session_start();
                if (!isset($_SESSION['username']) || $_SESSION['ruolo'] !== 'giocatore') {
                    // Se l'utente non è autenticato o non è un giocatore, reindirizza alla pagina di login
                    header("Location: login.php");
                    exit();
                }
                
                // Ricevi il nome del giocatore dall'autenticazione
                $nome_giocatore = $_SESSION['username'];
                
                // Query per recuperare le statistiche del giocatore
                $query = "SELECT * FROM Giocatore WHERE Nome = '$nome_giocatore'";
                $result = $conn->query($query);
                
                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
                    $nome = $row['Nome'];
                    $cognome = $row['Cognome'];
                    $ruolo = $row['Ruolo'];
                    $numero_gol = $row['Numero_gol_segnati'];
                    $numero_assist = $row['Numero_assist'];
                    $cartellini_gialli = $row['Cartellini_gialli'];
                    $cartellini_rossi = $row['Cartellini_rossi'];
                    $partite_giocate = $row['Partite_giocate']; 
                } else {
                    echo "Giocatore non trovato.";
                }
                
                // Chiudi la connessione al database
                $conn->close();
                ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Giocatore</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1><?php echo $nome . ' '. $cognome ?></h1>
        <div class="card">
            <div class="card-body">
                    <h2 class="card-title">Statistiche</h2>
                    <table class="table">
                        <tr>
                            <th>Ruolo</th>
                            <th>Numero gol segnati</th>
                            <th>Numero assist</th>
                            <th>Cartellini gialli</th>
                            <th>Cartellini rossi</th>
                            <th>Partite giocate</th>
                        </tr>
                            <tr>
                                <td><?php echo $ruolo; ?></td>
                                <td><?php echo $numero_gol; ?></td>
                                <td><?php echo $numero_assist; ?></td>
                                <td><?php echo $cartellini_gialli; ?></td>
                                <td><?php echo $cartellini_rossi; ?></td>
                                <td><?php echo $partite_giocate; ?></td>
                            </tr> 
                    </table>
                    <a href="logout.php" class="btn btn-primary">Logout</a> <!-- Aggiungi il pulsante di logout -->

            </div>
        </div>
    </div>
</body>
</html>
