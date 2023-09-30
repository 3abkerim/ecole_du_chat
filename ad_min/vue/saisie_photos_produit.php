<?php
$idProduit = isset($_GET['id']) ? intval($_GET['id']) : 0;
$produit = getproduitById($bdd, $idProduit);
$images = getImagesproduit($bdd,$idProduit);
?>


<!-- <div class="row">
  <div class="col-md-12">
    <div class="titreGestion">Modifier images bien</div>
    <div class="goldTitre"></div>
  </div>
</div>

<div class="row">
  <div class="col-md-12 text-center mt-3 mb-4">Modifier</div>
</div> -->
<div class="text-center">
  <form method="post" action="traitement_modif_photo_produit" enctype="multipart/form-data" class="mt-5">
    <div class="mb-3 row">
      <label for="exampleFormControlInput1" class="col-lg-2 col-form-label">Ajouter des images</label>
      <div class="col-lg-4 mb-2">
        <input
          type="file"
          class="form-control"
          id="inputGroupFile04"
          aria-describedby="inputGroupFileAddon04"
          aria-label="Upload"
          name="photo[]"
          multiple
        />
      </div>
      <input type="hidden" name="idProduit" value="<?php echo $idProduit;?>" />
      <div class="col-lg-2">
        <button class="btn btn-primary" type="submit">Ajouter</button>
      </div>
    </div>
  </form>
</div>


<div class="row linePhotos"></div>

<div class="row mt-2">
    <div class="col-12 text-center">
        <?php if (isset($_SESSION['success_boutique_5'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_boutique_5'] ?>
        </div>
        <?php unset($_SESSION['success_boutique_5']);  ?>
        <?php endif; ?> 

        <?php if (isset($_SESSION['success_boutique_6'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_boutique_6'] ?>
        </div>
        <?php unset($_SESSION['success_boutique_6']);  ?>
        <?php endif; ?> 
    </div>
</div>

<div class="row mt-3" id="imageContainer">
  <?php foreach ($images as $indice => $image){ ?>
  <div class="col-lg-4 col-sm-12 image-container text-center mb-3 imageItem drop-target" draggable="true" data-image='<?php echo $image['id_image']; ?>'>
    <div class="row">
      <div class="col-lg-12 img-wrapper">
        <span class="number"><?php echo $indice+1; ?></span>
        <img class="img-fluid imgHeight" src="<?php echo $image['fichier']; ?>" alt=""/>
      </div>
      <div class="d-flex justify-content-center mt-2 col-lg-12">
        <a href="traitement_supprimer_photo_produit-<?php echo $idProduit; ?>-<?php echo $image['id_image']; ?>  ">
          <img class="dump" src="public/assets/images/dump.png" alt="" />
        </a>
      </div>
    </div>
  </div>
  <?php } ?>
</div>

<div id="truc">

</div>
