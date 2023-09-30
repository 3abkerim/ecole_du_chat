<?php
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

if (isset($_GET['id'])) {
    $idArticle = intval($_GET['id']);
}

$article = getArticleById($bdd,$idArticle);

$test = deleteArticle($bdd,$idArticle);

// var_dump($test);
$_SESSION['success_14'] = $article['id_article'].' est bien supprimé';
header('Location:gestion_articles');
exit();
?>