<?php 
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

session_start();

$idForm = isset($_GET['id']) ? intval($_GET['id']) : 0;
$form = getRequestsForFosterById($bdd,$idForm);

$idUser = $form['id_user'];
$user = getUserById($bdd,$idUser);

$mail = $user['email'];


refuseFa($bdd,$idForm);

$from = 'ne-pas-repondre@ecoleduchat.fr';  
$to = $mail;

$subject = "Votre demande pour devenir une famille d'accueil à l'école du chat";

$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";


$body = "<html><body>";
$body = "Nous sommes désolés de vous informer que votre demande pour devenir une famille d'accueil à l'École du Chat n'a pas été acceptée en cette occasion.\nCeci ne remet pas en question votre capacité à fournir un foyer aimant et nous vous encourageons à considérer d'autres façons de soutenir notre cause, comme l'adoption ou le bénévolat.\n\nMerci pour votre compréhension et votre soutien continu,\nÉcole du Chat";
$body .= "</body></html>";

mail($to, $subject, $body, $headers);

$_SESSION['success_fa_delete'] = 'La demande de '.$user['prenom'].' '.$user['nom'] .' a été refusé avec succés';

header('Location:demandes_familles_accueil');
?>