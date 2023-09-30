<?php 
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

session_start();

$idForm = isset($_GET['id']) ? intval($_GET['id']) : 0;
$form = getRequestsForFosterById($bdd,$idForm);

$idChat = $form['id_chat'];
$chat = getChatById($bdd,$idChat);

$idUser = $form['id_user'];
$user = getUserById($bdd,$idUser);
$mail = $user['email'];


refuseFa($bdd,$idForm);

$from = 'ne-pas-repondre@ecoleduchat.fr';  
$to = $mail;
$subject = "Votre demande pour adopter un chat";
$headers = "From: " . $from . "\r\n";
$headers .= "Reply-To: ". $from . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

$body = "<html><body>";
$body = "Nous regrettons de vous informer que votre demande d'adoption pour " . $chat['nom_chat'] . " n'a pas été acceptée.\nNe soyez pas découragé, il y a beaucoup d'autres chats qui cherchent une maison aimante. Veuillez consulter notre site pour voir d'autres chats disponibles.\n\nMerci pour votre compréhension,\nÉcole du chat";
$body .= "</body></html>";

mail($to, $subject, $body, $headers);


$_SESSION['success_ad_delete'] = 'La demande d\'adoption de '.$user['prenom'].' '.$user['nom'] .' a été refusé avec succés';

header('Location:gestion_adoption_chat-'.$form['id_chat']);
exit();
?>