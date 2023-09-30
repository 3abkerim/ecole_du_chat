<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  session_start();
  require '../modele/connexion_pdo.php';
  require '../modele/fonctions.php';
  
  try{
  
  $civilite = isset($_POST["civilite"]) ? htmlspecialchars($_POST["civilite"]) : NULL;
  
  $prenom = isset($_POST["prenom"]) ? ucfirst( strtolower(htmlspecialchars($_POST["prenom"])) )  : NULL;
  $nom = isset($_POST["nom"]) ? ucfirst(strtolower(htmlspecialchars($_POST["nom"]))) : NULL;
  $adresse = isset($_POST["adresse"]) ? htmlspecialchars($_POST["adresse"]) : NULL;
  $departement = isset($_POST["departement"]) ? htmlspecialchars($_POST["departement"]) : NULL;
  $ville = isset($_POST["ville"]) ? htmlspecialchars($_POST["ville"]) : NULL;
  
  $mail = filter_var($_POST["mail"], FILTER_VALIDATE_EMAIL);
  if (!$mail) {
      $_SESSION['error'] = 'Le format de l\'email que vous avez entré est invalide. Veuillez entrer une adresse email valide';
      $_SESSION['form_data_2'] = $_POST;
      header("Location:form_adoption-" . $idChat);
      exit();
  }
  
  $numero = isset($_POST["numero"]) ? '+33'.htmlspecialchars($_POST["numero"]) : NULL;
  $dob = isset($_POST["dob"]) ? htmlspecialchars($_POST["dob"]) : NULL;
  
  $statut = isset($_POST["statut"]) ? htmlspecialchars($_POST["statut"]) : NULL;
  $situation = isset($_POST["situation"]) ? htmlspecialchars($_POST["situation"]) : NULL;
  $enfants = isset($_POST["enfants"]) ? htmlspecialchars($_POST["enfants"]) : NULL;
  $ageEnfants = isset($_POST["ageEnfants"]) ? htmlspecialchars($_POST["ageEnfants"]) : NULL;
  
  $type_logement = isset($_POST["type_logement"]) ? htmlspecialchars($_POST["type_logement"]) : NULL;
  $taille_logement = isset($_POST["taille_logement"]) ? htmlspecialchars($_POST["taille_logement"]) : NULL;
  $superficie_logement = isset($_POST["superficie_logement"]) ? htmlspecialchars($_POST["superficie_logement"]) : NULL;
  $acces_balcon_terrasse = isset($_POST["acces_balcon_terrasse"]) ? htmlspecialchars($_POST["acces_balcon_terrasse"]) : NULL;
  $is_balcon_secure = isset($_POST["is_balcon_secure"]) ? htmlspecialchars($_POST["is_balcon_secure"]) : NULL;
  $would_secure_balcon = isset($_POST['would_secure_balcon']) ? htmlspecialchars($_POST['would_secure_balcon']) : NULL;
  $how_secure_balcon = isset($_POST["how_secure_balcon"]) ? htmlspecialchars($_POST["how_secure_balcon"]) : NULL;
  $danger = isset($_POST["danger"]) ? htmlspecialchars($_POST["danger"]) : NULL;
  
  $vehicule = isset($_POST["vehicule"]) ? htmlspecialchars($_POST["vehicule"]) : NULL;
  $accord = isset($_POST["accord"]) ? htmlspecialchars($_POST["accord"]) : NULL;
  $asthme = isset($_POST["asthme"]) ? htmlspecialchars($_POST["asthme"]) : NULL;
  $contactsEnfants = isset($_POST['contactsEnfants']) ? htmlspecialchars($_POST['contactsEnfants']) : NULL;
  $compatible = isset($_POST["compatible"]) ? htmlspecialchars($_POST["compatible"]) : NULL;
  
  $dejaEuAnimaux = isset($_POST["dejaEuAnimaux"]) ? htmlspecialchars($_POST["dejaEuAnimaux"]) : NULL;
  $desciptionAnimaux = isset($_POST["desciptionAnimaux"]) ? htmlspecialchars($_POST["desciptionAnimaux"]) : NULL;
  $nuisances = isset($_POST["nuisances"]) ? htmlspecialchars($_POST["nuisances"]) : NULL;
  $combienAnimaux = isset($_POST["combienAnimaux"]) ? htmlspecialchars($_POST["combienAnimaux"]) : NULL;
  $especes = isset($_POST["especes"]) ? htmlspecialchars($_POST["especes"]) : NULL;
  $sexeAnimaux = isset($_POST["sexeAnimaux"]) ? htmlspecialchars($_POST["sexeAnimaux"]) : NULL;
  $animaux_sterilisation = isset($_POST["animauxSterlises"]) ? htmlspecialchars($_POST["animauxSterlises"]) : NULL;
  $avis_sterilisation = isset($_POST["sterilisation"]) ? htmlspecialchars($_POST["sterilisation"]) : NULL;
  $vaccinsAJour = isset($_POST["vaccinsAJour"]) ? htmlspecialchars($_POST["vaccinsAJour"]) : NULL;
  $cliniques = isset($_POST["cliniques"]) ? htmlspecialchars($_POST["cliniques"]) : NULL;
  $adoptionAsso = isset($_POST["adoptionAsso"]) ? htmlspecialchars($_POST["adoptionAsso"]) : NULL;
  $chaton = isset($_POST["chaton"]) ? htmlspecialchars($_POST["chaton"]) : NULL;
  
  
  $raison_decedes = isset($_POST["raison_decedes"]) ? htmlspecialchars($_POST["raison_decedes"]) : NULL;
  $separation_animal = isset($_POST["separation_animal"]) ? htmlspecialchars($_POST["separation_animal"]) : NULL;
  $raison_separation = isset($_POST["raison_separation"]) ? htmlspecialchars($_POST["raison_separation"]) : NULL;
  
  $heuresSeul = isset($_POST["heuresSeul"]) ? htmlspecialchars($_POST["heuresSeul"]) : NULL;
  $cohabitation = isset($_POST["cohabitation"]) ? htmlspecialchars($_POST["cohabitation"]) : NULL;
  $installation = isset($_POST["installation"]) ? htmlspecialchars($_POST["installation"]) : NULL;
  $routine = isset($_POST["routine"]) ? htmlspecialchars($_POST["routine"]) : NULL;
  $garde = isset($_POST["garde"]) ? htmlspecialchars($_POST["garde"]) : NULL;
  
  $experience = isset($_POST["experience"]) ? htmlspecialchars($_POST["experience"]) : NULL;
  $raisonAccueil = isset($_POST["raisonAccueil"]) ? htmlspecialchars($_POST["raisonAccueil"]) : NULL;
  $comportement = isset($_POST["comportement"]) ? htmlspecialchars($_POST["comportement"]) : NULL;
  
  $medicament = isset($_POST["medicament"]) ? htmlspecialchars($_POST["medicament"]) : NULL;
  
  
  $formType = 2;
  $datetime = new DateTime('', new DateTimeZone('Europe/Paris'));
  $date = $datetime->format('Y-m-d H:i:s');
  $role = '3';
  
  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
  $recaptcha_secret = '';
  $recaptcha_response = $_POST['g-recaptcha-response'];
  
  $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
  $recaptcha = json_decode($recaptcha);
  
  if ($recaptcha->success==true && $recaptcha->score >= 0.5 && $recaptcha->action=='submit') {
    
      $user = userExists($bdd, $mail);
      if (!$user) {
          $id_user = createUserFromForm($bdd, $civilite, $nom, $prenom, $mail, $dob, $numero, $role);
      } else {
          $id_user = $user['id_user'];
      }

  
        $userById = getUser($bdd,$id_user);
        if(!isset($userById['adresse'])){
            insertAdresseUser($bdd,$adresse, $ville,$id_user);
        } else {
            $updateAdresse = updateAdresse($bdd,$id_user,$adresse,$ville);
        }    
  
      $data = [
          'id_user' => $id_user,
          'date_form' => $date,
  
          'id_statut' => $statut,
          'id_situation' => $situation,
          'taille_logement' => $taille_logement,
          'type_logement' => $type_logement,
          'superficie_logement' => $superficie_logement,
          'enfants' => $enfants,
          'age_enfants' => $ageEnfants,
          'acces_balcon' =>$acces_balcon_terrasse,
          'is_balcon_secure' => $is_balcon_secure,
          'faire_securite_balcon' => $would_secure_balcon,
          'dtls_securite_balcon' => $how_secure_balcon,
          'route_proche' =>$danger,
  
          'vehicule' =>$vehicule,
          'accord' => $accord,
          'asthme' => $asthme,
          'enfants_contacts' => $contactsEnfants,
          'compatible' => $compatible,
  
          'avoir_animal' => $dejaEuAnimaux,
          'dtls_animaux' => $desciptionAnimaux,
          'degats_chat' => $nuisances,
          'animaux_possedes' => $combienAnimaux,
          'especes' => $especes,
          'sexe' => $sexeAnimaux,
          'sterlises' => $animaux_sterilisation,
          'avis_sterlisation' => $avis_sterilisation,
          'vaccins_ajour' => $vaccinsAJour,
          'veto_referant' => $cliniques,
          'deja_adopte_animal' => $adoptionAsso,
          'chaton' => $chaton,
  
          'separation_animal' => $separation_animal,
          'raison_separation' => $raison_separation,
          'raison_decedes' => $raison_decedes,
  
          'chat_seul_heures' => $heuresSeul,
          'cohabitation' => $cohabitation,
          'installation' => $installation,
          'routine' => $routine,
          'absence' => $garde,
  
          'experience' => $experience,
          'raisonAccueil' => $raisonAccueil,
          'comportement' => $comportement,
  
          'medicament' => $medicament,
  
          'form_type' => $formType
      ];
  
      insertFormAdoption($bdd, $data);
      header('Location:form_fa_reussi');
      }
  else {
    $_SESSION['form_data_2'] = $_POST;
    $_SESSION['error_recaptcha_fa']='La vérification reCAPTCHA a échoué. Veuillez réessayer.';
    header('Location: form_famille_accueil');
    exit();
  }
  
  
  } catch (Exception $e) {
      error_log($e->getMessage());
      echo 'Error: ' . $e->getMessage();
      $_SESSION['form_data_2'] = $_POST;
      session_write_close();
      header('Location:form_famille_accueil');
      exit();
  }
  ?>