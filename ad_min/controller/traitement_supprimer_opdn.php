<?php
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

if (isset($_GET['id'])) {
    $idOPDN = intval($_GET['id']);
}

$opdn = getOPDNById($bdd,$idOPDN);

$test = deleteOPDN($bdd,$idOPDN);

// var_dump($opdn);

// var_dump($test);
$_SESSION['success_opdn_3'] ='article nº'.$opdn['id_on_parle_de_nous'].' est bien supprimé';
header('Location:gestion_opdn');
exit();
?>