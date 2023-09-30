<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$data = isset($_POST['req']) ? $_POST['req'] : '';


if (!empty($data)) {
    $req = "
    SELECT * 
    FROM on_parle_de_nous 
    WHERE supprime = 0 AND (titre LIKE '%".$data."%' OR par_qui LIKE '%".$data."%')
    ";
} else {
    $req = "
    SELECT * 
    FROM on_parle_de_nous 
    WHERE supprime = 0
    ";
}


$req = $bdd->prepare($req);
$req->execute();

$indice = 0;
while($opdn = $req->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_opdn_enLigne.php';
}
?>