<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idEvent = htmlspecialchars($_POST['id_event']);
$event = ucfirst(isset($_POST['event']) ? htmlspecialchars($_POST['event']) : '');
$dateEvent = isset($_POST['date_event']) && $_POST['date_event'] ? htmlspecialchars($_POST['date_event']) : null;
$dateFinEvent = isset($_POST['date_fin_event']) && $_POST['date_fin_event'] ? htmlspecialchars($_POST['date_fin_event']) : null;


// echo $idArticle;
// echo ' ';
// echo $titre_article;
// echo ' ';
// echo $article;
// echo ' ';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['event']) || empty($_POST['date_event'])) {
        $_SESSION['error_12'] = 'Veuillez remplir les cases de l\'évènement';
        header("Location: fiche_event-".$idEvent);
        exit;

    }else{
        $update = updateEvent($bdd,$idEvent,$event,$dateEvent,$dateFinEvent);
        $_SESSION['success_12'] ='Les données de l\'évènement ont été bien modifié';
        header("Location: fiche_event-".$idEvent);
        exit();

    }
}

?>