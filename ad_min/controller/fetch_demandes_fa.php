<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$data = isset($_POST['req']) ? $_POST['req'] : '';

if (!empty($data)) {
    if (is_numeric($data)){
        $req = '
        SELECT * 
        FROM formulaires f
        LEFT JOIN users u ON u.id_user = f.id_user
        WHERE form_type = 2 AND valide = 0 AND supprime = 0 AND f.id_fa = '.$data;
    } else {
        $req = "
        SELECT * 
        FROM formulaires f
        LEFT JOIN users u ON u.id_user = f.id_user
        WHERE form_type = 2 AND valide = 0 AND supprime = 0 AND (u.nom LIKE '%".$data."%' OR u.prenom LIKE '%".$data."%' )
            ";
    }  
} else {
    $req = "
    SELECT * 
    FROM formulaires f
    LEFT JOIN users u ON u.id_user = f.id_user
    WHERE form_type = 2 AND valide = 0 AND supprime = 0
    ";
}

$res = $bdd->prepare($req);
$res->execute();


$indice = 0;
while($demande = $res->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_demandes_fa.php';
}
?>
