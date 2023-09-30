<section class="testBk">
  <div class="container userBk2">
  <div class="row">
    <?php 
      if (!empty($chats_ad)) { 
        foreach($chats_ad as $chat_ad) { 
      ?>
    <div class="col-lg-4 col-md-8 mb-4 justify-content-sm-center d-flex">
      <!--CARD-->
      <div class="card text-center mb-2 cardChat">
        <?php
          $images = getImagesChat($bdd,$chat_ad['id_chat']);
          if (count($images) > 1) {
          ?>
        <div id="carouselExampleControls_<?php echo $chat_ad['id_chat']; ?>" class="carousel slide">
          <div class="carousel-inner carouselCard">
            <?php 
              foreach ($images as $key=>$image) { 
              ?>
            <div class="carousel-item <?php echo $key == 0 ? 'active' : ''; ?>">
              <img src="<?php echo $image['fichier']; ?>" class="d-block" alt="..." />
            </div>
            <?php  
              }
              ?>
            <a class="carousel-control-prev" href="#carouselExampleControls_<?php echo $chat_ad['id_chat']; ?>" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls_<?php echo $chat_ad['id_chat']; ?>" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
        <?php 
          } else {
            $singleImage = count($images) == 1 ? $images[0]['fichier'] : 'public/assets/images/pexels-anna-shvets-4587959.jpg'; 
          ?>
        <div class="carouselCard">
          <img class="d-block emptyImage mx-auto" src="<?php echo $singleImage; ?>" alt="" />
        </div>
        <?php 
          }
          ?>
        <div class="card-body elementscards">
          <h5 class="card-title titre-card"><?php echo $chat_ad['nom_chat']; ?></h5>
          <div class="d-flex cardBody1">
            <?php
              if (isset($chat_ad['sexe']) && $chat_ad['sexe'] == 'Femelle') { 
              ?>
            <div class="sexe"><img src="public/assets/images/femenine.png" alt="" /></div>
            <?php } else { ?>
            <div class="sexe"><img src="public/assets/images/male.png" alt="" /></div>
            <?php } ?>
            <div class="d-flex cardBody2">
              <div class="sexe"><img src="public/assets/images/calendar.png" alt="" /></div>
              <?php
                $birthdate = getAge($bdd, $chat_ad['id_chat']);
                $birthday = new DateTime($birthdate);
                $currentDate = new DateTime();
                $interval = $birthday->diff($currentDate);
                
                if($interval->format('%y') < 1) {
                    if($interval->format('%m') < 1) {
                        // If less than 1 month, show days
                        $chat_ad['age'] = $interval->format('%a jours');
                    } else {
                        // If less than 1 year, show months
                        $chat_ad['age'] = $interval->format('%m mois');
                    }
                } else {
                    // If 1 year or more, show years
                    if ($interval->format('%y') == 1) {
                        $chat_ad['age'] = $interval->format('%y an');
                    } else {
                        $chat_ad['age'] = $interval->format('%y ans');
                    }
                }
                ?>
              <div><?php echo $chat_ad['age']; ?></div>
            </div>
          </div>
          <div class="d-flex mt-3">
            Date adoption : <?php echo date('d-m-Y', strtotime($chat_ad['date_adoption'])); ?>
          </div>
        </div>
      </div>
      <!--END CARD-->
    </div>
    <?php 
      }
      } else { 
      ?>
    <div class="row ">
      <div class="col-12 text-center kittyAd mt-4">
        <img src="public/assets/images/kitty_ad.png" alt="">
      </div>
    </div>
    <div class="row mt-2">
      <div class="col-6 text-center mx-auto">
        Il semblerait que vous n'ayez pas encore eu l'opportunité d'adopter un chat. <br>
        Explorez nos adorables chats disponibles à l'adoption et trouvez votre compagnon idéal.
      </div>
    </div>
    <?php 
      } 
      ?>
  </div>
</section>