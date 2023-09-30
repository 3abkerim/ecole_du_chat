<?php
$idUser = $_SESSION['idUserAdmin'];
$user = getUserById($bdd,$idUser);
$currentPage = $_GET['page'] ?? ''; 
?>
<div class="d-flex flex-column ParentSideBar align-items-center align-items-sm-start px-3 pt-2">
    <a href="tableau_de_bord" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '3' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
      <img src="public/assets/images/home.png" alt="">
      <span>Tableau de bord</span>
    </a>

  <a href="chats" class="border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '2' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="public/assets/images/pawprint.png" alt="" />
    <span>Chats</span>
  </a>
  <a href="articles" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '4' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="public/assets/images/blog.png" alt="" />
    <span>Articles</span>
  </a>
  <a href="events" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '5' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="public/assets/images/calendar.png" alt="" />
    <span>Évenements</span>
  </a>
  <a href="opdn" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '6' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="public/assets/images/newspaper.png" alt="" />
    <span>On parle de nous</span>
  </a>
  <a href="boutique" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '7' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="public/assets/images/store.png" alt="" />
    <span>Boutique</span>
  </a>
  <a href="adoptions" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '8' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="public/assets/images/pet.png" alt="" />
    <span>Adoption</span>
  </a>
  <a href="familles_accueil" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '9' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="public/assets/images/pet.png" alt="" />
    <span>Familles d'accueil</span>
  </a>
  <?php if ($user['role']=='Superadmin'){ ?>
  <a href="users" class=" border-end-0 d-inline-block text-truncate col-12 navBtn <?php echo $currentPage == '10' ? 'active' : ''; ?>" data-bs-parent="#sidebar">
    <img src="public/assets/images/group.png" alt="" />
    <span>Utilisateurs</span>
  </a>
  <?php } ?>

  <div class="dropup dropposition mb-4 mt-auto testUser">
    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
       <?php if ($user['fichier'] == NULL ){ ?>
      <img class="rounded-circle" alt="hugenerd" width="30" height="30" src="public/assets/images/user.png" alt="" />
      <?php }else{ ?>
      <img src="<?php echo $user['fichier']; ?>" alt="hugenerd" width="30" height="30" class="rounded-circle" />
      <?php } ?>
      <span class="d-none d-sm-inline mx-1"><?php echo $user['prenom']; echo ' '; echo $user['nom']; ?></span>
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
      <!-- <li><a class="dropdown-item" href="#">Mon compte</a></li> -->
      <!-- <li>
        <hr class="dropdown-divider" />
      </li> -->
      <li><a class="dropdown-item text-white" href="traitement_deconnexion">Déconnexion</a></li>
    </ul>
  </div>
</div>
