<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idChat = isset($_POST['idChat']) && trim($_POST['idChat']) !== "" ? $_POST['idChat'] : NULL;
$nom_chat = isset($_POST['nom_chat']) && trim($_POST['nom_chat']) !== "" ? strtoupper($_POST['nom_chat']) : NULL;
$sexe = isset($_POST['sexe']) && trim($_POST['sexe']) !== "" ? $_POST['sexe'] : NULL;
$race = isset($_POST['race']) && trim($_POST['race']) !== "" ? $_POST['race'] : NULL;
$dob = isset($_POST['dob']) && trim($_POST['dob']) !== "" ? $_POST['dob'] : NULL;
$identification = isset($_POST['identification']) && trim($_POST['identification']) !== "" ? $_POST['identification'] : NULL;
$chatDescription = isset($_POST["chatDescription"]) && trim($_POST["chatDescription"]) !== "" ? htmlspecialchars(ucfirst($_POST["chatDescription"])) : NULL;
$sterilisation = isset($_POST['sterilisation']) ? 1 : 0;
$fiv = isset($_POST['fiv']) ? 1 : 0;
$flv = isset($_POST['flv']) ? 1 : 0;
$adopte = isset($_POST['adopte']) ? 1 : 0;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST['nom_chat']) || empty($_POST['sexe'])) {
        $_SESSION['error'] = 'Veuillez remplir le nom et choisir le sexe du chat';
        header("Location:fiche_chat-".$idChat);
        exit;
    }else{
        updateChat($bdd,$idChat,$nom_chat,$sexe,$race,$dob,$identification,$chatDescription,$sterilisation,$fiv,$flv);
        if ($adopte === 1){
            $_SESSION['success_101'] = $nom_chat.' est adopté';
            insertAdoptionHorsSite($bdd, $idChat);
            deleteForms($bdd,$idChat);
            updatePublish($bdd,$idChat,0);
            header("Location:gestion_chats"); 
            exit;
        }else{
            $_SESSION['success_4'] ='Les données de '.$nom_chat.' ont été bien modifié';
            header("Location:fiche_chat-".$idChat);
            exit;
        }
    }
}


?>