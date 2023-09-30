<?php
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

if (isset($_GET['id'])) {
    $idChat = intval($_GET['id']);
}

$chat = getChatById($bdd,$idChat);

$test = deleteChat($bdd,$idChat);

// var_dump($test);
$_SESSION['success_2'] = $chat['nom_chat'].' est bien supprimé';
header('Location:gestion_chats');
exit();
?>