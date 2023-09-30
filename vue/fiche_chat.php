<?php
  $idChat = isset($_GET['id']) ? intval($_GET['id']) : 0;
  $chat = getChatById($bdd,$idChat);
  
  if ($chat['en_ligne'] != 1) {
    header('Location:accueil');
    exit();
  }
  
  $images = getImagesChat($bdd,$idChat);
  
  
  function getCurrentUrl() {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
    $currentUrl = $protocol . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $currentUrl;
  }
  
  $currentUrl = getCurrentUrl();
  ?>
<div class="mainBk container-fluid conFluid content">
  <section>
    <div class="container">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats"><?php echo $chat['nom_chat']; ?></div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row mt-5">
        <div class="col-md-12 mb-4 justify-content-sm-center d-flex">
          <!--CARD-->
          <div class="card text-center mb-2 cardChatFiche mb-5">
            <?php
              if (count($images) > 1){ ?>
            <div id="carouselExampleControls" class="carousel slide">
              <div class="carousel-inner ">
                <?php 
                  foreach ($images as $key=>$image){ 
                  ?>
                <div class="carousel-item CarouselItem <?php echo $key == 0 ? 'active' : ''; ?>">
                  <img src="<?php echo $image['fichier']; ?>" class="d-block img-fluid" alt="..." />
                </div>
                <?php
                  }
                    ?>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
                </a>
              </div>
            </div>
            <?php
              } elseif(count($images) == 1) {
                $image_path = $images[0]['fichier'];
                ?>
            <div class="singleImageContainer emptyImage2">
              <img class="d-block" src="<?php echo $image_path; ?>" alt="" />
            </div>
            <?php
              } else {
                ?>
            <div class="carouselCard2 emptyImage2">
              <img class="d-block" src="public/assets/images/pexels-anna-shvets-4587959.jpg" alt="" />
            </div>
            <?php
              }
              ?>
            <div class="card-body elementscards">
              <h5 class="card-title titre-card"><?php echo $chat['nom_chat']; ?></h5>
              <div class="d-flex cardBody1 mb-4">
                <?php
                  if (isset($chat['sexe']) && $chat['sexe'] == 'Femelle'){ 
                  ?>
                <div class="sexe"><img src="public/assets/images/femenine.png" alt="" /></div>
                <?php }else{ ?>
                <div class="sexe"><img src="public/assets/images/male.png" alt="" /></div>
                <?php } ?>
                <div class="d-flex cardBody2">
                  <div class="sexe"><img src="public/assets/images/calendar.png" alt="" /></div>
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
                  <div><?php echo isset($chat['age'])?$chat['age']:'N/A' ; ?></div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 mb-3">
                  <div class="card-text textCard2">
                    <div class="titreTest">Description :</div>
                    <div class="test mt-3">
                      <?php echo isset($chat['description']) ? $chat['description']:'N/A'; ?>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 offset-lg-1">
                  <div class="info">
                    <div class="row">
                      <div class="col-12 mb-2 mt-2">
                        Identifié :
                        <?php 
                          $formatted_identifiant = chunk_split($chat['identifiant'], 2, ' ');
                          echo isset($chat['identifiant']) ? trim($formatted_identifiant) : 'Pas identifié';
                          ?>
                      </div>
                      <div class="col-12 mb-2">
                        Stérilisé :
                        <?php if (isset($chat['sterilise']) && $chat['sterilise'] == 1 ){ ?>
                        Oui
                        <?php }else{ ?>
                        Non
                        <?php } ?>
                      </div>
                      <div class="col-12 mb-2">
                        FIV :
                        <?php if (isset($chat['fiv']) && $chat['fiv'] == 1 ){ ?>
                        Oui
                        <?php }else{ ?>
                        Non
                        <?php } ?>
                      </div>
                      <div class="col-12 mb-2">
                        FLV :
                        <?php if (isset($chat['flv']) && $chat['flv'] == 1 ){ ?>
                        Oui
                        <?php }else{ ?>
                        Non
                        <?php } ?>
                      </div>
                      <div class="col-12 mb-2">
                        Race :
                        <?php echo isset($chat['race'])? $chat['race'] : 'N/A'; ?>
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3 mt-4">
                    <div class="col-12 text-start d-flex align-items-center justify-content-start">
                      <div class="share">Partagez la fiche de <?php echo $chat['nom_chat']; ?> : </div>
                      <a class="share2" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($currentUrl); ?>" target="_blank"><img class="share" src="public/assets/images/facebook.png" alt=""></a>
                    </div>
                  </div>
                </div>
              </div>
              <a href="form_adoption-<?php echo $chat['id_chat']; ?>" class="btn btn-primary adopterBtn2">Adopter</a>
            </div>
          </div>
          <!--END CARD-->
        </div>
      </div>
    </div>
  </section>
</div>