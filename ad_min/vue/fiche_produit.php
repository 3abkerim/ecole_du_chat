<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$idProduit = isset($_GET['id']) ? intval($_GET['id']) : 0;
$produit = getProduitById($bdd, $idProduit);
// var_dump($opdn);
?>
<form action="traitement_modif_produit" method="post">
  <div class="row mt-5">
    <?php if (isset($_SESSION['error_boutique_3'])): ?>
    <div class="alert alert-danger">
      <?= $_SESSION['error_boutique_3'] ?>
    </div>
    <?php unset($_SESSION['error_boutique_3']);  ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_boutique_3'])): ?>
    <div class="alert alert-success">
      <?= $_SESSION['success_boutique_3'] ?>
    </div>
    <?php unset($_SESSION['success_boutique_3']);  ?>
    <?php endif; ?>

    <div class="col-lg-6">
      <div class="mb-3 row">
        <label for="nom_produit" class="col-sm-6 col-form-label">Nom produit *</label>
        <div class="col-sm-6">
          <input type="title" name="nom_produit" class="form-control" id="nom_produit" placeholder="Nom produit" value="<?php echo isset($produit['nom_produit']) ? htmlspecialchars($produit['nom_produit']) : '' ?>" required />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="prix_unit" class="col-sm-6 col-form-label">Prix unitaire *</label>
        <div class="col-sm-6">
          <input type="number" name="prix_unit" class="form-control" id="prix_unit" placeholder="Prix unitaire" value="<?php echo isset($produit['prix_unit']) ? htmlspecialchars($produit['prix_unit']) : '' ?>" required />
        </div>
      </div>
    </div>
    <div class="col-lg-6">

      <div class="mb-3 row">
        <label for="description_produit" class="col-sm-6 col-form-label">Description produit</label>
        <div class="col-sm-6">
          <textarea name="description_produit" id="description_produit" class="form-control" id="#" rows="3"><?php echo isset($produit['description_produit']) ? htmlspecialchars($produit['description_produit']) : '' ?></textarea>
        </div>
      </div>
    </div>

    <input type="hidden" value="<?php echo $produit['id_produit']; ?>" name="id_produit">

    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Mettre à jour</button>
    </div>
  </div>
</form>
