<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idUser = htmlspecialchars($_POST["idUser"]);
$idChat = htmlspecialchars($_POST["idChat"]);
$date_start = isset($_POST['date_start']) && $_POST['date_start'] ? htmlspecialchars($_POST['date_start']) : null;
$date_end = isset($_POST['date_end']) && $_POST['date_end'] ? htmlspecialchars($_POST['date_end']) : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    updateFA($bdd,$idChat,$idUser,$date_start,$date_end);
    $_SESSION['sucessFa'] = 'Les dates one été bien modifié';
    header('Location: fiche_fa-'.$idUser);
    exit;

    }

?>