<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$nom_produit = ucfirst(htmlspecialchars($_POST["nom_produit"]));
$prixUnit = htmlspecialchars($_POST["prixUnit"]);
$produitDescription = isset($_POST["produitDescription"]) ? htmlspecialchars($_POST["produitDescription"]) : NULL;
$date = date("Y-m-d H:i:s");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['nom_produit']) || empty($_POST['prixUnit'])) {
        $_SESSION['error_boutique'] = 'Veuillez remplir le nom et le prix du produit';
        $_SESSION['form_data_produits'] = $_POST;
        header('Location: boutique');
        exit;
    }else{
    $test = ajouterProd($bdd,$nom_produit,$prixUnit,$produitDescription,$date);
    var_dump($test);
    $_SESSION['success_boutique'] = $nom_produit.' est bien ajouté';
    header('Location: boutique');
    exit;
    }
}



?>