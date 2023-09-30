<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require "../modele/connexion_pdo.php";
require "../modele/fonctions.php";

$departement_id = $_POST['departement_data'];

$villes = getVilles($bdd, $departement_id);

$output = '<option selected disabled>Ville</option>'; // Add this line here
foreach ($villes as $ville) {
    $output .= '<option value="' . $ville['id_ville'] . '">' . $ville['nom_ville'] . '</option>';
}
echo $output;
?>
