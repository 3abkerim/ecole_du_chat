<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idUser = $_POST['idUser'];

if (isset($_FILES['photo'])) {
    if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        header('Location:modifiePhotoDeProfil');
        exit();
    }

    $upload_directory = 'url';
    $name = $_FILES['photo']['name'];
    $base_url = "url";

    if ($_FILES['photo']['size'] > 0) {
        $file_extension = pathinfo($name, PATHINFO_EXTENSION);
        $unique_file_name = time() . '_' . mt_rand() . '.' . $file_extension;
        $uploaded_file_path = $upload_directory . $unique_file_name;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file_path)) {
            $photo = $base_url . $unique_file_name; 
            $test = insertImageUser($bdd, $photo, $idUser);
            $_SESSION['success_idUser'] = 'La photo de profil a été bien ajoutée';
;
            $imageUrl = $photo;
            $response = ['imageUrl' => $imageUrl];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
}
?>
