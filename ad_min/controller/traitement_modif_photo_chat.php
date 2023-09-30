<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$idChat = $_POST['idChat'];

if (isset($_FILES['photo'])) {
    // Check if any files were uploaded
    $filesWereUploaded = false;
    foreach ($_FILES['photo']['error'] as $error) {
        if ($error !== UPLOAD_ERR_NO_FILE) {
            $filesWereUploaded = true;
            break;
        }
    }

    // If no files were uploaded, skip the rest of the code
    if (!$filesWereUploaded) {
        header('Location:saisie_photos_chat-'.$idChat);
        exit();
    }

    // File system path
    $upload_directory = '/home/ecoledl/www/public/assets/images/uploads/chats/';
    // Base URL for accessing uploaded files through web
    $base_url = "https://www.ecoleduchat.fr/public/assets/images/uploads/chats/";

    foreach ($_FILES['photo']['name'] as $i => $name) {
        if ($_FILES['photo']['size'][$i] > 0) {
            $file_extension = pathinfo($name, PATHINFO_EXTENSION);
            $unique_file_name = time() . '_' . mt_rand() . '.' . $file_extension;
            $uploaded_file_path = $upload_directory . $unique_file_name;

            if (move_uploaded_file($_FILES['photo']['tmp_name'][$i], $uploaded_file_path)) {
                $photo = $base_url . $unique_file_name; // URL for the uploaded image
                echo "Calling insertImage function.<br>";
                insertImage($bdd, $photo, $idChat);
                $_SESSION['success_6'] = 'Les photos ont été bien ajoutées';
            }
        }
    }
}
header('Location:saisie_photos_chat-'.$idChat);
exit();
?>
