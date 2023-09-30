<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// require '../modele/connexion_pdo.php';
// require '../modele/fonctions.php';
$produits = getProduitsEnLigne($bdd);
if(count($produits)>0){
?>
<div class="mainBk2 container-fluid conFluid content">
  <section>
    <div class="container">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">Boutique</div>
      </div>
    </div>
  </section>
  <section>
    <div class="row mt-5">
      <?php
      foreach($produits as $produit){ 
      ?>
      <div class="col-lg-4 col-md-6 mb-4 justify-content-sm-center d-flex">
        <!--CARD-->
        <div class="card text-center mb-2 cardChat">
          <?php
          $images = getImagesProduit($bdd,$produit['id_produit']);
          if (count($images)>1){ ?>
            <div id="carouselExampleControls_<?php echo $produit['id_produit']; ?>" class="carousel slide">
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
              <a class="carousel-control-prev" href="#carouselExampleControls_<?php echo $produit['id_produit']; ?>" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls_<?php echo $produit['id_produit']; ?>" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
              </a>
            </div>
          </div>
          <?php
            }else{
              $singleImage = count($images) == 1 ? $images[0]['fichier'] : 'public/assets/images/pexels-anna-shvets-4587959.jpg'; ?>
          <div class="carouselCard">
            <img class="d-block emptyImage mx-auto" src="<?php echo $singleImage; ?>" alt="" />
          </div>
          <?php
            }
            ?>

          <div class="card-body elementscards">
            <h5 class="card-title titre-card"><?php echo $produit['nom_produit']; ?></h5>

            <div class="card-text textCard mt-2">
              <?php echo $produit['description_produit']; ?>
            </div>

            <div class="d-flex justify-content-center prixProduit mt-2">
              -
              <?php echo $produit['prix_unit']; ?>
              € -
            </div>
            <a href="fiche_produit-<?php echo $produit['id_produit']; ?>" class="btn btn-primary adopterBtn">Voir</a>
          </div>
        </div>
        <!--END CARD-->
      </div>
      <?php } ?>
    </div>
  </section>
</div>
<?php
}else{ 
  include '/home/ecoledl/www/vue/produits_indisponible.php';
  } 
 ?>