<?php
session_start();
require '../modele/connexion_pdo.php';
require '../modele/fonctions.php';

$product_id = $_POST['product_id'];
$new_quantity = $_POST['new_quantity'];

$result = modifQteProd($bdd, $product_id, $new_quantity);

$idPanier = $_SESSION['idPanier'];
updateTotalPanier($bdd, $idPanier);

$updated_total = getTotalPanier($bdd, $idPanier);

$item_count = getCartItemCount(($cartItems));

echo json_encode(['updated_subtotal' => $updated_total, 'item_count' => $item_count]);
?>
