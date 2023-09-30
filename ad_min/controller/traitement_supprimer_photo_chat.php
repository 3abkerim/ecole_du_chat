<?php
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';
session_start();

$idChat = isset($_GET['idChat']) ? $_GET['idChat'] : null;
$idPhoto = isset($_GET['idPhoto']) ? $_GET['idPhoto'] : null;

supprimerImageChat($bdd,$idPhoto,$idChat);

$_SESSION['success_5'] = 'La photo a été bien supprimé';
header('Location:saisie_photos_chat-'.$idChat);
exit();

?>