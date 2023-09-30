<?php
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';
session_start();

$idUser = isset($_GET['idUser']) ? $_GET['idUser'] : null;
$idPhoto = isset($_GET['idPhoto']) ? $_GET['idPhoto'] : null;

supprimerImageProfil($bdd,$idPhoto,$idUser);

$_SESSION['success_deleted'] = 'La photo a été bien supprimé';
header('Location:modifiePhotoDeProfil');
exit();

?>