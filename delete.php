<?php
    require 'database.php';
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        $id = $_POST['id'];
         
        // On supprime de la base de donnée
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM enregistrement  WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        Database::disconnect();
        header("Location: index.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Supprimer un salarié</h3>
                    </div>
                     <!-- Une fois cliqué sur Delete on rajoute le Bouton YES/NO
                     Si YES on supprime sinon on retourne sur index.php  -->
                    <form class="form-horizontal" action="delete.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">You sure my nigga ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yeah Fuck that shit</button>
                          <a class="btn" href="index.php">Nop</a>
                        </div>
                    </form>
                </div>
                 
    </div> 
  </body>
</html>