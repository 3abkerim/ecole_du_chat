<?php
// require '../modele/connexion_pdo.php';
// require '../modele/fonctions.php';
$OPDNS = getOPDNEnLigne($bdd);
?>
<div class="mainBk2 container-fluid conFluid content">
  <section>
    <div class="container">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">On parle de nous</div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <?php foreach ($OPDNS as $OPDN){ ?>
      <div class="row mt-5">
        <div class="col-12 text-center titreEvent display-6 mb-1 mt-4">
          -
          <?php echo $OPDN['titre']; ?>
          -
        </div>
        <div class="col-12 text-center h5">
          Publié par : <?php echo $OPDN['par_qui']; ?>
        </div>

        <?php 
            $date_article = DateTime::createFromFormat('Y-m-d H:i:s', $OPDN['date_publication']);
            $formatted_date = $date_article ? $date_article->format('d-m-Y') : $OPDN['date_publication'];
        ?>

        <div class="col-12 text-center mb-3">
          Le <?php echo $formatted_date; ?>
        </div> 

        <div class="col-12 text-center imgEvent">
        <?php 
        $images = getImagesOPDN($bdd,$OPDN['id_on_parle_de_nous']);
        if (count($images) > 0) {
          $firstImage = $images[0];
          $image_path = $firstImage['fichier'];
          $assets_position = strpos($image_path, 'public');
          $display_path = substr($image_path, $assets_position);
        ?>
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $OPDN['id_on_parle_de_nous']; ?>" class="modalEvent">
            <img class="img-fluid" src="<?php echo $display_path; ?>" alt="" />
          </button>
        <?php
        } else {
        ?>
          <img class="img-fluid" src="public/assets/images/non-disponible.jpg" alt="" />
        <?php
        }
        ?>
        </div>
        <div class="col-12 text-center mt-3 lienArticle">
          <a target="_blank" rel="noopener noreferrer" href="<?php echo $OPDN['lien']; ?>">Lien article</a>
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal_<?php echo $OPDN['id_on_parle_de_nous']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <img class="" src="<?php echo $display_path; ?>" alt="" />
          </div>
        </div>
      </div>

      <?php } ?>
    </div>
  </section>
</div>
