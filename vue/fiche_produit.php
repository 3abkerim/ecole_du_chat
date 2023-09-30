<?php
// require '../modele/connexion_pdo.php';
// require '../modele/fonctions.php';
$idProduit = isset($_GET['id']) ? intval($_GET['id']) : 0;
$produit = getProduitById($bdd,$idProduit);
?>
<div class="mainBk container-fluid conFluid content">
  <section>
    <div class="container">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">Boutique</div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row mt-5">
        <div class="col-md-12 mb-4 justify-content-sm-center d-flex">
          <!--CARD-->
          <input type="hidden" name="idProd" value="<?php echo $produit['id_produit']; ?>" />
            <div class="card text-center mb-2 cardChatFiche mb-5">
              <?php
          $images = getImagesProduit($bdd,$produit['id_produit']);
          if (count($images) > 1){ ?>
            <div id="carouselExampleControls" class="carousel slide">
              <div class="carousel-inner ">
                <?php 
            foreach ($images as $key=>$image){ 
              $image_path = $image['fichier'];
              $assets_position = strpos($image_path, 'public');
              $display_path = substr($image_path, $assets_position);
              ?>
  
                <div class="carousel-item CarouselItem <?php echo $key == 0 ? 'active' : ''; ?>">
                  <img src="<?php echo $display_path; ?>" class="d-block img-fluid" alt="..." />
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
                  $assets_position = strpos($image_path, 'public');
                  $display_path = substr($image_path, $assets_position);
                  ?>
                  <div class="emptyImage2">
                    <img class="d-block" src="<?php echo $display_path; ?>" alt="" />
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
                <div class="card-body elementscards">
                  <h5 class="card-title titre-card"><?php echo $produit['nom_produit']; ?></h5>

                  <div class="card-text h5">
                    <?php echo $produit['description_produit']; ?>
                  </div>
                  <div class="row mt-4 d-flex justify-content-center">
                    <div class="col-12">
                      <div class="d-flex justify-content-center prixProduit">
                        <?php echo $produit['prix_unit']; ?>
                        €
                      </div>
                    </div>
                  </div>
                </div>

                <a href="nous_contacter-<?php echo $idProduit; ?>" class="btn btn-primary adopterBtn2">Nous contacter</a>
              </div>
            </div>
          <!--END CARD-->
        </div>
      </div>
    </div>
  </section>
</div>
