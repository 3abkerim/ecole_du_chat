<?php
  // require '../modele/connexion_pdo.php';
  // require '../modele/fonctions.php';
  
  // if($_SERVER["REQUEST_METHOD"] == "POST") {
  //   $_SESSION['form_data'] = $_POST;
  // }
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  
  
  $form_data = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : array();
  unset($_SESSION['form_data']);
  
  
  $idUser =isset($_SESSION['idUser']) ? $_SESSION['idUser'] : null;
  $user = getUser($bdd,$idUser);
  
  $idChat = isset($_GET['id']) ? intval($_GET['id']) : 0;
  $chat = getChatById($bdd,$idChat);
  
  $sexes = getCivliteUser($bdd);
  
  ?>
<div class="container mainContact content">
  <div class="row mt-5">
    <div class="col-12 text-center display-4 nosChats">Questionnaire pré-adoption</div>
  </div>


  <?php if (isset($_SESSION['error_recaptcha_ad'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error_recaptcha_ad'] // Short echo tag ?>
  </div>
  <?php unset($_SESSION['error_recaptcha_ad']); // remove it after displaying once ?>
  <?php endif; ?>


  <div class="formChat">
    <div class="row">
      <div class="col-12 text-center">Vous voulez adopter :</div>
    </div>
    <div class="row text-center">
      <div class="col-12 text-center h3"><?php echo $chat['nom_chat']; ?></div>
    </div>
    <div class="row">
      <div class="col-12 text-center">Veuillez remplir ce formulaire</div>
    </div>
  </div>
  <?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error'] // Short echo tag ?>
  </div>
  <?php unset($_SESSION['error']); // remove it after displaying once ?>
  <?php endif; ?>
  <!-- <div class="progress mb-3 mt-3">
    <div class="progress-bar w-25 Pbar" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
    </div> -->
  <div class="row">
    <div class="col-12">
      <form method="post" id="form-ad" action="traitement_formulaire_adoption">
      <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
        <input name="id_chat" value="<?php echo $chat['id_chat']; ?>" type="hidden" />
        <input name="id_user" value="" type="hidden" />
        <!-- Section 0 : presentation formulaire -->
        <div class="container" id="step0">
          <div class="row">
            <div class="col-12 boldTitre text-center">Bienvenue à notre processus d'adoption</div>
          </div>
          <div class="row">
            <div class="col-12">
              Nous sommes ravis que vous envisagiez d'adopter un compagnon à quatre pattes. L'adoption est un engagement sérieux qui peut durer plus d'une décennie, et il est crucial pour nous de nous assurer que chaque chat que nous aidons à placer trouve une maison aimante et appropriée.
              <br />
              Le questionnaire suivant nous aide à mieux comprendre votre situation, votre expérience avec les animaux, et vos attentes concernant l'adoption. Vos réponses nous aideront à déterminer si l'adoption est le bon choix pour vous. de vie. <br />
              <br />
              Voici un aperçu des sections que vous trouverez dans ce questionnaire : <br />
              <br />
              <div class="s-bold">1. Informations personnelles :</div>
              Ces informations de base nous permettent de vous contacter et de mieux comprendre votre situation. <br />
              <div class="s-bold">2. Situation de logement :</div>
              Cette section concerne l'environnement dans lequel le chat serait placé. <br />
              <div class="s-bold">3. Accueil du chat :</div>
              Ici, nous explorons la dynamique de votre foyer par rapport à l'accueil d'un chat. <br />
              <div class="s-bold">4. Expérience avec les animaux :</div>
              Dans cette section, nous vous demandons votre expérience passée avec les animaux. <br />
              <div class="s-bold">5. Antécédents avec les animaux :</div>
              Cette section concerne votre historique avec les animaux que vous avez possédés ou adoptés. <br />
              <div class="s-bold">6. Préparation pour l'adoption :</div>
              Ici, nous explorons votre préparation logistique pour accueillir un nouveau chat. <br />
              <div class="s-bold">7. Motivation et attentes :</div>
              Dans cette section, nous aimerions comprendre pourquoi vous voulez adopter et ce que vous attendez d'un animal de compagnie. <br />
              <div class="s-bold mb-5">8. Engagement :</div>
              Cette dernière section concerne votre engagement à long terme envers un animal de compagnie. <br />
              Veuillez répondre honnêtement à toutes les questions. Il n'y a pas de bonnes ou de mauvaises réponses, et chaque situation est unique. Notre objectif est de s'assurer que chaque chat est placé dans un foyer où il sera bien soigné et aimé. Une fois que vous avez rempli le formulaire, un
              membre de notre équipe vous contactera pour discuter des prochaines étapes. Merci de prendre le temps de remplir ce questionnaire. Votre réflexion et votre honnêteté sont appréciées et aideront à faire une énorme différence dans la vie d'un chat qui mérite une maison aimante.
            </div>
          </div>
          <div class="row mx-auto mt-3">
            <div class="col-12 text-center">
              <div onclick="nextStep(0,1)" class="formAdoptBtn mx-auto">Commencer</div>
            </div>
          </div>
        </div>
        <!-- ! FIN Section 0 : presentation formulaire -->
        <!-- Section 1 : Informations personnelles -->
        <div class="container" id="step1" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
              <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php for ($i=0;$i<7;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/paw.png" alt="" />
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">1. Informations personnelles</div>
          </div>
          <div class="row g-3 mt-5">
            <div class="col-md-4">
              <select class="form-select" aria-label="Default select example" name="civilite" required>
                <option selected disabled>Civilité</option>
                <?php foreach ($sexes as $sexe){ ?>
                <option value="<?php echo $sexe['id_civilite']; ?>"
                  <?php 
                    if(isset($user['civilite']) && $user['civilite'] == $sexe['civilite']) {
                        echo 'selected';
                    } elseif(isset($form_data['civilite']) && $form_data['civilite'] == $sexe['civilite']) {
                        echo 'selected';
                    }
                    ?>
                  >
                  <?php echo $sexe['civilite']; ?>
                </option>
                <?php } ?>
              </select>
              <label for="validationCustom01" class="form-label">Civilité *</label>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input type="text" class="form-control" id="validationCustom02" name="prenom" required value="<?php echo isset($user['prenom']) ? $user['prenom'] : (isset($form_data['prenom']) ? $form_data['prenom'] : ''); ?>"/>
                <label for="validationCustom01" class="form-label">Prénom *</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input type="text" class="form-control" id="validationCustom02" name="nom" required value="<?php echo isset($user['nom']) ? $user['nom'] : (isset($form_data['nom']) ? $form_data['nom'] : ''); ?>"/>
                <label for="validationCustom02" class="form-label">Nom *</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="adresse" required value="<?php echo isset($user['adresse']) ? $user['adresse'] : (isset($form_data['adresse']) ? $form_data['adresse'] : ''); ?>"/>
                <label for="validationCustomUsername" class="form-label">Adresse *</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <select type="departement" class="form-select" id="departement" name="departement">
                  <option selected disabled>Département</option>
                  <?php
                    $departements = getDep($bdd);
                    foreach ($departements as $departement) { 
                        $selected = '';
                        if (isset($user['id_departement']) && $user['id_departement'] == $departement['id_departement']) {
                            $selected = 'selected';
                        } elseif (isset($form_data['id_departement']) && $form_data['id_departement'] == $departement['id_departement']) {
                            $selected = 'selected';
                        }
                    ?>
                  <option value="<?php echo $departement['id_departement'];?>" <?php echo $selected; ?>><?php echo $departement['nom_departement'];?></option>
                  <?php } ?>
                </select>
                <label for="validationCustom03" class="form-label">Département</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <select name="ville" type="ville" class="form-select" id="ville">
                  <option selected disabled>Ville</option>
                  <?php
                    if (isset($user['id_ville'])) {
                        $villes = getVilles($bdd, $user['id_departement']);
                        foreach ($villes as $ville) {
                            $selected = '';
                            if ($user['id_ville'] == $ville['id_ville']) {
                                $selected = 'selected';
                            }
                            echo '<option value="' . $ville['id_ville'] . '" ' . $selected . '>' . $ville['nom_ville'] . '</option>';
                        }
                    }
                    elseif (isset($form_data['id_ville'])) {
                        $villes = getVilles($bdd, $form_data['id_departement']);
                        foreach ($villes as $ville) {
                            $selected = '';
                            if ($form_data['id_ville'] == $ville['id_ville']) {
                                $selected = 'selected';
                            }
                            echo '<option value="' . $ville['id_ville'] . '" ' . $selected . '>' . $ville['nom_ville'] . '</option>';
                        }
                    }
                    ?>
                </select>
                <label for="ville" class="form-label">Ville</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input value="<?php echo isset($user['email']) ? $user['email'] : (isset($form_data['email']) ? $form_data['email'] : ''); ?>" type="mail" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="mail" required />
                <label for="validationCustomUsername" class="form-label">Adresse email *</label>
              </div>
            </div>
            <?php if(!isset($_SESSION['idUser'])) { ?>
            <div class="col-md-4">
              <div class="form-outline">
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon1">+33</span>
                  <input type="text" name="numero" class="form-control" id="#" placeholder="6XXXXXXXX" pattern="\d{9}" onkeypress="return isNumber(event)" value="<?php echo isset($form_data['numero']) ? htmlspecialchars($form_data['numero']) : '' ?>" />
                </div>
                <label for="validationCustom05" class="form-label">Téléphone mobile</label>
              </div>
            </div>
            <?php }else{ ?>
            <div class="col-md-4">
              <div class="form-outline">
                <input value="<?php echo isset($user['numero']) ? $user['numero'] : (isset($form_data['numero']) ? $form_data['numero'] : ''); ?>"  type="text" class="form-control" id="validationCustom05" name="numero" onkeypress="return isNumber(event)"  />
                <label for="validationCustom05" class="form-label">Téléphone mobile</label>
              </div>
            </div>
            <?php } ?>
            <div class="col-md-4">
              <div class="form-outline">
                <input value="<?php echo isset($user['date_naissance']) ? $user['date_naissance'] : (isset($form_data['date_naissance']) ? $form_data['date_naissance'] : ''); ?>" type="date" class="form-control" id="validationCustom05" name="dob" required />
                <label for="validationCustom05" class="form-label">Date naissance *</label>
              </div>
            </div>
            <div class="col-md-4">
              <select class="form-select" aria-label="Default select example" name="statut">
                <option selected disabled>Statut</option>
                <?php 
                  $statuts = getStatutUser($bdd);
                  foreach ($statuts as $statut){
                      $selected = '';
                      if (isset($form_data['statut']) && $form_data['statut'] == $statut['id_statut']) {
                          $selected = 'selected';
                      }
                  ?>
                <option value="<?php echo $statut['id_statut']; ?>" <?php echo $selected; ?>><?php echo $statut['statut']; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-4">
              <select class="form-select" aria-label="Default select example" name="situation">
                <option selected disabled>Situation</option>
                <?php 
                  $sts = getSituationUser($bdd);
                  foreach ($sts as $st){
                    $selected = '';
                    if (isset($form_data['situation']) && $form_data['situation'] == $st['id_situation']) {
                      $selected = 'selected';
                  }
                  ?>
                <option value="<?php echo $st['id_situation']; ?>" <?php echo $selected; ?> ><?php echo $st['situation']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Vous avez des enfants? :</div>
            </div>
            <div class="col-md-4 mb-2">
              <select class="form-select" aria-label="Default select example" name="enfants">
              <?php
                for ($i = 0; $i <= 5; $i++) {
                    $selected = '';
                    if (isset($form_data['enfants']) && $form_data['enfants'] == $i) {
                        $selected = 'selected';
                    }
                    if ($i == 0) {
                        echo "<option value='0' $selected>Non</option>";
                    } else {
                        echo "<option value='$i' $selected>$i</option>";
                    }
                }
                ?>
              </select>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input value="<?php echo (isset($form_data['ageEnfants']) ? $form_data['ageEnfants'] : ''); ?>" type="text" class="form-control" id="validationCustom05" name="ageEnfants" />
                <label for="validationCustom05" class="form-label">Ages (ex : 12 - 9)</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Revenus mensuels :</div>
            </div>
            <div class="col-md-4">
              <select class="form-select" aria-label="Default select example" name="revenus">
                <option selected disabled>Revenus</option>
                <?php 
                  $revenus = getRevenusUser($bdd);
                  foreach ($revenus as $revenu){
                    $selected = '';
                  if (isset($form_data['revenus']) && $form_data['revenus'] == $revenu['id_revenus']) {
                    $selected = 'selected';
                  }
                  ?>
                <option value="<?php echo $revenu['id_revenus']; ?>" <?php echo $selected; ?> ><?php echo $revenu['revenus']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row mx-auto mt-4">
            <div onclick="previousStep(1,0)" class="col-6 text-center formAdoptBtn mx-auto">
              Précédent
            </div>
            <div onclick="nextStep(1,2)" class="col-6 text-center formAdoptBtn mx-auto">
              Suivant
            </div>
          </div>
        </div>
        <!-- ! FIN Section 1 : Informations personnelles -->
        <!-- Section 2 : Situation de logement -->
        <div class="container" id="step2" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
            <?php for ($i=0;$i<2;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php } ?>
            <?php for ($i=0;$i<6;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/paw.png" alt="" />
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">2. Situation de logement</div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Vous habitez en :</div>
            </div>
            <div class="col-md-4">
              <select class="form-select" aria-label="Default select example" name="type_logement">
                <option selected disabled>Logement</option>
                <?php 
                  $logements = getTypeLogement($bdd);
                  foreach ($logements as $logement){ 
                    if (isset($form_data['type_logement']) && $form_data['type_logement'] == $logement['id_type']) {
                      $selected = 'selected';
                  }
                  ?>
                <option value="<?php echo $logement['id_type']; ?>"  <?php echo $selected; ?> ><?php echo $logement['type']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Pièces du logement :</div>
            </div>
            <div class="col-md-4">
              <select class="form-select" aria-label="Default select example" name="taille_logement">
                <option selected disabled>Pièce(s)</option>
                <?php 
                  $tailles = getTailleLogement($bdd);
                  foreach ($tailles as $taille){ 
                    if (isset($form_data['taille_logement']) && $form_data['taille_logement'] == $taille['id_taille']) {
                      $selected = 'selected';
                  }
                  ?>
                <option value="<?php echo $taille['id_taille']; ?>" <?php echo $selected; ?> ><?php echo $taille['taille']; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Superficie du logement :</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input value="<?php echo (isset($form_data['superficie_logement']) ? $form_data['superficie_logement'] : ''); ?>" type="number" class="form-control" id="validationCustom05" name="superficie_logement" />
                <label for="validationCustom05" class="form-label">en m²</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si vous avec un balcon ou terrasse, le chat y aura-t’il accès ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="acces_balcon_terrasse" id="q1-1" value="1" <?php echo (isset($form_data['acces_balcon_terrasse']) && $form_data['acces_balcon_terrasse'] == '1') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="q1-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="acces_balcon_terrasse" id="q1-2" value="0" <?php echo (isset($form_data['acces_balcon_terrasse']) && $form_data['acces_balcon_terrasse'] == '0') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="q1-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Votre balcon est il sécurisé ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_balcon_secure" value="1"  id="flexRadioDefault1" <?php echo (isset($form_data['is_balcon_secure']) && $form_data['is_balcon_secure'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_balcon_secure" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['is_balcon_secure']) && $form_data['is_balcon_secure'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si votre balcon n’est pas sécurisé, êtes vous prêt à le faire ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="would_secure_balcon" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['would_secure_balcon']) && $form_data['would_secure_balcon'] == '1') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="would_secure_balcon" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['would_secure_balcon']) && $form_data['would_secure_balcon'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si oui de quelle façon ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="how_secure_balcon" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['how_secure_balcon']) ? $form_data['how_secure_balcon'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Habitez-vous à proximité d’une route avec beaucoup de circulation ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="danger" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['danger']) && $form_data['danger'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="danger" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['danger']) && $form_data['danger'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si vous êtes locataires, avez-vous la permission d’avoir un animal ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="permission" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['permission']) && $form_data['permission'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="permission" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['permission']) && $form_data['permission'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mx-auto mt-4">
            <div onclick="previousStep(2,1)" class="col-6 text-center formAdoptBtn mx-auto">
              Précédent
            </div>
            <div onclick="nextStep(2,3)" class="col-6 text-center formAdoptBtn mx-auto">
              Suivant
            </div>
          </div>
        </div>
        <!--! FIN Section 2 : Situation de logement -->
        <!-- Section 3 : Accueil de l'animal -->
        <div class="container" id="step3" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
            <?php for ($i=0;$i<3;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php } ?>
            <?php for ($i=0;$i<5;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/paw.png" alt="" />
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">3. Accueil du chat</div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Etes-vous véhiculé(e) ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="vehicule" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['vehicule']) && $form_data['vehicule'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="vehicule" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['vehicule']) && $form_data['vehicule'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Tous les membres du foyer sont-ils d’accord pour l’accueil d’un chat ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="accord" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['accord']) && $form_data['accord'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="accord" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['accord']) && $form_data['accord'] == '0') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Un des membres de votre famille souffre-t’il d’allergies ou d’asthme ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="asthme" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['asthme']) && $form_data['asthme'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="asthme" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['asthme']) && $form_data['asthme'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">vos enfants ont-ils eu des contacts avec des chats ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="contactsEnfants" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['contactsEnfants']) && $form_data['contactsEnfants'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="contactsEnfants" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['contactsEnfants']) && $form_data['contactsEnfants'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">si vous n’avez pas d’enfant et que vous prévoyez d’en avoir, cela vous semble t’il compatible avec la présence d’un chat ? (hygiène, toxoplasmose et allergie du chat disponibilité ...).</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="compatible" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['compatible']) && $form_data['compatible'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="compatible" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['compatible']) && $form_data['compatible'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mx-auto mt-4">
            <div onclick="previousStep(3,2)" class="col-6 text-center formAdoptBtn mx-auto">
              Précédent
            </div>
            <div onclick="nextStep(3,4)" class="col-6 text-center formAdoptBtn mx-auto">
              Suivant
            </div>
          </div>
        </div>
        <!-- !FIN Section 3 : Accueil de l'animal -->
        <!-- Section 4 : Expérience avec les animaux -->
        <div class="container" id="step4" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
            <?php for ($i=0;$i<4;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php } ?>
            <?php for ($i=0;$i<4;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/paw.png" alt="" />
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">4. Expérience avec les animaux</div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Avez-vous déjà eu des animaux ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="dejaEuAnimaux" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['dejaEuAnimaux']) && $form_data['dejaEuAnimaux'] == '1') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="dejaEuAnimaux" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['dejaEuAnimaux']) && $form_data['dejaEuAnimaux'] == '0') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Lesquels ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="desciptionAnimaux" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['desciptionAnimaux']) ? $form_data['desciptionAnimaux'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Quels sont les nuisances ou dégâts éventuels causés par un chat ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="nuisances" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['nuisances']) ? $form_data['nuisances'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Combien possédez-vous d’animaux actuellement ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="combienAnimaux" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['combienAnimaux']) ? $form_data['combienAnimaux'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">De quelle(s) espèces sont(ils) ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="especes" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['especes']) ? $form_data['especes'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Quel(s) sexe(s) ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="sexeAnimaux" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['sexeAnimaux']) ? $form_data['sexeAnimaux'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Sont-ils stérilisés ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="animauxSterlises" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['animauxSterlises']) && $form_data['animauxSterlises'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="animauxSterlises" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['animauxSterlises']) && $form_data['animauxSterlises'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Que pensez-vous de la stérilisation / castration ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="sterilisation" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['sterilisation']) ? $form_data['sterilisation'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Leurs vaccins sont ils à jour ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="vaccinsAJour" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['vaccinsAJour']) && $form_data['vaccinsAJour'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="vaccinsAJour" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['vaccinsAJour']) && $form_data['vaccinsAJour'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Nom et coordonnées de la clinique vétérinaire référente</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="cliniques" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['cliniques']) ? $form_data['cliniques'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Avez-vous déjà adopté un animal (par le biais d’un refuge ou association) ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="adoptionAsso" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['adoptionAsso']) && $form_data['adoptionAsso'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="adoptionAsso" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['adoptionAsso']) && $form_data['adoptionAsso'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mx-auto mt-4">
            <div onclick="previousStep(4,3)" class="col-6 text-center formAdoptBtn mx-auto">
              Précédent
            </div>
            <div onclick="nextStep(4,5)" class="col-6 text-center formAdoptBtn mx-auto">
              Suivant
            </div>
          </div>
        </div>
        <!-- ! FIN Section 4 : Expérience avec les animaux -->
        <!-- Section 5 : Antécédents avec les animaux -->
        <div class="container" id="step5" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
            <?php for ($i=0;$i<5;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php } ?>
            <?php for ($i=0;$i<3;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/paw.png" alt="" />
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">5. Antécédents avec les animaux</div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si jamais celui-ci est décédé, pouvez-vous nous indiquer la raison et son âge ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="raison_decedes" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['raison_decedes']) ? $form_data['raison_decedes'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Avez-vous dû vous séparer d’un animal par le passé ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="separation_animal" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['separation_animal']) && $form_data['separation_animal'] == '1') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="separation_animal" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['separation_animal']) && $form_data['separation_animal'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si oui pour quelle raison ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="raison_separation" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['raison_separation']) ? $form_data['raison_separation'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mx-auto mt-4">
            <div onclick="previousStep(5,4)" class="formAdoptBtn mx-auto col-6 text-center">
              Précédent
            </div>
            <div onclick="nextStep(5,6)" class="formAdoptBtn mx-auto col-6 text-center">
              Suivant
            </div>
          </div>
        </div>
        <!-- ! FIN Section 5 : Antécédents avec les animaux -->
        <!-- Section 6 : Préparation pour l'adoption -->
        <div class="container" id="step6" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
            <?php for ($i=0;$i<6;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php } ?>
            <?php for ($i=0;$i<2;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/paw.png" alt="" />
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">6. Préparation pour l'adoption</div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Combien d’heures par jour votre chat restera-t’il seul ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <input name="heuresSeul" class="form-control" type="number" value="<?php  echo (isset($form_data['heuresSeul']) ? $form_data['heuresSeul'] : ''); ?>" />
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Quelle nourriture allez-vous donner à votre chat ? chaton ? (sous quelle forme ? Quelle marque ?)</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="nourriture" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['nourriture']) ? $form_data['nourriture'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Avez-vous idée du budget mensuel pour un chaton ou chat (y compris frais vétérinaires) ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="budget" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['budget']) && $form_data['budget'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="budget" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['budget']) && $form_data['budget'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Quel montant moyen mensuel ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <input name="montantBudget" class="form-control" type="number" value="<?php  echo (isset($form_data['montantBudget']) ? $form_data['montantBudget'] : ''); ?>" />
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Lorsque vous vous absentez (week-ends, vacances), avez-vous un mode de garde ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="garde" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['garde']) ? $form_data['garde'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mx-auto mt-4">
            <div onclick="previousStep(6,5)" class="formAdoptBtn mx-auto col-6 text-center">
              Précédent
            </div>
            <div onclick="nextStep(6,7)" class="formAdoptBtn mx-auto col-6 text-center">
              Suivant
            </div>
          </div>
        </div>
        <!-- ! FIN Section 6 : Préparation pour l'adoption -->
        <!-- Section 7 : Motivation et attentes -->
        <div class="container" id="step7" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
            <?php for ($i=0;$i<7;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php } ?>
              <img class="col-1 paw" src="public/assets/images/paw.png" alt="" />
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">7. Motivation et attentes</div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Pour quelles raisons souhaitez-vous adopter un chaton ou chat ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="raisonAdopter" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['raisonAdopter']) ? $form_data['raisonAdopter'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Pour quelles raisons avez-vous choisi ce chaton ou chat ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="raisonCeChat" class="form-control" id="desc" rows="3"><?php  echo (isset($form_data['raisonCeChat']) ? $form_data['raisonCeChat'] : ''); ?></textarea>
                <label class="form-label" id="res" for="textAreaExample6">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mx-auto mt-4">
            <div onclick="previousStep(7,6)" class="formAdoptBtn mx-auto col-6 text-center">
              Précédent
            </div>
            <div onclick="nextStep(7,8)" class="col-6 text-center formAdoptBtn mx-auto">
              Suivant
            </div>
          </div>
        </div>
        <!--! FIN Section 7 : Motivation et attentes -->
        <!-- Section 8 : Engagement -->
        <div class="container" id="step8" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
            <?php for ($i=0;$i<8;$i++){ ?>
              <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">8. Engagement</div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Enfin, malgré votre bonne volonté, si l’adaptation se passe mal et que vous ne souhaitiez pas garder votre nouveau compagnon, pouvez-vous vous engager à le garder le temps de trouver une famille d’accueil ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="adoptionMal" value="1" id="flexRadioDefault1" <?php echo (isset($form_data['adoptionMal']) && $form_data['adoptionMal'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="adoptionMal" value="0" id="flexRadioDefault2" <?php echo (isset($form_data['adoptionMal']) && $form_data['adoptionMal'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="flexRadioDefault2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Pour valider ce formulaire, vous acceptez qu’un membre de l’association effectue une pré-visite et une post-visite à votre domicile</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="visite" id="flexCheckboxDefault" value="1" required />
                <!-- <label class="form-check-label" for="flexCheckboxDefault"> Oui </label> -->
              </div>
            </div>
          </div>

          <div class="row mx-auto mt-4">
            <div class="col-md-6 mx-auto text-center">
              <div onclick="previousStep(8,7)" class="text-center formAdoptBtn mx-auto">
                Précédent
              </div>
            </div>
            <div class="col-md-6 mx-auto text-center">
              <button type="submit" class="text-center formAdoptBtn mx-auto">Envoyer</button>
            </div>
          </div>


        </div>
        <!-- ! FIN Section 8 : Engagement -->
      </form>
    </div>
  </div>
</div>