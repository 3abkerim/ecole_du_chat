<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idOPDN = $_POST['idOPDN'];

if (isset($_FILES['photo'])) {
    if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        // There was an error with the file upload
        // Redirect to the form page again
        header('Location:photo_opdn-'.$idOPDN);
        exit();
    }

    $upload_directory = '/home/ecoledl/www/public/assets/images/uploads/OPDN/';
    $name = $_FILES['photo']['name'];
    $base_url = "https://www.ecoleduchat.fr/public/assets/images/uploads/OPDN/";


    if ($_FILES['photo']['size'] > 0) {
        $file_extension = pathinfo($name, PATHINFO_EXTENSION);
        $unique_file_name = time() . '_' . mt_rand() . '.' . $file_extension;
        $uploaded_file_path = $upload_directory . $unique_file_name;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file_path)) {
            $photo = $base_url . $unique_file_name; // URL for the uploaded image
            echo "Calling insertImage function.<br>";
            $test = insertImageOPDN($bdd, $photo, $idOPDN);
            $_SESSION['success_opdn_4'] = 'La capture d\'écran du site a été bien ajoutée';
            header('Location:photo_opdn-'.$idOPDN);
            exit();
        }
    }
}
?>
