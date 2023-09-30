<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idUser = $_SESSION['idUserAdmin'];
$nom = ucfirst(htmlspecialchars($_POST["nom"]));
$date_event = htmlspecialchars($_POST["date_event"]);
$date_fin_event = !empty($_POST["date_fin_event"]) ? htmlspecialchars($_POST["date_fin_event"]) : NULL;
$date_publication = date("Y-m-d H:i:s");
$enLigne = isset($_POST['enLigne']) ? 1 : 0;

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
    if (empty($_POST['nom']) || empty($_POST['date_event'])) {
        $_SESSION['error_10'] = 'Veuillez remplir les cases';
        $_SESSION['form_data_10'] = $_POST;
        header('Location: events');
        exit;
    }else{
    $test = ajouterEvent($bdd,$nom,$date_event,$date_fin_event,$date_publication,$enLigne,$idUser);
    $_SESSION['success_10'] = 'L\'évènement a été bien ajouté';
    header('Location: events');
    exit;
    var_dump($test);
    }
}



?>