<?php
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';
session_start();

$idEvent = isset($_GET['idEvent']) ? $_GET['idEvent'] : null;
$idPhoto = isset($_GET['idPhoto']) ? $_GET['idPhoto'] : null;

supprimerImageEvent($bdd,$idPhoto,$idEvent);

$_SESSION['success_13'] = 'L\'affiche a été bien supprimé';
header('Location:affiche_event-'.$idEvent);
exit();

?>