<?php
  session_start();
  
    require '../modele/connexion_pdo.php';
    require '../modele/fonctions.php';
    
    $secret_key = "";
    
    $captcha = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : '';
    
    $prenom = isset($_POST["prenom"]) ? ucfirst(strtolower(htmlspecialchars($_POST["prenom"]))) : NULL;
    $nom = isset($_POST["nom"]) ? ucfirst(strtolower(htmlspecialchars($_POST["nom"]))) : NULL;
    $ville = isset($_POST["ville"]) ? htmlspecialchars($_POST["ville"]) : NULL;
    $cp = isset($_POST["cp"]) ? htmlspecialchars($_POST["cp"]) : NULL;
    
    $mail = isset($_POST["mail"]) ? htmlspecialchars($_POST["mail"]) : NULL;
    $numero = isset($_POST["numero"]) ? htmlspecialchars($_POST["numero"]) : NULL;
    
    $sujet = isset($_POST["sujet"]) ? htmlspecialchars($_POST["sujet"]) : NULL;
    $message = isset($_POST["message"]) ? htmlspecialchars($_POST["message"]) : NULL;
    
    // Initialize cURL
    $ch = curl_init();
    
    // Set cURL options
    curl_setopt_array($ch, [
        CURLOPT_URL => 'https://www.google.com/recaptcha/api/siteverify',
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => [
            'secret' => $secret_key,
            'response' => $captcha,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        ],
        CURLOPT_RETURNTRANSFER => true
    ]);
    
    // Execute cURL and decode the response
    $output = json_decode(curl_exec($ch), true);
    
    // Close cURL
    curl_close($ch);
    
    // Check if the CAPTCHA is successful
    if ($output['success']) {
        // CAPTCHA passed, proceed with sending email
        if($prenom && $nom && $mail && $sujet && $message && $ville && $cp) {
          $from = 'ne-pas-repondre@ecoleduchat.fr';  
          $to = "ecoleduchatmetz@yahoo.com"; 
          $subject = $sujet;
          $headers = "From: " . $from . "\r\n";
          $headers .= "Reply-To: ". $from . "\r\n";
          $headers .= "MIME-Version: 1.0\r\n";
          $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
          $body = "<html><body>";
          $body .= "<p>Nom: $prenom $nom</p>";
          $body .= "<p>Email: $mail</p>";
          $body .= "<p>Numero de téléphone: $numero</p>";
          $body .= "<p>Ville: $ville</p>";
          $body .= "<p>Code postale: $cp</p>";
          $body .= "<p>Message: $message</p>";
          $body .= "</body></html>";
        
            if(mail($to,$subject,$body,$headers)) {
                $_SESSION['mail_success'] = 'Votre mail a bien été envoyé !';
                header('Location:nous_contacter');
                exit();
            } else {
                $_SESSION['mail_fail'] = 'Votre mail n\'a pas été envoyé';
                header('Location:nous_contacter');
                exit();
            }
        } else {
            $_SESSION['mail_fail'] = 'Veuillez remplir tous les informations obligatoires *';
            header('Location:nous_contacter');
            exit();
        }
    } else {
        $_SESSION['mail_fail'] = 'Veuillez vérifier le CAPTCHA';
        header('Location:nous_contacter');
        exit();
    }
    ?>