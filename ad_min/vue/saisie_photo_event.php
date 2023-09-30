<?php
$idEvent = isset($_GET['id']) ? intval($_GET['id']) : 0;
$event = getEventById($bdd, $idEvent);
$image = getImageEvent($bdd,$idEvent);
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
  <form method="post" action="traitement_modif_photo_event" enctype="multipart/form-data" class="mt-5">
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
      <input type="hidden" name="idEvent" value="<?php echo $idEvent;?>" />
      <div class="col-lg-2">
        <button class="btn btn-primary" type="submit">Ajouter</button>
      </div>
    </div>
  </form>
</div>


<div class="row linePhotos"></div>

<div class="row mt-2">
    <div class="col-12 text-center">
        <?php if (isset($_SESSION['success_12'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_12'] ?>
        </div>
        <?php unset($_SESSION['success_12']);  ?>
        <?php endif; ?> 

        <?php if (isset($_SESSION['success_13'])): ?>
        <div class="alert alert-success">
            <?= $_SESSION['success_13'] ?>
        </div>
        <?php unset($_SESSION['success_13']);  ?>
        <?php endif; ?> 
    </div>
</div>

<?php if(!empty($image)){ ?>
<div class="row mt-3" >
  <div class="col-lg-4 col-sm-12 text-center mb-3 mx-auto" draggable="true" data-image='<?php echo $image['id_image']; ?>'>
      <img class="img-fluid" src="<?php echo $image['fichier']; ?>" alt=""/>
      <div class="d-flex justify-content-center mt-2 col-lg-12">
        <a href="traitement_supprimer_photo_event-<?php echo $idEvent; ?>-<?php echo $image['id_image']; ?>  ">
          <img class="dump" src="public/assets/images/dump.png" alt="" />
        </a>
      </div>
  </div>
</div>
<?php } ?>

