<?php 
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idForm = isset($_GET['id']) ? intval($_GET['id']) : 0;

$form = getRequestsForFosterById($bdd,$idForm);

$idUser = $form['id_user'];
$user = getUserById($bdd,$idUser);
$mail = $user['email'];

$v1 = valideFa_1($bdd,$idForm);
$v2 = valideFa_2($bdd,$idUser);


$from = 'ne-pas-repondre@ecoleduchat.fr';  
$to = $mail;
$subject = "Confirmation de votre demande pour devenir une famille d'accueil à l'école du chat";
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$body = "<html><body>";
$body .= "Félicitation, votre demande pour devenir une famille d'accueil à l'école du chat est accepté !\nVeuillez créer un compte avec votre email adresse sur notre site.\n\nÀ bientôt,\nÉcole du chat";
$body .= "</body></html>";

mail($to, $subject, $body, $headers);

header('Location:familles_accueil');
?>
