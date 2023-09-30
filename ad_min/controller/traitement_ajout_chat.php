<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$nom_chat = strtoupper(htmlspecialchars($_POST["nom_chat"]));
$sexe = htmlspecialchars($_POST["sexe"]);
$race = isset($_POST["race"]) ? htmlspecialchars($_POST["race"]) : NULL;
$dob = isset($_POST["dob"]) ? htmlspecialchars($_POST["dob"]) : NULL;
$identification = isset($_POST["identification"]) ? htmlspecialchars($_POST["identification"]) : NULL;
$chatDescription = isset($_POST["chatDescription"]) ? htmlspecialchars(ucfirst($_POST["chatDescription"])) : NULL;
$sterilisation = isset($_POST['sterilisation']) ? 1 : 0;
$fiv = isset($_POST['fiv']) ? 1 : 0;
$flv = isset($_POST['flv']) ? 1 : 0;
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
    if (empty($_POST['nom_chat']) || empty($_POST['sexe'])) {
        $_SESSION['error'] = 'Veuillez remplir le nom et choisir le sexe du chat';
        $_SESSION['form_data_3'] = $_POST;
        header('Location: gestion_chats');
        exit;
    }else{
    ajouterChat($bdd,$nom_chat,$identification,$dob,$chatDescription,$sexe,$race,$sterilisation,$fiv,$flv,$enLigne);
    $_SESSION['success'] = $nom_chat.' est bien ajouté';
    header('Location: gestion_chats');
    exit;
    }
}



?>