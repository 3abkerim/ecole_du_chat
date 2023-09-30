<?php
  // require '../modele/connexion_pdo.php';
  // require '../modele/fonctions.php';
  $events = getEventsEnLigne($bdd);
  ?>
<div class="mainBk2 container-fluid conFluid content">
  <section>
    <div class="container">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">Événements</div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <?php foreach ($events as $event){ ?>
      <div class="row mt-5">
        <div class="col-12 text-center titreEvent mb-3 mt-4">
          -
          <?php echo $event['event']; ?>
          -
        </div>
        <?php
          $start = new DateTime($event['date_event']);
          $end = new DateTime($event['date_fin_event']);
          ?>
        <?php if($start->format('Y-m-d') == $end->format('Y-m-d')){ ?>
        <div class="text-center mb-3 h5">
          <?php echo 'Le ' . $start->format('d/m/Y') . ' de ' . $start->format('H:i') . ' à ' . $end->format('H:i'); ?>
        </div>
        <?php }else{ ?>
        <div class="text-center mb-3 h5">
          <?php echo 'De ' . $start->format('d/m/Y à H:i') . ' jusqu\'à le ' . $end->format('d/m/Y à H:i') ?>
        </div>
        <?php } ?>
        <div class="col-12 text-center imgEvent">
          <?php 
            $images = getImagesEvent($bdd,$event['id_event']);
            if (count($images) > 0) {
              $firstImage = $images[0];
              $image_path = $firstImage['fichier'];
              $assets_position = strpos($image_path, 'public');
              $display_path = substr($image_path, $assets_position);
              ?>
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal_<?php echo $event['id_event']; ?>" class="modalEvent">
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
      </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal_<?php echo $event['id_event']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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