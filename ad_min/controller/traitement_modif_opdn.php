<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idOPDN = htmlspecialchars($_POST['id_opdn']);
$titre = ucfirst(isset($_POST['titre']) ? htmlspecialchars($_POST['titre']) : '');
$lien = isset($_POST['lien']) ? htmlspecialchars($_POST['lien']) : '';
$date_pub = isset($_POST['date_pub']) && $_POST['date_pub'] ? htmlspecialchars($_POST['date_pub']) : null;
$par_qui = ucfirst(isset($_POST['par_qui']) ? htmlspecialchars($_POST['par_qui']) : '');


// echo $idArticle;
// echo ' ';
// echo $titre_article;
// echo ' ';
// echo $article;
// echo ' ';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['titre']) || empty($_POST['lien'])) {
        $_SESSION['error_opdn_2'] = 'Veuillez remplir les cases de l\'article';
        header("Location:fiche_opdn-".$idOPDN);
        exit;

    }else{
        $update = updateOPDN($bdd,$idOPDN,$titre,$lien,$date_pub,$par_qui);
        $_SESSION['success_opdn_2'] ='Les données de l\'article ont été bien modifié';
        header("Location: fiche_opdn-".$idOPDN);
        exit();

    }
}

?>