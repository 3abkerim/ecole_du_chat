<?php

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$id = $_POST['id'];
$publie = $_POST['publie'];

updatePublish($bdd,$id,$publie);


?>