<?php
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';
$idUser = $_SESSION['idUser'];
$oldMdp = htmlspecialchars($_POST['oldmdp']);
$mdp = htmlspecialchars($_POST['mdp']);
$conmdp = htmlspecialchars($_POST['conMdp']);
$storedMdp = getUserMdp($bdd,$idUser);

if (!empty($oldMdp)) {
    if (password_verify($oldMdp, $storedMdp)) {
        if (strlen($mdp) >= 6) {
            if ($mdp == $conmdp) {
                $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                $user = modifierMdp($bdd, $mdp, $idUser);
                unset($_SESSION['idUser']);
                $_SESSION['mdpchange'] = 'Votre mot de passe a été bien modifiée';
                header('Location:connexion');
                exit();
            } else {
                $_SESSION['error'] = 'Les mots de passe ne sont pas identiques';
                header('Location:modifieMdp');
                exit();
            }
        } else {
            $_SESSION['error'] = 'Le mot de passe est trop court !';
            header('Location:modifieMdp');
            exit();
        }
    } else {
        $_SESSION['error'] = 'L\'ancien mot de passe est incorrect';
        header('Location:modifieMdp');
        exit();
    }
}
?>