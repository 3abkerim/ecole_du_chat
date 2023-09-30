<?php
  session_start();
  require '../modele/connexion_pdo.php';
  require '../modele/fonctions.php';
  
  $idUser = htmlspecialchars($_POST['idUser']);
  $token = htmlspecialchars($_POST['token']);
  $mdp = htmlspecialchars($_POST['mdp']);
  $mdp_confirm = htmlspecialchars($_POST['mdp_confirm']);
  
  if ($mdp !== $mdp_confirm) {
      $_SESSION['mdpfail'] = 'Les mots de passe saisis ne correspondent pas';
      header('Location:connexion-'. urlencode($token) . "-" . urlencode($idUser));
      exit();
  
  } else {
  
      if (strlen($mdp)>=6){
          $mdp = password_hash($mdp,PASSWORD_DEFAULT);
          updateMdp($bdd,$idUser,$mdp);
          updateToken($bdd, $idUser, $token);
          $_SESSION['mdpsuccess'] = 'Votre mot de passe a été bien modifié';
          header('Location:connexion');
          exit();
      }else{
          $_SESSION['mdpcourt'] = 'Le mot de passe est trop court, minimum 6 caractères.';
          header('Location:connexion-'. urlencode($token) . "-" . urlencode($idUser));
          exit();
      }
  
  
  }
  ?>