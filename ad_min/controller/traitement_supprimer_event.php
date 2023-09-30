<?php
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

if (isset($_GET['id'])) {
    $idEvent = intval($_GET['id']);
}

$event = getEventById($bdd,$idEvent);

$test = deleteEvent($bdd,$idEvent);

// var_dump($test);
$_SESSION['success_2'] = $event['event'].' est bien supprimé';
header('Location:gestion_events');
exit();
?>