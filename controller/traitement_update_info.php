<?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  
  session_start();
  
  require '../modele/connexion_pdo.php';
  require '../modele/fonctions.php';
  
  $idUser = $_SESSION['idUser'];
  $nom = isset($_POST['nom']) ? ucfirst(strtolower(htmlspecialchars($_POST['nom']))) : null;
  $prenom = isset($_POST['prenom']) ? ucfirst(strtolower(htmlspecialchars($_POST['prenom']))) : null;
  $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : null;
  $adresse = isset($_POST["adresse"]) ? htmlspecialchars($_POST["adresse"]) : null;
  $dep = isset($_POST['departement']) ? htmlspecialchars($_POST['departement']) : null;
  $ville = isset($_POST["ville"]) ? htmlspecialchars($_POST["ville"]) : null;
  $dob = isset($_POST["dob"]) ? htmlspecialchars($_POST["dob"]) : null;
  
  
  $user = getUser($bdd,$idUser);
  // var_dump($user);
  
  // echo $idUser;
  // echo '<br>';
  // echo $nom;
  // echo '<br>';
  // echo $prenom;
  // echo '<br>';
  // echo $email;
  // echo '<br>';
  // echo $adresse;
  // echo '<br>';
  // echo $dep;
  // echo '<br>';
  // echo $ville;
  // echo '<br>';
  
  // echo $dob;
  // echo '<br>';
  
  if (!isset($user['adresse'])){
      $updateUser = updateUserInfo($bdd,$idUser,$nom,$prenom,$email,$dob);
      $insert = insertAdresseUser($bdd,$adresse, $ville,$idUser);
      // var_dump($insert);
      $_SESSION['editInfo'] = 'Vos données ont été bien modifiées';
      header('Location:espace_user');
      exit();
  
  }else{
      $updateUser = updateUserInfo($bdd,$idUser,$nom,$prenom,$email,$dob);
  // echo '<br>';
  
  $updateAdresse = updateAdresse($bdd,$idUser,$adresse,$ville);
  
  // var_dump($updateUser);
  // var_dump($updateAdresse);
  
  $_SESSION['editInfo'] = 'Vos données ont été bien modifiées';
  header('Location:espace_user');
  exit();
      
  }
  
  
  
  ?>