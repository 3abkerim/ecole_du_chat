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
        SELECT * FROM articles a
        JOIN users u ON a.users_id_user = u.id_user
        WHERE supprime = 0 AND id_article = ".$data."
        ";
    } else {
        // Search by title
        $req = "
        SELECT * FROM articles a
        JOIN users u ON a.users_id_user = u.id_user
        WHERE supprime = 0 AND titre_article LIKE '%".$data."%'
        ";
    }
} else {
    $req = "
    SELECT * FROM articles a
    JOIN users u ON a.users_id_user = u.id_user
    WHERE supprime = 0
    ";
}


$req = $bdd->prepare($req);
$req->execute();

$indice = 0;
while($article = $req->fetch(PDO::FETCH_ASSOC)){
    $indice++;
    include '../vue/table_articles_enLigne.php';
}
?>