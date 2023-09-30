<?php
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

if (isset($_GET['idChat'])) {
    $idChat = intval($_GET['idChat']);
}
if (isset($_GET['idUser'])) {
    $idUser = intval($_GET['idUser']);
}

$chat = getChatById($bdd,$idChat);

$test = deleteChatFamille($bdd,$idChat,$idUser);

// var_dump($test);
$_SESSION['success_fa_2'] = $chat['nom_chat'].' a été bien supprimé';
header('Location:fiche_fa-'.$idUser);
exit();
?>