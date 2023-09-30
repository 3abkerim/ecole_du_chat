<?php
require "../modele/connexion_pdo.php";
require "../modele/fonctions.php";

$ville_id = $_POST['ville_data'];

$stmt = $bdd->prepare('SELECT cp FROM ville WHERE id_ville = :ville_id');
$stmt->execute([':ville_id' => $ville_id]);

$row = $stmt->fetch();
if ($row !== false) {
    $postal_codes = explode('-', $row[0]);
    $postal_code = trim($postal_codes[0]);
    echo $postal_code;
} else {
    echo ''; 
}

?>