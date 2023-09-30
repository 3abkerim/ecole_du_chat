
    <!-- MAIN -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3 sidebar">
          <div class="row sidebarrow">
  
            <div class="col-12 mb-3">
              <button class="btnFiltre" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample1" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                Type de bien
              </button>
              <div class="collapse multi-collapse" id="multiCollapseExample1">
                <div class="card card-body">
                  <label>Maison
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                  </label>
                  <label>Appartement
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>Immeuble
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>Terrain
                      <input type="checkbox">
                      <span class="checkmark"></span>
                    </label>
                  <label>Local commercial
                  <input type="checkbox">
                  <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>
  
            <div class="col-12 mb-3">
              <button class="btnFiltre" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample2" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                Recherche par prix
              </button>
              <div class="collapse multi-collapse" id="multiCollapseExample2">
                <div class="card card-body">
                  <label>50 000€ - 100 000€
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                  </label>
                  <label>100 000€ - 200 000€
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>200 000€ - 500 000€
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>500 000€ - Plus
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>
            
            <div class="col-12 mb-3">
              <button class="btnFiltre" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample3" href="#multiCollapseExample3" role="button" aria-expanded="false" aria-controls="multiCollapseExample3">
                  Recherche par surface
              </button>
              <div class="collapse multi-collapse" id="multiCollapseExample3">
                <div class="card card-body">
                  <label>50m²-70m²
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                  </label>
                  <label>70m²-100m²
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>100m²-150m²
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>Plus de 150m²
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>
  
            <div class="col-12 mb-3">
              <button class="btnFiltre" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample4" href="#multiCollapseExample4" role="button" aria-expanded="false" aria-controls="multiCollapseExample4">
                  Recherche par pièce(s)
              </button>
              <div class="collapse multi-collapse" id="multiCollapseExample4">
                <div class="card card-body">
                  <label>1 pièce
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                  </label>
                  <label>2 pièces
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>3 pièces
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>4 pièces
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>Plus de 4 pièces
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>
  
            <div class="col-12 mb-3">
              <button class="btnFiltre" type="button" data-bs-toggle="collapse" data-bs-target="#multiCollapseExample5" href="#multiCollapseExample4" role="button" aria-expanded="false" aria-controls="multiCollapseExample5">
                Autre(s)
              </button>
              <div class="collapse multi-collapse" id="multiCollapseExample5">
                <div class="card card-body">
                  <label>Balcon
                    <input type="checkbox" checked="checked">
                    <span class="checkmark"></span>
                  </label>
                  <label>Parking
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>Cave
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>Sous-sol
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                  <label>Terrasse
                      <input type="checkbox">
                      <span class="checkmark"></span>
                  </label>
                  <label>Jardin
                    <input type="checkbox">
                    <span class="checkmark"></span>
                  </label>
                </div>
              </div>
            </div>
  
            <div class="col-12">
              <img class="logoSidebar" src="assets/images/uptowns.png" alt="">
            </div>
            
  
  
          </div>
        </div>
  
      <div class="col-md-9">
        <div class="row row row-cols-1 row-cols-md-2 row-cols-lg-3 testgap">

  <!--CARD-->
  <?php 
  for($i = 1; $i <=10; $i++){
    ?>
          <div class="card text-center cardVendre" style="width: 23rem;">
            <div id="carouselExampleControls" class="carousel slide carouselCard" data-bs-ride="carousel">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="assets/images/house1.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="assets/images/house2.jpg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="assets/images/house3.jpg" class="d-block w-100" alt="...">
                </div>
              </div>
              <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
              </a>
              <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only"></span>
              </a>
            </div>
            <div class="card-body elementscards">
                <h5 class="card-title titre-card">Card title</h5>
                <div class="prix">115 500 €</div>
                <div class="descAnnonce d-flex">
                  <div>6</div>
                  <div class="da1">pièce(s)</div>
                  <div class="da1">-</div>
                  <div>111</div>
                  <div class="da1">m²</div>
                  <div class="da1">-</div>
                  <div class="da1">Réf :</div>
                  <div>41555</div>
              </div>
              <div class="apercu d-flex" onclick="window.location='index.php?page=8'">
                  <img src="assets/images/eye.png" class="eye"></img>
                  <div>Aperçu</div>
              </div>
            </div>
          </div>
<?php
  }
  ?>
  <!--END CARD-->


        </div>
      </div>
    </div>
