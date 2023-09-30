<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idArticle = htmlspecialchars($_POST['id_article']);
$titre_article = isset($_POST['titre_article']) && trim($_POST['titre_article']) !== "" ? $_POST['titre_article'] : NULL;
$article = isset($_POST['article']) && trim($_POST['article']) !== "" ? $_POST['article'] : NULL;

// echo $idArticle;
// echo ' ';
// echo $titre_article;
// echo ' ';
// echo $article;
// echo ' ';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['titre_article']) || empty($_POST['article'])) {
        $_SESSION['error_6'] = 'Veuillez remplir les cases de l\'article';
        header("Location: fiche_article-".$idArticle);
        exit;

    }else{
        $update = updateArticle($bdd,$idArticle,$titre_article,$article);
        $_SESSION['success_6'] ='Les données de l\'article ont été bien modifié';
        header("Location: fiche_article-".$idArticle);
        exit();

    }
}



?>