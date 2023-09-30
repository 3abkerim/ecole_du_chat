<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$data = isset($_POST['req']) ? $_POST['req'] : '';


if (!empty($data)) {
    $req = "
    SELECT * FROM produits WHERE deleted = 0 AND nom_produit LIKE '%".$data."%'
    ";
} else {
    $req = "
    SELECT * FROM produits WHERE deleted = 0
    ";
}

$req = $bdd->prepare($req);
$req->execute();

$indice = 0;
while($produit = $req->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_produits_enLigne.php';
}
?>