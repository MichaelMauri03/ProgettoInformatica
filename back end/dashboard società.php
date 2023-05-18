<!-- Dashboard Società -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Società</title>
  <!-- Collegamento a Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Dashboard Società</h1>

    <!-- Elenco dei giocatori -->
    <h2>Giocatori</h2>
    <table class="table">
      <thead>
        <tr>
          <th>Nome</th>
          <th>Cognome</th>
          <th>Ruolo</th>
          <th>Numero di Gol</th>
          <th>Numero di Assist</th>
          <th>Cartellini Gialli</th>
          <th>Cartellini Rossi</th>
          <th>Partite Giocate</th>
          <th>Azioni</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Ottenere l'elenco dei giocatori
        include 'get_giocatori.php';
        $giocatori = getGiocatori();

        // Ciclo per visualizzare i giocatori
        foreach ($giocatori as $giocatore) {
          echo "<tr>";
          echo "<td>" . $giocatore['Nome'] . "</td>";
          echo "<td>" . $giocatore['Cognome'] . "</td>";
          echo "<td>" . $giocatore['Ruolo'] . "</td>";
          echo "<td>" . $giocatore['Numero_gol_segnati'] . "</td>";
          echo "<td>" . $giocatore['Numero_assist'] . "</td>";
          echo "<td>" . $giocatore['Cartellini_gialli'] . "</td>";
          echo "<td>" . $giocatore['Cartellini_rossi'] . "</td>";
          echo "<td>" . $giocatore['Partite_giocate'] . "</td>";
          echo "<td>";
          echo "<button class='btn btn-primary' onclick='apriModificaStatisticheModal(" . $giocatore['ID_giocatore'] . ")'>Modifica</button>";
          echo "<button class='btn btn-danger' onclick='eliminaGiocatore(" . $giocatore['ID_giocatore'] . ")'>Elimina</button>";
          echo "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>

    <!-- Modulo di Modifica Statistiche Calciatore -->
    <div class="modal fade" id="modificaStatisticheModal" tabindex="-1" role="dialog" aria-labelledby="modificaStatisticheModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modificaStatisticheModalLabel">Modifica Statistiche Calciatore</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="modifica_statistiche.php" method="post">
              <input type="hidden" name="id_giocatore" id="id_giocatore" value="">
              <div class="form-group">
                <label for="numero_gol">Numero di Gol:</label>
                <input type="number" class="form-control" name="numero_gol" id="numero_gol" required>
              </div>
              <div class="form-group">
                <label for="numero_assist">Numero di Assist:</label>
                <input type="number" class="form-control" name="numero_assist" id="numero_assist" required>
              </div>
              <div class="form-group">
                <label for="cartellini_gialli">Cartellini Gialli:</label>
                <input type="number" class="form-control" name="cartellini_gialli" id="cartellini_gialli" required>
              </div>
              <div class="form-group">
                <label for="cartellini_rossi">Cartellini Rossi:</label>
                <input type="number" class="form-control" name="cartellini_rossi" id="cartellini_rossi" required>
              </div>
              <div class="form-group">
                <label for="partite_giocate">Partite Giocate:</label>
                <input type="number" class="form-control" name="partite_giocate" id="partite_giocate" required>
              </div>
              <button type="submit" class="btn btn-primary">Salva Modifiche</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Script per popolare il modulo con le statistiche del calciatore selezionato -->
    <script>
    // Funzione per aprire il modulo di modifica statistiche
    function apriModificaStatisticheModal(id_giocatore) {
        // Popola i campi del modulo con i valori del calciatore selezionato
        document.getElementById('id_giocatore').value = id_giocatore;
        // Apri il modulo
        $('#modificaStatisticheModal').modal('show');
      }

    // Funzione per eliminare un giocatore
    function eliminaGiocatore(id_giocatore) {
      /// Richiesta di conferma all'utente prima di eliminare il giocatore
  if (confirm("Sei sicuro di voler eliminare questo giocatore?")) {
    // Effettua una richiesta AJAX per eliminare il giocatore
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // Aggiorna la pagina per visualizzare l'elenco dei giocatori aggiornato
        location.reload();
      }
    };
    xhttp.open("GET", "elimina_giocatore.php?id_giocatore=" + id_giocatore, true);
    xhttp.send();
  }
    }
    </script>

    <!-- Collegamento a jQuery e Bootstrap JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </div>
</body>
</html>

