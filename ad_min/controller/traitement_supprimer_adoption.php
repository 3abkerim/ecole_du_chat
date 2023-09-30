<?php 
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

session_start();

$idChat = isset($_GET['id']) ? intval($_GET['id']) : 0;

deleteAdoption($bdd,$idChat);

$_SESSION['success_ad_delete_2'] = 'L\'adoption a été supprimé avec succés';

header('Location:adoptions_confirmes');
exit();
?>