<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';


if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = htmlspecialchars( $_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);

    $userExists = adminExists($bdd, $email);

    if (is_array($userExists)) {
        $passwordCheck = password_verify($mdp, $userExists['mdp']);
        if ($passwordCheck) {
            $_SESSION['idUserAdmin'] = $userExists['id_user'];
            header('Location:tableau_de_bord');
            exit();
        } else {
            $_SESSION['error_login'] = 'Email ou mot de passe incorrect';
            header('Location:connexion');
        }
    } else {
        $_SESSION['error_login'] = 'Email ou mot de passe incorrect';
        header('Location:connexion');
        echo "userExists is not an array";
    }
} else {
    $_SESSION['error_login'] = 'Veuillez remplir tous les champs';
    header('Location:connexion');
}


?>
