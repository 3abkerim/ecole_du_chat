<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$id_produit = htmlspecialchars($_POST['id_produit']);
$nom_produit = ucfirst(isset($_POST['nom_produit']) ? htmlspecialchars($_POST['nom_produit']) : '');
$prix_unit = htmlspecialchars($_POST['prix_unit']);
$description_produit = ucfirst(isset($_POST['description_produit']) ? htmlspecialchars($_POST['description_produit']) : '');


// echo $idArticle;
// echo ' ';
// echo $titre_article;
// echo ' ';
// echo $article;
// echo ' ';



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['nom_produit']) || empty($_POST['prix_unit'])) {
        $_SESSION['error_boutique_3'] = 'Veuillez remplir les cases';
        header("Location: fiche_produit-".$id_produit);
        exit;

    }else{
        $update = updateProduit($bdd,$id_produit,$nom_produit,$prix_unit,$description_produit);
        $_SESSION['success_boutique_3'] ='Les données du produit ont été bien modifié';
        header("Location: fiche_produit-".$id_produit);
        exit();

    }
}

?>