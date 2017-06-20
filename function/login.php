<?php
// On ce connecte à la table User 
$db = new PDO('mysql:host=localhost;dbname=user', 'root', '0000');
// On définit la var user par ce que l'on a noté dans notre base de donnée pour le username et le password
$user = $db->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
$user->bindParam(':username', $_POST['username']);
$user->bindParam(':password', $_POST['password']);
$user->execute();
  // Si $user ne correspond pas alord on renvoit sur Wrongpassword.php qui nous renverra sur login.Register.php
    if($user->fetch() == False) {
      header('Location: Wrongpassword.php');
    } else { // Sinon on initie la session et on ce retrouve sur index.php
      session_start();
      $_SESSION['isConnected'] = True;
      header('Location: ../index.php');
    }
    ?>
