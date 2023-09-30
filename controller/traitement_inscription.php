<?php
  session_start();
  
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  require '../modele/connexion_pdo.php';
  require '../modele/fonctions.php';
  
  $civilite = !empty($_POST["civilite"]) ? htmlspecialchars($_POST["civilite"]) : NULL;
  $nom = ucfirst( htmlspecialchars($_POST['nom']));
  $prenom = ucfirst(htmlspecialchars($_POST['prenom']));
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $adresse = !empty($_POST["adresse"]) ? htmlspecialchars($_POST["adresse"]) : NULL;
  $departement = !empty($_POST["departement"]) ? htmlspecialchars($_POST["departement"]) : NULL;
  $ville = !empty($_POST["ville"]) ? htmlspecialchars($_POST["ville"]) : NULL;
  $dob = htmlspecialchars($_POST["dob"]);
  $numero = '+33'.htmlspecialchars($_POST['numero']);
  $mdp = htmlspecialchars($_POST['mdp']);
  $conmdp = htmlspecialchars($_POST['conmdp']);
  $role = '3';
  
  
  
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LePuB4nAAAAAMeZK8MJcR2ZJfcSijgeLbd5BbDC';
    $recaptcha_response = $_POST['g-recaptcha-response'];
    
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
    
    if ($recaptcha->success==true && $recaptcha->score >= 0.5 && $recaptcha->action=='submit') {
  
          $userExists = userExists($bdd,$email);
  
              if (empty($nom)) {
                  $_SESSION['erreur'] = 'Nom est requis!';
                  $_SESSION['form_data_inscription'] = $_POST;
                  header("Location:inscription");
              } elseif (empty($prenom)) {
                  $_SESSION['erreur'] = 'Prenom est requis!';
                  $_SESSION['form_data_inscription'] = $_POST;
                  header("Location:inscription");
              } elseif (!$email) {
                  $_SESSION['erreur'] = 'Email non valide!';
                  $_SESSION['form_data_inscription'] = $_POST;
                  header("Location:inscription");
              } elseif (empty($dob)) {
                  $_SESSION['erreur'] = 'Date de naissance est requise!';
                  $_SESSION['form_data_inscription'] = $_POST;
                  header("Location:inscription");
              } elseif (empty($mdp)) {
                  $_SESSION['erreur'] = 'Mot de passe est requis!';
                  $_SESSION['form_data_inscription'] = $_POST;
                  header("Location:inscription");
              } elseif (empty($conmdp)) {
                  $_SESSION['erreur'] = 'Confirmation de mot de passe est requise!';
                  $_SESSION['form_data_inscription'] = $_POST;
                  header("Location:inscription");
              } else {
                  if ($userExists){
                      if($userExists['compte'] == 0){
                          $mdp = password_hash($mdp,PASSWORD_DEFAULT);
                          $updateUser = $bdd->prepare("UPDATE users SET mdp = ?, compte = 1 WHERE email = ?");
                          $updateUser->execute([$mdp, $email]);
  
                            $id_user = $userExists['id_user'];
                          $user = getUser($bdd,$id_user);
  
                          if(!isset($user['adresse'])){
                              insertAdresseUser($bdd,$adresse, $ville,$id_user);
                          } else {
                              $updateAdresse = updateAdresse($bdd,$id_user,$adresse,$ville);
                          }

                          header('Location:inscription_reussi');
                          exit();
  
                      } else {
                          $_SESSION['erreur'] = 'Email existe déja, utilisez un autre email.';
                          $_SESSION['form_data_inscription'] = $_POST;
                          header("Location:inscription");
                      }
                  } else {
                      if (strlen($mdp)>=6) {
                          if ($mdp==$conmdp) {
                              $mdp = password_hash($mdp,PASSWORD_DEFAULT);
  
                              $id_user = createCompteUser($bdd,$civilite, $nom, $prenom,$dob, $email, $mdp, $numero, $role,'1');
  
                              $user = getUser($bdd,$id_user);
  
                              if(!isset($user['adresse'])){
                                  insertAdresseUser($bdd,$adresse, $ville,$id_user);
                                  header('Location:inscription_reussi');
                                  exit();
                              } else {
                                  $updateAdresse = updateAdresse($bdd,$id_user,$adresse,$ville);
                                  header('Location:inscription_reussi');
                                  exit();
                              }
              
                          } else {
                              $_SESSION['erreur'] = 'Les mots de passe ne sont pas identiques.';
                              $_SESSION['form_data_inscription'] = $_POST;
                              header("Location:inscription");
                          }
                      } else {
                          $_SESSION['erreur'] = 'Le mot de passe est trop court !';
                          $_SESSION['form_data_inscription'] = $_POST;
                          header("Location:inscription");
                      }
                  }
              }
          } else{
            $_SESSION['form_data_inscription'] = $_POST;
            $_SESSION['erreur']='La vérification reCAPTCHA a échoué. Veuillez réessayer.';
            header('Location: inscription');
            exit();
         }
  ?>