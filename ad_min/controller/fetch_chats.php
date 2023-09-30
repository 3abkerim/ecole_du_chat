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
    FROM chats c
    LEFT JOIN adoption a ON a.chats_id_chat = c.id_chat
    LEFT JOIN sexe s ON s.id_sexe = c.sexe_id_sexe
    WHERE supprime = 0 AND decede = 0 AND a.chats_id_chat IS NULL AND nom_chat LIKE '%".$data."%'
    ";
} else {
    $req = "
    SELECT * 
    FROM chats c
    LEFT JOIN adoption a ON a.chats_id_chat = c.id_chat
    LEFT JOIN sexe s ON s.id_sexe = c.sexe_id_sexe
    WHERE supprime = 0 AND decede = 0 AND a.chats_id_chat IS NULL
    ";
}

$req = $bdd->prepare($req);
$req->execute();

$indice = 0;
while($chat = $req->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_chats_enLigne.php';
}
?>