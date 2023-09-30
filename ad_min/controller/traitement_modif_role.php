<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';


$idUser = htmlspecialchars($_POST['idUser']);
$idRole = htmlspecialchars($_POST['role']);


changerRole($bdd,$idUser,$idRole);

$_SESSION['success_role'] = 'Le role a été bien changé avec succés';
header("Location: users-".$idUser);
exit();

// echo $idArticle;
// echo ' ';
// echo $titre_article;
// echo ' ';
// echo $article;
// echo ' ';





?>