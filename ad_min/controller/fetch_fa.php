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
    FROM users u
    LEFT JOIN civilite c
    ON u.id_civilite = c.id_civilite 
    WHERE u.famille_accueil = 1 AND (u.nom LIKE '%".$data."%' OR u.prenom LIKE '%".$data."%' )
    ";
} else {
    $req = "
    SELECT * 
    FROM users u
    LEFT JOIN civilite c
    ON u.id_civilite = c.id_civilite 
    WHERE u.famille_accueil = 1
    ";
}

$req = $bdd->prepare($req);
$req->execute();

$indice = 0;
while($famille = $req->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_fa.php';
}
?>