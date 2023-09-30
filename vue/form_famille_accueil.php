<?php
  // ini_set('display_errors', 1);
  // ini_set('display_startup_errors', 1);
  // error_reporting(E_ALL);
  
  
  $form_data_2_2 = isset($_SESSION['form_data_2_2']) ? $_SESSION['form_data_2_2'] : array();
  unset($_SESSION['form_data_2_2']);
  
  
  $idUser =isset($_SESSION['idUser']) ? $_SESSION['idUser'] : null;
  $user = getUser($bdd,$idUser);
  
  $idChat = isset($_GET['id']) ? intval($_GET['id']) : 0;
  $chat = getChatById($bdd,$idChat);
  
  $sexes = getCivliteUser($bdd);
  
  ?>
<div class="container mainContact content">
  <div class="row mt-5">
    <div class="col-12 text-center display-4 nosChats">Questionnaire pour devenir une famille d'accueil</div>
  </div>

  <!-- MESSAGES ERREURS -->
  <?php if (isset($_SESSION['error_recaptcha_fa'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error_recaptcha_fa']  ?>
  </div>
  <?php unset($_SESSION['error_recaptcha_fa']); ?>
  <?php endif; ?>
  <?php if (isset($_SESSION['error'])): ?>
  <div class="alert alert-danger">
    <?= $_SESSION['error']  ?>
  </div>
  <?php unset($_SESSION['error']); ?>
  <?php endif; ?>
  <!-- FIN MESSAGES ERREURS -->
  
  <div class="row">
    <div class="col-12">
      <form id="form-fa" method="post" action="traitement_formulaire_fa">
        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
        <!-- Section 0 : presentation formulaire -->
        <div id="step0">
          <div class="row">
            <div class="col-12 boldTitre text-center">Bienvenue à notre processus de devenir une famille d'accueil</div>
          </div>
          <div class="row">
            <div class="col-12">
              Nous sommes ravis que vous envisagiez de devenir une famille d'accueil pour un chat. Fournir une maison temporaire à un chat dans le besoin est un acte de générosité et de compassion. Il est crucial pour nous de nous assurer que chaque chat reçoit les soins appropriés pendant son séjour temporaire.
              <br />
              Le questionnaire suivant nous aide à mieux comprendre votre situation, votre expérience avec les chats, et vos attentes concernant l'accueil. Vos réponses nous aideront à déterminer si devenir une famille d'accueil est le bon choix pour vous. <br />
              <br />
              Voici un aperçu des sections que vous trouverez dans ce questionnaire : <br />
              <br />
              <div class="s-bold">1. Informations personnelles :</div>
              Ces informations de base nous permettent de vous contacter et de mieux comprendre votre situation. <br />
              <div class="s-bold">2. Situation de logement :</div>
              Cette section concerne l'environnement dans lequel le chat serait placé. <br />
              <div class="s-bold">3. Accueil du chat :</div>
              Ici, nous explorons la dynamique de votre foyer par rapport à l'accueil d'un chat. <br />
              <div class="s-bold">4. Expérience avec les chats :</div>
              Dans cette section, nous vous demandons votre expérience passée avec les chats. <br />
              <div class="s-bold">5. Antécédents avec les chats :</div>
              Cette section concerne votre historique avec les chats que vous avez possédés ou pour lesquels vous avez été famille d'accueil. <br />
              <div class="s-bold">6. Préparation pour l'accueil :</div>
              Ici, nous explorons votre préparation logistique pour accueillir un nouveau chat. <br />
              <div class="s-bold">7. Motivation et attentes :</div>
              Dans cette section, nous aimerions comprendre pourquoi vous voulez devenir une famille d'accueil et ce que vous attendez de cette expérience. <br />
              <div class="s-bold mb-5">8. Engagement :</div>
              Cette dernière section concerne votre engagement à court terme envers un chat de compagnie. <br />
              Veuillez répondre honnêtement à toutes les questions. Il n'y a pas de bonnes ou de mauvaises réponses, et chaque situation est unique. Notre objectif est de s'assurer que chaque chat est placé dans un foyer où il sera bien soigné et aimé. Une fois que vous avez rempli le formulaire, un
              membre de notre équipe vous contactera pour discuter des prochaines étapes. Merci de prendre le temps de remplir ce questionnaire. Votre réflexion et votre honnêteté sont appréciées et aideront à faire une énorme différence dans la vie d'un chat qui a besoin d'une maison temporaire.
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
        <div id="step1" style="display: none">
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
                    } elseif(isset($form_data_2_2['civilite']) && $form_data_2_2['civilite'] == $sexe['civilite']) {
                        echo 'selected';
                    }
                    ?>
                  >
                  <?php echo $sexe['civilite']; ?>
                </option>
                <?php } ?>
              </select>
              <label class="form-label">Civilité *</label>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input type="text" class="form-control" name="prenom" required value="<?php echo isset($user['prenom']) ? $user['prenom'] : (isset($form_data_2_2['prenom']) ? $form_data_2_2['prenom'] : ''); ?>"/>
                <label class="form-label">Prénom *</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input type="text" class="form-control" name="nom" required value="<?php echo isset($user['nom']) ? $user['nom'] : (isset($form_data_2_2['nom']) ? $form_data_2_2['nom'] : ''); ?>"/>
                <label class="form-label">Nom *</label>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-outline">
                <input type="text" class="form-control" aria-describedby="inputGroupPrepend" name="adresse" required value="<?php echo isset($user['adresse']) ? $user['adresse'] : (isset($form_data_2_2['adresse']) ? $form_data_2_2['adresse'] : ''); ?>"/>
                <label class="form-label">Adresse *</label>
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
                        } elseif (isset($form_data_2_2['id_departement']) && $form_data_2_2['id_departement'] == $departement['id_departement']) {
                            $selected = 'selected';
                        }
                    ?>
                  <option value="<?php echo $departement['id_departement'];?>" <?php echo $selected; ?>><?php echo $departement['nom_departement'];?></option>
                  <?php } ?>
                </select>
                <label class="form-label">Département</label>
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
                    elseif (isset($form_data_2_2['id_ville'])) {
                        $villes = getVilles($bdd, $form_data_2_2['id_departement']);
                        foreach ($villes as $ville) {
                            $selected = '';
                            if ($form_data_2_2['id_ville'] == $ville['id_ville']) {
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
                <input value="<?php echo isset($user['email']) ? $user['email'] : (isset($form_data_2_2['email']) ? $form_data_2_2['email'] : ''); ?>" type="mail" class="form-control" aria-describedby="inputGroupPrepend" name="mail" required />
                <label class="form-label">Adresse email *</label>
              </div>
            </div>
            <?php if(!isset($_SESSION['idUser'])) { ?>
            <div class="col-md-4">
              <div class="form-outline">
                <div class="input-group">
                  <span class="input-group-text" id="basic-addon1">+33</span>
                  <input placeholder="6XXXXXXXX" value="<?php echo isset($user['numero']) ? $user['numero'] : (isset($form_data_2_2['numero']) ? $form_data_2_2['numero'] : ''); ?>"  type="text" onkeypress="return isNumber(event)" class="form-control" name="numero" />
                </div>
                <label class="form-label">Téléphone mobile</label>
              </div>
            </div>
            <?php }else{ ?>
            <div class="col-md-4">
              <div class="form-outline">
                <input value="<?php echo isset($user['numero']) ? $user['numero'] : (isset($form_data_2_2['numero']) ? $form_data_2_2['numero'] : ''); ?>"  type="text" class="form-control" name="numero" onkeypress="return isNumber(event)"  />
                <label class="form-label">Téléphone mobile</label>
              </div>
            </div>
            <?php } ?>
            <div class="col-md-4">
              <div class="form-outline">
                <input value="<?php echo isset($user['date_naissance']) ? $user['date_naissance'] : (isset($form_data_2_2['date_naissance']) ? $form_data_2_2['date_naissance'] : ''); ?>" type="date" class="form-control"  name="dob" required />
                <label class="form-label">Date naissance *</label>
              </div>
            </div>
            <div class="col-md-4">
              <select class="form-select" aria-label="Default select example" name="statut">
                <option selected disabled>Statut</option>
                <?php 
                  $statuts = getStatutUser($bdd);
                  foreach ($statuts as $statut){
                      $selected = '';
                      if (isset($form_data_2_2['statut']) && $form_data_2_2['statut'] == $statut['id_statut']) {
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
                    if (isset($form_data_2_2['situation']) && $form_data_2_2['situation'] == $st['id_situation']) {
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
                    if (isset($form_data_2_2['enfants']) && $form_data_2_2['enfants'] == $i) {
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
                <input value="<?php echo (isset($form_data_2_2['ageEnfants']) ? $form_data_2_2['ageEnfants'] : ''); ?>" type="text" class="form-control" name="ageEnfants" />
                <label class="form-label">Ages (ex : 12 - 9)</label>
              </div>
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
        <div id="step2" style="display: none">
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
                    if (isset($form_data_2_2['type_logement']) && $form_data_2_2['type_logement'] == $logement['id_type']) {
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
                    if (isset($form_data_2_2['taille_logement']) && $form_data_2_2['taille_logement'] == $taille['id_taille']) {
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
                <input value="<?php echo (isset($form_data_2_2['superficie_logement']) ? $form_data_2_2['superficie_logement'] : ''); ?>" type="number" class="form-control" name="superficie_logement" />
                <label class="form-label">en m²</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si vous avec un balcon ou terrasse, le chat y aura-t’il accès ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="acces_balcon_terrasse" id="q1-1" value="1" <?php echo (isset($form_data_2_2['acces_balcon_terrasse']) && $form_data_2_2['acces_balcon_terrasse'] == '1') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="q1-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="acces_balcon_terrasse" id="q1-2" value="0" <?php echo (isset($form_data_2_2['acces_balcon_terrasse']) && $form_data_2_2['acces_balcon_terrasse'] == '0') ? 'checked' : ''; ?>/>
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
                <input class="form-check-input" type="radio" name="is_balcon_secure" value="1"  id="q2-1" <?php echo (isset($form_data_2_2['is_balcon_secure']) && $form_data_2_2['is_balcon_secure'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q2-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="is_balcon_secure" value="0" id="q2-2" <?php echo (isset($form_data_2_2['is_balcon_secure']) && $form_data_2_2['is_balcon_secure'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q2-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si votre balcon n’est pas sécurisé, êtes vous prêt à le faire ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="would_secure_balcon" value="1" id="q3-1" <?php echo (isset($form_data_2['would_secure_balcon']) && $form_data_2['would_secure_balcon'] == '1') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="q3-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="would_secure_balcon" value="0" id="q3-2" <?php echo (isset($form_data_2['would_secure_balcon']) && $form_data_2['would_secure_balcon'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q3-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si oui de quelle façon ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="how_secure_balcon" class="form-control"  rows="3"><?php  echo (isset($form_data_2['how_secure_balcon']) ? $form_data_2['how_secure_balcon'] : ''); ?></textarea>
                <label class="form-label" >Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Habitez-vous à proximité d’une route avec beaucoup de circulation ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="danger" value="1" id="q4-1" <?php echo (isset($form_data_2['danger']) && $form_data_2['danger'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q4-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="danger" value="0" id="q4-2" <?php echo (isset($form_data_2['danger']) && $form_data_2['danger'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q4-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si vous êtes locataires, avez-vous la permission d’avoir un animal ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="permission" value="1" id="q5-1" <?php echo (isset($form_data_2['permission']) && $form_data_2['permission'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q5-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="permission" value="0" id="q5-2" <?php echo (isset($form_data_2['permission']) && $form_data_2['permission'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q5-2"> Non </label>
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
        <div id="step3" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
            <?php for ($i=0;$i<3;$i++){ ?>
            <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php } ?>
            <?php for ($i=0;$i<5;$i++){ ?>
            <img class="col-1 paw" src="public/assets/images/paw.png" alt="" />
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">3. Accueil de l'animal</div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Etes-vous véhiculé(e) ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="vehicule" value="1" id="q6-1" <?php echo (isset($form_data_2['vehicule']) && $form_data_2['vehicule'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q6-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="vehicule" value="0" id="q6-2" <?php echo (isset($form_data_2['vehicule']) && $form_data_2['vehicule'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q6-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Tous les membres du foyer sont-ils d’accord pour l’accueil d’un animal ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="accord" value="1" id="q7-1" <?php echo (isset($form_data_2['accord']) && $form_data_2['accord'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q7-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="accord" value="0" id="q7-2" <?php echo (isset($form_data_2['accord']) && $form_data_2['accord'] == '0') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="q7-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Un des membres de votre famille souffre-t’il d’allergies ou d’asthme ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="asthme" value="1" id="q8-1" <?php echo (isset($form_data_2['asthme']) && $form_data_2['asthme'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q8-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="asthme" value="0" id="q8-2" <?php echo (isset($form_data_2['asthme']) && $form_data_2['asthme'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q8-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Vos enfants ont-ils eu des contacts avec des chats ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="contactsEnfants" value="1" id="q9-1" <?php echo (isset($form_data_2['contactsEnfants']) && $form_data_2['contactsEnfants'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q9-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="contactsEnfants" value="0" id="q9-2" <?php echo (isset($form_data_2['contactsEnfants']) && $form_data_2['contactsEnfants'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q9-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si vous n’avez pas d’enfant et que vous prévoyez d’en avoir, cela vous semble t’il compatible avec la présence d’un animal ? (hygiène, toxoplasmose et allergie du chat disponibilité ...).</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="compatible" value="1" id="q10-1" <?php echo (isset($form_data_2['compatible']) && $form_data_2['compatible'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q10-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="compatible" value="0" id="q10-2" <?php echo (isset($form_data_2['compatible']) && $form_data_2['compatible'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q10-2"> Non </label>
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
        <div id="step4" style="display: none">
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
                <input class="form-check-input" type="radio" name="dejaEuAnimaux" value="1" id="q11-1" <?php echo (isset($form_data_2['dejaEuAnimaux']) && $form_data_2['dejaEuAnimaux'] == '1') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="q11-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="dejaEuAnimaux" value="0" id="q11-2" <?php echo (isset($form_data_2['dejaEuAnimaux']) && $form_data_2['dejaEuAnimaux'] == '0') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="q11-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Lesquels ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="desciptionAnimaux" class="form-control"  rows="3"><?php  echo (isset($form_data_2['desciptionAnimaux']) ? $form_data_2['desciptionAnimaux'] : ''); ?></textarea>
                <label class="form-label" >Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Quels sont les nuisances ou dégâts éventuels causés par un chat ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="nuisances" class="form-control"  rows="3"><?php  echo (isset($form_data_2['nuisances']) ? $form_data_2['nuisances'] : ''); ?></textarea>
                <label class="form-label" >Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Combien possédez-vous d’animaux actuellement ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="combienAnimaux" class="form-control"  rows="3"><?php  echo (isset($form_data_2['combienAnimaux']) ? $form_data_2['combienAnimaux'] : ''); ?></textarea>
                <label class="form-label" >Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">De quelle(s) espèces sont(ils) ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="especes" class="form-control"  rows="3"><?php  echo (isset($form_data_2['especes']) ? $form_data_2['especes'] : ''); ?></textarea>
                <label class="form-label" >Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Quel(s) sexe(s) ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="sexeAnimaux" class="form-control"  rows="3"><?php  echo (isset($form_data_2['sexeAnimaux']) ? $form_data_2['sexeAnimaux'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Sont-ils stérilisés ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="animauxSterlises" value="1" id="q12-1" <?php echo (isset($form_data_2['animauxSterlises']) && $form_data_2['animauxSterlises'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q12-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="animauxSterlises" value="0" id="q12-2" <?php echo (isset($form_data_2['animauxSterlises']) && $form_data_2['animauxSterlises'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q12-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Que pensez-vous de la stérilisation / castration ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="sterilisation" class="form-control"  rows="3"><?php  echo (isset($form_data_2['sterilisation']) ? $form_data_2['sterilisation'] : ''); ?></textarea>
                <label class="form-label" >Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Leurs vaccins sont ils à jour ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="vaccinsAJour" value="1" id="q13-1" <?php echo (isset($form_data_2['vaccinsAJour']) && $form_data_2['vaccinsAJour'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q13-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="vaccinsAJour" value="0" id="q13-2" <?php echo (isset($form_data_2['vaccinsAJour']) && $form_data_2['vaccinsAJour'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q13-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Nom et coordonnées de la clinique vétérinaire référente</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="cliniques" class="form-control"  rows="3"><?php  echo (isset($form_data_2['cliniques']) ? $form_data_2['cliniques'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Avez-vous déjà adopté un animal (par le biais d’un refuge ou association) ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="adoptionAsso" value="1" id="q14-1" <?php echo (isset($form_data_2['adoptionAsso']) && $form_data_2['adoptionAsso'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q14-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="adoptionAsso" value="0" id="q14-2" <?php echo (isset($form_data_2['adoptionAsso']) && $form_data_2['adoptionAsso'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q14-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Pouvez-vous partager avec nous votre expérience, si vous en avez, dans la prise en charge des chatons ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="chaton" class="form-control"  rows="3"><?php  echo (isset($form_data_2['chaton']) ? $form_data_2['chaton'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
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
        <div id="step5" style="display: none">
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
                <textarea name="raison_decedes" class="form-control"  rows="3"><?php  echo (isset($form_data_2['raison_decedes']) ? $form_data_2['raison_decedes'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Avez-vous dû vous séparer d’un animal par le passé ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="separation_animal" value="1" id="q15-1" <?php echo (isset($form_data_2['separation_animal']) && $form_data_2['separation_animal'] == '1') ? 'checked' : ''; ?>/>
                <label class="form-check-label" for="q15-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="separation_animal" value="0" id="q15-2" <?php echo (isset($form_data_2['separation_animal']) && $form_data_2['separation_animal'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q15-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Si oui pour quelle raison ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="raison_separation" class="form-control"  rows="3"><?php  echo (isset($form_data_2['raison_separation']) ? $form_data_2['raison_separation'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
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
        <div id="step6" style="display: none">
          <div class="row d-flex justify-content-around mb-4 mt-4">
            <?php for ($i=0;$i<6;$i++){ ?>
            <img class="col-1 paw" src="public/assets/images/pawYellow.png" alt="" />
            <?php } ?>
            <?php for ($i=0;$i<2;$i++){ ?>
            <img class="col-1 paw" src="public/assets/images/paw.png" alt="" />
            <?php } ?>
          </div>
          <div class="row">
            <div class="col-12 text-center titresForm">6. Préparation pour l'accueil</div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Combien d’heures par jour le chat restera-t’il seul ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <input class="form-control" name="heuresSeul" type="number" value="<?php  echo (isset($form_data_2['heuresSeul']) ? $form_data_2['heuresSeul'] : ''); ?>" />
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Comment envisagez-vous de gérer une éventuelle cohabitation avec d'autres animaux à la maison ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="cohabitation" class="form-control"  rows="3"><?php  echo (isset($form_data_2['cohabitation']) ? $form_data_2['cohabitation'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Avez-vous une pièce calme où le chat peut s'installer et se sentir en sécurité lorsqu'il arrive pour la première fois?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="installation" value="1" id="q16-1" <?php echo (isset($form_data_2['installation']) && $form_data_2['installation'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q16-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="installation" value="0" id="q16-2" <?php echo (isset($form_data_2['installation']) && $form_data_2['installation'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q16-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Pouvez-vous décrire la routine quotidienne de votre maison?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="routine" class="form-control"  rows="3"><?php  echo (isset($form_data_2['routine']) ? $form_data_2['routine'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Lorsque vous vous absentez (week-ends, vacances), avez-vous un mode de garde ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="garde" class="form-control"  rows="3"><?php  echo (isset($form_data_2['garde']) ? $form_data_2['garde'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
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
        <div id="step7" style="display: none">
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
              <div class="form-outline">Avez-vous déjà eu l'expérience d'être une famille d'accueil pour un animal auparavant ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="experience" value="1" id="q17-1" <?php echo (isset($form_data_2['experience']) && $form_data_2['experience'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q17-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="experience" value="0" id="q17-2" <?php echo (isset($form_data_2['experience']) && $form_data_2['experience'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q17-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Pour quelles raisons souhaitez-vous devenir famille d'accueil pour un chat ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="raisonAccueil" class="form-control"  rows="3"><?php  echo (isset($form_data_2['raisonAccueil']) ? $form_data_2['raisonAccueil'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Comment géreriez-vous les situations difficiles liées au comportement d'un chat ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-outline w-75 mb-4">
                <textarea name="comportement" class="form-control"  rows="3"><?php  echo (isset($form_data_2['comportement']) ? $form_data_2['comportement'] : ''); ?></textarea>
                <label class="form-label">Reste 500 caractères</label>
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
        <div id="step8" style="display: none">
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
              <div class="form-outline">Si le chat a des besoins médicaux spécifiques, êtes-vous prêt à administrer des médicaments ou à emmener le chat chez le vétérinaire ?</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="radio" name="medicament" value="1" id="q18-1" <?php echo (isset($form_data_2['medicament']) && $form_data_2['medicament'] == '1') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q18-1"> Oui </label>
              </div>
              <div class="form-check">
                <input class="form-check-input" type="radio" name="medicament" value="0" id="q18-2" <?php echo (isset($form_data_2['medicament']) && $form_data_2['medicament'] == '0') ? 'checked' : ''; ?> />
                <label class="form-check-label" for="q18-2"> Non </label>
              </div>
            </div>
          </div>
          <div class="row mt-5">
            <div class="col-md-4">
              <div class="form-outline">Pour valider ce formulaire, vous acceptez qu’un membre de l’association effectue une pré-visite et une post-visite à votre domicile pour s'assurer du bien-être de l'animal.</div>
            </div>
            <div class="col-md-4">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="visite" id="checkform_fa" value="1" required />
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