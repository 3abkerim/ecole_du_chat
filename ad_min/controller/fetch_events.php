<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$data = isset($_POST['req']) ? $_POST['req'] : '';


if (!empty($data)) {
    $req = "
    SELECT * FROM events e
        JOIN users u ON e.id_user = u.id_user
        WHERE supprime = 0 AND event LIKE '%".$data."%'
    ";
} else {
    $req = "
    SELECT * FROM events e
    JOIN users u ON e.id_user = u.id_user
    WHERE supprime = 0
    ";
}

$req = $bdd->prepare($req);
$req->execute();

$indice = 0;
while($event = $req->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_events_enLigne.php';
}
?>