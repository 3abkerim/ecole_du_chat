<?php
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';
session_start();

$idProduit = isset($_GET['id']) ? $_GET['id'] : null;
$idPhoto = isset($_GET['idPhoto']) ? $_GET['idPhoto'] : null;

supprimerImageProduit($bdd,$idPhoto,$idProduit);

$_SESSION['success_boutique_6'] = 'La photo a été bien supprimé';
header('Location:photos_produit-'.$idProduit);
exit();

?>