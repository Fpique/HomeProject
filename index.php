<?php
  session_start();
  if($_SESSION['isConnected'] == True) {
    // Do nothing
  } else {
    // Sinon on renvoit sur loginRegister.php
    header('Location: function/loginRegister.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!-- On appelle bootstrap pour l'utiliser -->
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
              <p>
              <!--Bouton Ajouter et Deconnexion -->
                    <a href="ajouter.php" class="btn btn-success">Ajouter</a>
                    <a href="function/disconnect.php" class="btn btn-danger">Deconnexion</a>
                </p>
                <h3>Compte horaire Salarié</h3>
            </div>
               <!-- Tableau avec colonne id, Salarié, Calendrier et Heures travaillés -->
            <div class="row">
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>id</th>                    
                      <th>Salarié</th>
                      <th>Calendrier</th>
                      <th>Heures travaillés</th>
                    </tr>
                  </thead>
                  <tbody>
<?php
           // On va récupérer les infos de notre base de donnéeà travers la variable  row que l'on a défini
           include 'database.php';
           $pdo = Database::connect();
           $sql = 'SELECT * FROM enregistrement ORDER BY id DESC';
           foreach ($pdo->query($sql) as $row) {
                    echo '<tr>';
                    echo '<td>'. $row['id'] . '</td>';
                    echo '<td>'. $row['salarie'] . '</td>';    
                    echo '<td>'. $row['Calendrier'] . '</td>'; 
                    echo '<td>'. $row['Heures'] . '</td>';   
                    echo '<td width=250>';

                                // On rajoute nos 3 boutons Read, Update, et Delete
                                echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="update.php?id='.$row['id'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
           }
           Database::disconnect();
?>
                  </tbody>
            </table>
        </div>
    </div>
    <!-- Code Konami -->
       <script type="text/javascript">
          if ( window.addEventListener ) {  
          var state = 0, konami = [38,38,40,40,37,39,37,39,66,65];   // Variable state = code Konami, les nombres correspondent aux touches
          window.addEventListener("keydown", function(e) {  
          if ( e.keyCode == konami[state] ) state++;  
          else state = 0;  
          if ( state == 10 ) // Si le code est OK alors on redirige vers window.location etc 
          window.location = "http://www.latlmes.com/world/your-sensational-news-article-headline-1";  //On écrit le site ou l'on souhaite etre redirigé
          }, true);
}  
</script>
  </body>
</html>