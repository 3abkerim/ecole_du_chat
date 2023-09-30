<?php
// require '../modele/connexion_pdo.php';
// require '../modele/fonctions.php';
$idArticle = isset($_GET['id']) ? intval($_GET['id']) : 0;
$article = getArticleById($bdd,$idArticle);

if ($article['en_ligne'] != 1) {
  header('Location:accueil');
  exit();
}

$images = getImagesArticle($bdd,$article['id_article']);
if (count($images) > 0) {
  $firstImage = $images[0];
  $image_path = $firstImage['fichier'];
  $assets_position = strpos($image_path, 'public');
  $facebookImage = substr($image_path, $assets_position);
}

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
        <div class="col-12 text-center display-4 nosChats">Article</div>
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
            <h5 class="card-title titre-card2"><?php echo $article['titre_article']; ?></h5>

            <?php 
              $date_article = DateTime::createFromFormat('Y-m-d H:i:s', $article['date_article']);
              $formatted_date = $date_article ? $date_article->format('d-m-Y H:i') : $article['date_article'];
            ?>

            <p class="card-text"><small class="text-muted"><?php echo $formatted_date; ?></small></p>

            <div class="row mb-3">
              <div class="col-12 text-start d-flex align-items-center justify-content-start">
                <div class="share">Partagez l'article : </div>
                <a class="share2" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($currentUrl); ?>" target="_blank"><img class="share" src="public/assets/images/facebook.png" alt=""></a>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card-text textCard2">
                  <div class="h4">
                  <?php echo $article['article']; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--END CARD-->
      </div>
    </div>
  </div>
</section>



</div>
