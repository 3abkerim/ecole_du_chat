<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idUser = htmlspecialchars($_POST["idUser"]);
$idChat = htmlspecialchars($_POST["idChat"]);
$chat = getChatById($bdd,$idChat);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['idChat'])) {
        $_SESSION['error_fa'] = 'Veuillez choisir le chat';
        header('Location: fiche_fa-'.$idUser);
        exit;
    }else{
    insertFA($bdd,$idChat,$idUser);
    $_SESSION['success_fa'] = $chat['nom_chat'].' a été ajouté avec succès.';
    header('Location:fiche_fa-'.$idUser);
    exit;
    }
}



?>