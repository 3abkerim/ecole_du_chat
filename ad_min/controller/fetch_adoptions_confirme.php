<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$data = isset($_POST['req']) ? $_POST['req'] : '';


if (!empty($data)) {
    if (is_numeric($data)) {
        // Search by ID
        $req = "
        SELECT *
        FROM adoption a
        LEFT JOIN chats c ON c.id_chat = a.chats_id_chat
        LEFT JOIN users u ON u.id_user = a.users_id_user
        WHERE a.chats_id_chat = ".$data."
        ";
    } else {
        // Search by title
        $req = "
        SELECT *
        FROM adoption a
        LEFT JOIN chats c ON c.id_chat = a.chats_id_chat
        LEFT JOIN users u ON u.id_user = a.users_id_user
        WHERE c.nom_chat LIKE '%".$data."%' OR u.nom LIKE '%".$data."%' OR u.prenom LIKE '%".$data."%'
        ";
    }
} else {
    $req = "
    SELECT *
    FROM adoption a
    LEFT JOIN chats c ON c.id_chat = a.chats_id_chat
    LEFT JOIN users u ON u.id_user = a.users_id_user
    ";
}


$req = $bdd->prepare($req);
$req->execute();

$indice = 0;
while($adoption = $req->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_adoption_confirme.php';
}
?>