<?php
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';
session_start();

$idOPDN = isset($_GET['idOPDN']) ? $_GET['idOPDN'] : null;
$idPhoto = isset($_GET['idPhoto']) ? $_GET['idPhoto'] : null;

$test = supprimerImageOPDN($bdd,$idPhoto,$idOPDN);
$_SESSION['success_opdn_5'] = 'La photo a été bien supprimée';
header('Location:photo_opdn-'.$idOPDN);
exit();

?>