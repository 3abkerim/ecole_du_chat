<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idForm = isset($_GET['id']) ? intval($_GET['id']) : 0;
$form = getFormFromId($bdd,$idForm);
$idUser = $form['id_user'];
$user = getUserById($bdd,$idUser);
$mail = $user['email'];

$idChat = $form['id_chat'];
$chat = getChatById($bdd,$idChat);

$chats_en_famille = getFaFromChat($bdd,$idChat);

$dateEnd = date("Y-m-d");

if ($form) {
    validateForm($bdd, $idForm);

    insertAdoption($bdd, $form['id_user'], $form['id_chat'], $idForm);

    deleteOtherForms($bdd, $form['id_chat'], $idForm);

    updatePublish($bdd,$idChat,0);

    if ($chats_en_famille){
        updateDateFinAccueil($bdd,$idChat,$dateEnd);
    } 

    
}


$from = 'ne-pas-repondre@ecoleduchat.fr';  
$to = $mail;
$subject = "Confirmation de votre demande pour adopter un chat";
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$body = "<html><body>";
$body = "Félicitations, votre demande pour adopter ".$chat['nom_chat'] ." a été acceptée !\nVous serez contacté bientôt pour plus de détails. Merci de votre intérêt pour l'école du chat.\n\nÀ bientôt,\nÉcole du chat";
$body .= "</body></html>";


mail($to, $subject, $body, $headers);
$_SESSION['success_adoption_5'] = $form['nom_chat'].' a été bien adopté';
header('Location:adoptions_confirmes');
exit();


?>