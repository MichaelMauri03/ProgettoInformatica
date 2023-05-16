<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagina della Società</title>
  <!-- Collegamento ai file CSS di Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8">
        <h2>Dashboard della Società</h2>
        <hr>
        <h4>Elenco Giocatori</h4>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Cognome</th>
              <th>Ruolo</th>
              <th>Numero Gol Segnati</th>
              <th>Numero Assist</th>
              <th>Cartellini Gialli</th>
              <th>Cartellini Rossi</th>
              <th>Partite Giocate</th>
              <th>Azioni</th>
            </tr>
          </thead>
          <tbody>
            <!-- Itera su ogni giocatore -->
            <?php
            // Includi il file di backend per ottenere i giocatori
            include 'get_giocatori.php';
            
            // Esegui la query per ottenere i giocatori
            $giocatori = getGiocatori();

            // Mostra i giocatori nell'elenco
            foreach ($giocatori as $giocatore) {
              echo "<tr>";
              echo "<td>{$giocatore['ID_giocatore']}</td>";
              echo "<td>{$giocatore['Nome']}</td>";
              echo "<td>{$giocatore['Cognome']}</td>";
              echo "<td>{$giocatore['Ruolo']}</td>";
              echo "<td>{$giocatore['Numero_gol_segnati']}</td>";
              echo "<td>{$giocatore['Numero_assist']}</td>";
              echo "<td>{$giocatore['Cartellini_gialli']}</td>";
              echo "<td>{$giocatore['Cartellini_rossi']}</td>";
              echo "<td>{$giocatore['Partite_giocate']}</td>";
              echo "<td>";
              echo "<a href='modifica_statistiche.php?id={$giocatore['ID_giocatore']}' class='btn btn-primary btn-sm'>Modifica</a>";
              echo "<a href='elimina_giocatore.php?id={$giocatore['ID_giocatore']}' class='btn btn-danger btn-sm ml-2'>Elimina</a>";
              echo "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <h4>Aggiungi Giocatore</h4>
        <form method="POST" action="aggiungi_giocatore.php">
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
              <label for="cognome">Cognome</label>
              <input type="text" class="form-control" id="cognome" name="cognome" required>
            </div>
            <div class="form-group">
              <label for="ruolo">Ruolo</label>
              <input type="text" class="form-control" id="ruolo" name="ruolo" required>
            </div>
            <div class="form-group">
              <label for="numero_gol">Numero Gol Segnati</label>
              <input type="number" class="form-control" id="numero_gol" name="numero_gol" required>
            </div>
          <div class="form-group">
            <label for="numero_assist">Numero Assist</label>
            <input type="number" class="form-control" id="numero_assist" name="numero_assist" required>
          </div>
          <div class="form-group">
              <label for="cartellini_gialli">Cartellini Gialli</label>
              <input type="number" class="form-control" id="cartellini_gialli" name="cartellini_gialli" required>
          </div>
          <div class="form-group">
              <label for="cartellini_rossi">Cartellini Rossi</label>
              <input type="number" class="form-control" id="cartellini_rossi" name="cartellini_rossi" required>
           </div>
          <div class="form-group">
              <label for="partite_giocate">Partite Giocate</label>
              <input type="number" class="form-control" id="partite_giocate" name="partite_giocate" required>
            </div>
          <button type="submit" class="btn btn-success">Aggiungi</button>
        </form>
</div>
</div>

  </div>
  <!-- Collegamento ai file JavaScript di Bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
