<?php
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';
session_start();

$idArticle = isset($_GET['idArticle']) ? $_GET['idArticle'] : null;
$idPhoto = isset($_GET['idPhoto']) ? $_GET['idPhoto'] : null;

supprimerImageArticle($bdd,$idPhoto,$idArticle);

$_SESSION['success_8'] = 'La photo a été bien supprimé';
header('Location:photos_article-'.$idArticle);
exit();

?>