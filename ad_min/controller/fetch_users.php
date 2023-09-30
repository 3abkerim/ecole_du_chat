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
    LEFT JOIN role r ON r.id_role = u.id_role
    WHERE compte = 1 AND (r.role != 'Superadmin') AND (u.prenom LIKE '%".$data."%' OR u.nom LIKE '%".$data."%' OR u.email LIKE '%".$data."%' OR u.numero LIKE '%".$data."%' OR r.role LIKE '%".$data."%') 
    ";
} else {
    $req = "
    SELECT * 
    FROM users u
    LEFT JOIN role r ON r.id_role = u.id_role
    WHERE compte = 1 AND (r.role != 'Superadmin')
    ";
}

$req = $bdd->prepare($req);
$req->execute();

$indice = 0;
while($user = $req->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_users.php';
}
?>