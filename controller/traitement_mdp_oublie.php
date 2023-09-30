<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

date_default_timezone_set('Europe/Paris');

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$email = htmlspecialchars($_POST['email']);
$user = userCompteExists($bdd, $email);

if ($user){

    $idUser = $user['id_user'];

    $token = bin2hex(openssl_random_pseudo_bytes(32));
    $expiresAt = date('Y-m-d H:i:s', strtotime('+15 minutes'));

    // echo $expiresAt;
    // die();
    createPasswordReset($bdd,$idUser,$token,$expiresAt);

    $from = 'ne-pas-repondre@ecoleduchat.fr';  
    $to = $email; 
    $subject = 'Re-installez votre mot de passe - école du chat';
    $resetLink = "www.ecoleduchat.fr/mdp_reinstaller-" . urlencode($token) . "-" . urlencode($idUser);
    $headers = "From: " . $from . "\r\n";
    $headers .= "Reply-To: ". $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";



    $body = "<html><body>";
    $body .= "<p>To reset your password, please follow this link: " .$resetLink."</p>";
    $body .= "</body></html>";

    if(mail($to,$subject,$body,$headers)) {
        $_SESSION['mdpoublie'] = 'Un email vous a été envoyé...';
        header('Location:mdp_oublie');
        exit();
        echo "Email sent successfully";
    } else {
        echo "Email sending failed";
    }
    
}else{
    $_SESSION['mdpoublie'] = 'Un email vous a été envoyé.';
    header('Location:mdp_oublie');
    exit();

}


?>