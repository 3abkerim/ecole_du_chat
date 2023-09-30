<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$data = isset($_POST['req']) ? $_POST['req'] : '';


if (!empty($data)) {
    $req = "
    SELECT c.*, COUNT(f.id_chat) as num_requests 
    FROM chats c
    JOIN formulaires f ON c.id_chat = f.id_chat
    WHERE f.form_type = 1 AND f.valide = 0 AND f.supprime = 0 AND c.nom_chat LIKE '%".$data."%'
    GROUP BY c.id_chat
    ORDER BY num_requests DESC
    ";
} else {
    $req = "
    SELECT c.*, COUNT(f.id_chat) as num_requests 
    FROM chats c
    JOIN formulaires f ON c.id_chat = f.id_chat
    WHERE f.form_type = 1 AND f.valide = 0 AND f.supprime = 0
    GROUP BY c.id_chat
    ORDER BY num_requests DESC
    ";
}

$req = $bdd->prepare($req);
$req->execute();

$indice = 0;
while($chat = $req->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_demandes_adoption.php';
}
?>