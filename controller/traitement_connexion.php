<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';


if (isset($_POST['email']) && isset($_POST['mdp'])) {
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);

    // echo "Email: " . $email . "<br/>";
    // echo "Password: " . $mdp . "<br/>";

    $userExists = userCompteExists($bdd, $email);


    // try {
    //     $userExists = userCompteExists($bdd, $email);
    //     var_dump($userExists); // Let's see what we get here
    //     exit(); // Stop further execution to examine the output
    // } catch (Exception $e) {
    //     echo 'Caught exception: ',  $e->getMessage(), "\n"; // Display the error message
    //     exit(); // Stop further execution if there is an error
    // }



    if (is_array($userExists)) {
        $passwordCheck = password_verify($mdp, $userExists['mdp']);
        // echo "Password check result: " . ($passwordCheck ? "true" : "false") . "<br/>";
        if ($passwordCheck) {
            $_SESSION['idUser'] = $userExists['id_user'];
            // echo "Setting idUser: " . $_SESSION['idUser'] . "<br/>";
            header('Location:espace_user');
            exit();
        } else {
            $_SESSION['error'] = 'Email ou mot de passe incorrect';
            // echo "Setting error: " . $_SESSION['error'] . "<br/>";
            header('Location:connexion');
        }
    } else {
        $_SESSION['error'] = 'Email ou mot de passe incorrect';
        header('Location:connexion');
        echo "userExists is not an array";
    }
} else {
    $_SESSION['error'] = 'Veuillez remplir tous les champs';
    header('Location:connexion');
}




// if (isset($_POST['email']) && isset($_POST['mdp'])) {
//     $email = $_POST['email'];
//     $mdp = $_POST['mdp'];

//     $userExists = userExists($bdd,$email);

//     if($userExists){
//         if(password_verify($mdp,$userExists['mdp'])){
//             $_SESSION['idUser'] = $userExists['id'];
//             $_SESSION['debug_message'] = "User ID is set to: " . $_SESSION['idUser'];
//             header('Location:../public/index.php?page=10');
//             exit();
//         }else{
//             $_SESSION['error'] = 'Email ou mot de passe incorrect';
//             header('Location:../public/index.php?page=7');
//         }
//     } else{
//         $_SESSION['error'] = 'Email ou mot de passe incorrect';
//         header('Location:../public/index.php?page=7');
//     }
// } else {
//     $_SESSION['error'] = 'Veuillez remplir tous les champs';
//     header('Location:../public/index.php?page=7');
// }

?>
