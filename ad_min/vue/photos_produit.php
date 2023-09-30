<!-- Photos -->
<?php
$idProd = isset($_GET['idProd']) ? intval($_GET['idProd']) : 0;
$produit = getProduitById($bdd, $idProd);
$images = getImages($bdd,$produit['id_produit']);

?>
<div class="row mt-5">
    <div class="col-12">
        <div class="goldTitre mb-1 mt-1"></div>
        <div class="titreGestion mb-1">
            Modifier images produit
        </div>
        <div class="goldTitre mb-2"></div>
    </div>
</div>

<div class="text-center">
  <form method="post" action="traitement_modif_photo_produit" enctype="multipart/form-data" class="mt-5">
    <input type="hidden" name="idProd" value="<?php echo $produit['id_produit'];?>" />
    <div class="mb-3 row">
      <label for="exampleFormControlInput1" class="col-lg-2 col-form-label">Ajouter des images</label>
      <div class="col-lg-4">
        <input
          type="file"
          class="form-control"
          id="inputGroupFile04"
          aria-describedby="inputGroupFileAddon04"
          aria-label="Upload"
          name="photo"
        />
      </div>
      <div class="col-lg-2">
        <button class="btn btn-primary btnblack mt-2" type="submit">Ajouter</button>
      </div>
    </div>
  </form>
</div>


<!-- <div class="row linePhotos"></div> -->

<div class="row mt-5">
  <?php foreach ($images as $indice => $image){ ?>
  <div class="col-lg-4 col-sm-12 image-container text-center mb-3">
    <div class="row">
      <div class="col-lg-12 img-wrapper">
        <span class="number"><?php echo $indice+1; ?></span>
        <img class="img-fluid imgHeight" src="<?php echo $image['fichier']; ?>" alt=""/>
      </div>
      <div class="d-flex justify-content-center mt-2 col-lg-12">
        <input type="text" />
        <a href="traitement_supprimer_photo_produit-<?php echo $produit['id_produit']; ?>-<?php echo $image['id_image']; ?>  ">
          <img class="dump" src="public/assets/images/dump.png" alt="" />
        </a>
      </div>
    </div>
  </div>
  <?php } ?>
</div>
