<?php
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

if (isset($_GET['id'])) {
    $idProduit = intval($_GET['id']);
}

$produit = getProduitById($bdd,$idProduit);

$test = deleteProduit($bdd,$idProduit);

// var_dump($produit);
// var_dump($test);
$_SESSION['success_boutique_2'] = $produit['nom_produit'].' est bien supprimé';
header('Location:gestion_boutique');
exit();
?>