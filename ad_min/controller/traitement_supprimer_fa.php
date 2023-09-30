<?php 
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

session_start();

$idUser = isset($_GET['id']) ? intval($_GET['id']) : 0;

$user = getUserById($bdd,$idUser);

supprimerFa($bdd,$idUser);

$_SESSION['success_fa_delete_2'] = $user['prenom'].' '.$user['nom'] .' a été supprimé de votre liste familles accueil avec succés';

header('Location:familles_accueil');
?>