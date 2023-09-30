<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$idOPDN = isset($_GET['id']) ? intval($_GET['id']) : 0;
$opdn = getOPDNById($bdd, $idOPDN);
// var_dump($opdn);
?>
<form action="traitement_modif_opdn" method="post">
  <div class="row mt-5">

  <?php if (isset($_SESSION['error_opdn_2'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error_opdn_2'] ?>
  </div>
  <?php unset($_SESSION['error_opdn']);  ?>
  <?php endif; ?>

  <?php if (isset($_SESSION['success_opdn_2'])): ?>
  <div class="alert alert-success">
    <?= $_SESSION['success_opdn_2'] ?>
  </div>
  <?php unset($_SESSION['success_opdn_2']);  ?>
  <?php endif; ?>

    <div class="col-lg-6">
      <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Titre article *</label>
        <div class="col-sm-6">
          <input type="title" name="titre" class="form-control" id="exampleFormControlInput1" placeholder="Titre article" value="<?php echo isset($opdn['titre']) ? htmlspecialchars($opdn['titre']) : '' ?>" required />
        </div>
      </div>

      <div class="mb-3 row">
        <label for="exampleFormControlInput1" class="col-sm-6 col-form-label">Nom site ou journal *</label>
        <div class="col-sm-6">
          <input type="title" name="par_qui" class="form-control" id="exampleFormControlInput1" placeholder="Site / Journal" value="<?php echo isset($opdn['par_qui']) ? htmlspecialchars($opdn['par_qui']) : '' ?>" required />
        </div>
      </div>

    </div>
    <div class="col-lg-6">
    <div class="mb-3 row">
        <label for="chatDescription" class="col-sm-6 col-form-label">Lien article *</label>
        <div class="col-sm-6">
            <input type="text" class="form-control" value="<?php echo isset($opdn['lien']) ? htmlspecialchars($opdn['lien']) : '' ?>" name="lien" required >
        </div>
      </div>

      <div class="mb-3 row">
        <label for="chatDescription" class="col-sm-6 col-form-label">Date publication *</label>
        <div class="col-sm-6">
        <?php 
        $date_pub = isset($opdn['date_publication']) ? new DateTime($opdn['date_publication']) : new DateTime();
        ?>
            <input type="date" class="form-control" value="<?php echo $date_pub->format('Y-m-d'); ?>" name="date_pub" required>
        </div>
      </div>

      <input type="hidden" value="<?php echo $opdn['id_on_parle_de_nous']; ?>" name="id_opdn">

    </div>


    <div class="text-center mb-4">
      <button type="submit" class="btn btn-primary btnblack">Mettre à jour</button>
    </div>
  </div>
</form>
