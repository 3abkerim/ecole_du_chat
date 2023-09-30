<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$titre = ucfirst(htmlspecialchars($_POST["titre"]));
$par_qui = ucfirst(htmlspecialchars($_POST["par_qui"]));
$lien = htmlspecialchars($_POST["lien"]);
$date_pub = !empty($_POST["date_pub"]) ? htmlspecialchars($_POST["date_pub"]) : NULL;



// echo $nom_chat;
// echo '<br>';
// echo $sexe;
// echo '<br>';
// echo $race;
// echo '<br>';
// echo $dob;
// echo '<br>';
// echo $identification;
// echo '<br>';
// echo $chatDescription;
// echo '<br>';
// echo $sterilisation;
// echo '<br>';
// echo $fiv;
// echo '<br>';
// echo $flv;
// echo '<br>';
// echo $enLigne;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['titre']) || empty($_POST['lien'])) {
        $_SESSION['error_opdn'] = 'Veuillez remplir les cases';
        $_SESSION['form_data_11'] = $_POST;
        header('Location: opdn');
        exit;
    }else{
    ajouterOPDN($bdd,$titre,$lien,$date_pub,$par_qui);
    $_SESSION['success_opdn'] = 'L\'article a été bien ajouté';
    header('Location: opdn');
    exit;
    }
}



?>