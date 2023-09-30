<?php
$form_data_produits = isset($_SESSION['form_data_produits']) ? $_SESSION['form_data_produits'] : array();
unset($_SESSION['form_data_produits']);
?>
<form action="traitement_ajout_produit" method="post">
  <div class="row mt-5">
    <?php if (isset($_SESSION['error_boutique'])): ?>
    <div class="alert alert-danger">
      <?= $_SESSION['error_boutique'] ?>
    </div>
    <?php unset($_SESSION['error_boutique']);  ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success_boutique'])): ?>
    <div class="alert alert-success">
      <?= $_SESSION['success_boutique'] ?>
    </div>
    <?php unset($_SESSION['success_boutique']);  ?>
    <?php endif; ?>

    <div class="col-lg-6">
      <div class="mb-3 row">
        <label for="nom_produit" class="col-sm-6 col-form-label">Nom produit *</label>
        <div class="col-sm-6">
          <input type="title" name="nom_produit" class="form-control" id="nom_produit" placeholder="Nom produit" value="<?php echo isset($form_data_produits['nom_produit']) ? htmlspecialchars($form_data_produits['nom_produit']) : '' ?>" required />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="prixUnit" class="col-sm-6 col-form-label">Prix unitaire *</label>
        <div class="col-sm-6">
          <input type="number" name="prixUnit" class="form-control" id="prixUnit" placeholder="Prix unitaire" value="<?php echo isset($form_data_produits['prixUnit']) ? htmlspecialchars($form_data_produits['prixUnit']) : '' ?>" required />
        </div>
      </div>
    </div>
    <div class="col-lg-6">


      <div class="mb-3 row">
        <label for="produitDescription" class="col-sm-6 col-form-label">Description produit</label>
        <div class="col-sm-6">
          <textarea name="produitDescription" id="produitDescription" class="form-control" id="#" rows="3"><?php echo isset($form_data_produits['produitDescription']) ? htmlspecialchars($form_data_produits['produitDescription']) : '' ?></textarea>
        </div>
      </div>
    </div>

    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Ajouter</button>
    </div>
  </div>
</form>
