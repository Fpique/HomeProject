<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: index.php");
    }
     
    if ( !empty($_POST)) { // Si les les champs sont vides on renvoit un message d'erreur
        $SalarieError = null;
        $CalendrierError = null;
        $HeuresError = null;
         
        // Remplit les champs par ceux de notre DB
        $Salarie = $_POST['Salarie'];
        $Calendrier = $_POST['Calendrier'];
        $Heures = $_POST['Heures'];
         
       $valid = true;
        if (empty($Salarie)) {
            $SalarieError = 'Merci de rentrer le nom du salarié';
            $valid = false;
        }
         
        if (empty($Calendrier)) {
            $CalendrierError = 'Merci de rentrer une date valide';
            $valid = false;
        } 
         
        if (empty($Heures)) {
            $HeuresError = 'Merci de rentrer un horaire valide';
            $valid = false;
        }
         
        //Permet d'updater depuis la DB
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE enregistrement  set salarie = ?, Calendrier = ?, Heures =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($salarie,$Calendrier,$Heures,$id));
            Database::disconnect();
            header("Location: index.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM enregistrement where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $Salarie = $data['salarie'];
        $Calendrier = $data['Calendrier'];
        $Heures = $data['Heures'];
        Database::disconnect();

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
                        <h3>Updater un Salarié</h3>
                    </div>
             
                    <form class="form-horizontal" action="ajouter.php" method="post">
                      <div class="control-group <?php echo !empty($salarieError)?'erreur':'';?>">
                        <label class="control-label">Salarié</label>
                        <div class="controls">
                            <input name="Salarie" type="text"  placeholder="Salarie" value="<?php echo !empty($Salarie)?$Salarie:'';?>">
                            <?php if (!empty($SalarieError)): ?>
                                <span class="help-inline"><?php echo $SalarieError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($CalendrierError)?'erreur':'';?>">
                        <label class="control-label">Calendrier</label>
                        <div class="controls">
                            <input name="Calendrier" type="date" placeholder="Calendrier" value="<?php echo !empty($Calendrier)?$Calendrier:'';?>">
                            <?php if (!empty($CalendrierError)): ?>
                                <span class="help-inline"><?php echo $CalendrierError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($HeuresError)?'error':'';?>">
                        <label class="control-label">Heures travaillés</label>
                        <div class="controls">
                            <input name="Heures" type="time"  placeholder="Heures" value="<?php echo !empty($Heures)?$Heures:'';?>">
                            <?php if (!empty($HeuresError)): ?>
                                <span class="help-inline"><?php echo $HeuresError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Updater</button>
                          <a class="btn" href="index.php">Retour</a>
                        </div>
                    </form>
                </div>
                 
    </div>
  </body>
</html>
        