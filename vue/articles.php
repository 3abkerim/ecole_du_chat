<?php
// require '../modele/connexion_pdo.php';
// require '../modele/fonctions.php';
?>
<div class="mainBk2 container-fluid conFluid content">
  <section>
    <div class="container">
      <div class="row mt-5">
        <div class="col-12 text-center display-4 nosChats">Articles</div>
      </div>
    </div>
  </section>
  <section>
    <div class="container">
      <div class="row mt-5">
          <?php
          $articles = getArticlesEnLigne($bdd);
          foreach ($articles as $article){
          ?>
            <div class="col-md-12 mb-4 justify-content-sm-center d-flex">

          <!--CARD-->
          <div class="card mb-3 cardsArticles">
            <div class="row g-0">
              <?php
              $images = getImagesArticle($bdd, $article['id_article']);
              if (count($images) > 0) {
                $firstImage = $images[0];
                $image_path = $firstImage['fichier'];
                $assets_position = strpos($image_path, 'public');
                $display_path = substr($image_path, $assets_position);

              }
              
              
              ?>
              <div class="col-lg-4 imageArticle">
                <img src="<?php echo $display_path; ?>" class="img-fluid" alt="..." />
              </div>
              <div class="col-lg-8">
                <div class="card-body">
                  <h5 class="card-title mt-3 articleTitre"><?php echo $article['titre_article']; ?></h5>
                  <p class="card-text textCard3 mt-2">
                    <?php echo $article['article']; ?>
                  </p>

                  <?php 
                      $date_article = DateTime::createFromFormat('Y-m-d H:i:s', $article['date_article']);
                      $formatted_date = $date_article ? $date_article->format('d-m-Y H:i') : $article['date_article'];
                  ?>

                  <p class="card-text"><small class="text-muted"><?php echo $formatted_date; ?></small></p>

                  <div class="d-flex justify-content-center">
                  <a href="article-<?php echo $article['id_article']; ?>" class="btn btn-primary lireBtn">Lire suite</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--END CARD-->
          </div>

          <?php } ?>
      </div>
    </div>
  </section>
</div>
