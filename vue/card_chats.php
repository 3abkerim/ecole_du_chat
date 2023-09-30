<div class="col-lg-4 col-md-6 mb-4 justify-content-sm-center d-flex">
  <!--CARD-->
  <div class="card text-center mb-2 cardChat">
    <?php
      $images = getImagesChat($bdd,$chat['id_chat']);
      if (count($images) > 1){ ?>
    <div id="carouselExampleControls_<?php echo $chat['id_chat']; ?>" class="carousel slide">
      <div class="carousel-inner carouselCard">
        <?php 
          foreach ($images as $key=>$image){ 
            ?>
        <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
          <img src="<?php echo $image['fichier']; ?>" class="d-block" alt="..." />
        </div>
        <?php  
          }
            ?>
        <a class="carousel-control-prev" href="#carouselExampleControls_<?php echo $chat['id_chat']; ?>" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls_<?php echo $chat['id_chat']; ?>" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
        </a>
      </div>
    </div>
    <?php 
      } else {
        $singleImage = count($images) == 1 ? $images[0]['fichier'] : 'public/assets/images/pexels-anna-shvets-4587959.jpg'; ?>
    <div class="carouselCard">
      <img class="d-block emptyImage mx-auto" src="<?php echo $singleImage; ?>" alt="" />
    </div>
    <?php 
      }
      ?>
    <div class="card-body elementscards">
      <div class="card-title titre-card d-flex justify-content-center align-items-center">
        <div class="testNom">
          <h3 class=""><?php echo $chat['nom_chat']; ?></h3>
        </div>
        <?php
          if (isset($chat['sexe']) && $chat['sexe'] == 'Femelle'){ 
          ?>
        <div class="sexe"><img src="public/assets/images/femenine.png" alt="" /></div>
        <?php }else{ ?>
        <div class="sexe"><img src="public/assets/images/male.png" alt="" /></div>
        <?php } ?>
      </div>
      <div class="d-flex cardBody1">
        <div class="d-flex cardBody2">
          <div class="calendar"><img src="public/assets/images/calendar.png" alt="" /></div>
          <?php
            $birthdate = getAge($bdd, $chat['id_chat']);
            $birthday = new DateTime($birthdate);
            $currentDate = new DateTime();
            $interval = $birthday->diff($currentDate);
            
            if($interval->format('%y') < 1) {
                if($interval->format('%m') < 1) {
                    // If less than 1 month, show days
                    $chat['age'] = $interval->format('%a jours');
                } else {
                    // If less than 1 year, show months
                    $chat['age'] = $interval->format('%m mois');
                }
            } else {
                // If 1 year or more, show years
                if ($interval->format('%y') == 1) {
                    $chat['age'] = $interval->format('%y an');
                } else {
                    $chat['age'] = $interval->format('%y ans');
                }
            }
            ?>
          <div><?php echo $chat['age']; ?></div>
        </div>
      </div>
      <div class="card-text textCard mt-3">
        <?php echo $chat['description']; ?>
      </div>
      <a href="fiche_chat-<?php echo $chat['id_chat']; ?>" class="btn btn-primary adopterBtn">Fiche</a>
    </div>
  </div>
  <!--END CARD-->
</div>