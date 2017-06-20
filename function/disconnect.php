<?php
    // On démarre la session pour l'arrêter et nous renvoyer sur index.php
session_start();
session_destroy();
header('location: ../index.php');
exit;