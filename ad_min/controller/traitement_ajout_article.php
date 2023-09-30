<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idUser = $_SESSION['idUserAdmin'];
$titre_article = ucfirst(htmlspecialchars($_POST["titre_article"]));
$article = ucfirst(htmlspecialchars($_POST["article"]));
$date = date("Y-m-d H:i:s");
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
    if (empty($_POST['titre_article']) || empty($_POST['article'])) {
        $_SESSION['error_4'] = 'Veuillez remplir les cases';
        $_SESSION['form_data_5'] = $_POST;
        header('Location: articles');
        exit;
    }else{
    ajouterArticle($bdd,$titre_article,$article,$date,$enLigne,$idUser);
    $_SESSION['success_4'] = 'L\'article a été bien ajouté';
    header('Location: articles');
    exit;
    }
}



?>