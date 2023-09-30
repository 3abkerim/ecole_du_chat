<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idChat = isset($_POST['idChat']) ? intval($_POST['idChat']) : null;
$data = isset($_POST['req']) ? $_POST['req'] : '';

if (!empty($data)) {
    if (is_numeric($data)){
        $req = '
            SELECT * 
            FROM formulaires f
            LEFT JOIN users u ON u.id_user = f.id_user
            LEFT JOIN chats c ON c.id_chat = f.id_chat
            WHERE f.id_chat = :idChat AND f.form_type = 1 AND f.valide = 0 AND f.supprime = 0 f.id_fa = '.$data;
    } else {
        $req = "
            SELECT * 
            FROM formulaires f
            LEFT JOIN users u ON u.id_user = f.id_user
            LEFT JOIN chats c ON c.id_chat = f.id_chat
            WHERE f.id_chat = :idChat AND f.form_type = 1 AND f.valide = 0 AND f.supprime = 0 (u.nom LIKE '%".$data."%' OR u.prenom LIKE '%".$data."%' )
            ";
    }  
} else {
    $req = "
    SELECT * 
    FROM formulaires f
    LEFT JOIN users u ON u.id_user = f.id_user
    LEFT JOIN chats c ON c.id_chat = f.id_chat
    WHERE f.id_chat = :idChat AND f.form_type = 1 AND f.valide = 0 AND f.supprime = 0
    ";
}

$res = $bdd->prepare($req);
$res->bindParam(':idChat', $idChat);
$res->execute();


$indice = 0;
while($demande = $res->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_demandes_adoption_chat.php';
}
?>
