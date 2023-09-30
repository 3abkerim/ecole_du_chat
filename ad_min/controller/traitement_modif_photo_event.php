<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idEvent = $_POST['idEvent'];

if (isset($_FILES['photo'])) {
    if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        // There was an error with the file upload
        // Redirect to the form page again
        header('Location:affiche_event-'.$idEvent);
        exit();
    }

    $upload_directory = '/home/ecoledl/www/public/assets/images/uploads/events/';
    $name = $_FILES['photo']['name'];
    $base_url = "https://www.ecoleduchat.fr/public/assets/images/uploads/events/";


    if ($_FILES['photo']['size'] > 0) {
        $file_extension = pathinfo($name, PATHINFO_EXTENSION);
        $unique_file_name = time() . '_' . mt_rand() . '.' . $file_extension;
        $uploaded_file_path = $upload_directory . $unique_file_name;

        if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded_file_path)) {
            $photo = $base_url . $unique_file_name; // URL for the uploaded image
            echo "Calling insertImage function.<br>";
            insertImageEvent($bdd, $photo, $idEvent);
            var_dump($test);
            $_SESSION['success_12'] = 'L\'affiche a été bien ajoutée';
            header('Location:affiche_event-'.$idEvent);
            exit();
        }
    }
}
?>
