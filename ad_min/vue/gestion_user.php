
<div class="row g-3 mt-3">
    <div class="col-md-4">
        <input type="text" class="form-control" value="<?php echo $user_2['civilite']; ?>" readonly>
        <label for="validationCustom01" class="form-label">Civilité *</label>
    </div>
    <div class="col-md-4">
        <div class="form-outline">
        <input readonly type="text" class="form-control" id="validationCustom02" name="prenom" required value="<?php echo isset($user_2['prenom']) ? $user_2['prenom'] : (isset($user_2['prenom']) ? $user_2['prenom'] : ''); ?>"/>
        <label for="validationCustom01" class="form-label">Prénom *</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-outline">
        <input readonly type="text" class="form-control" id="validationCustom02" name="nom" required value="<?php echo isset($user_2['nom']) ? $user_2['nom'] : (isset($user_2['nom']) ? $user_2['nom'] : ''); ?>"/>
        <label for="validationCustom02" class="form-label">Nom *</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-outline">
        <input readonly type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="adresse" required value="<?php echo isset($user_2['adresse']) ? $user_2['adresse'] : (isset($user_2['adresse']) ? $user_2['adresse'] : ''); ?>"/>
        <label for="validationCustomUsername" class="form-label">Adresse *</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-outline">
        <input type="text" class="form-control" value="<?php echo $user_2['nom_departement']; ?>" readonly>
        <label for="validationCustom03" class="form-label">Département</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-outline">
        <input type="text" class="form-control" value="<?php echo $user_2['nom_ville']; ?>" readonly>
        <label for="ville" class="form-label">Ville</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-outline">
        <input value="<?php echo isset($user_2['email']) ? $user_2['email'] : (isset($user_2['email']) ? $user_2['email'] : ''); ?>" type="mail" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" name="mail" required />
        <label for="validationCustomUsername" class="form-label">Adresse email *</label>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-outline">
        <input readonly value="<?php echo isset($user_2['numero']) ? $user_2['numero'] : (isset($user_2['numero']) ? $user_2['numero'] : ''); ?>"  type="text" class="form-control" id="validationCustom05" name="tel" />
        <label for="validationCustom05" class="form-label">Téléphone mobile</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-outline">
            <input type="text" class="form-control" value="<?php echo date('d-m-Y', strtotime($user_2['date_naissance'])); ?>" readonly>
            <label for="validationCustom05" class="form-label">Date naissance *</label>
        </div>
    </div>



</div>

<div class="row mt-5">
    <div class="col-12 h5">
        Vous souhaitez changer le rôle de cet utilisateur?
    </div>
</div>

<form action="traitement_modif_role" method="post">
    <input type="hidden" value="<?php echo $user_2['id_user']; ?>" name="idUser">
    <div class="row mt-3">
        <div class="col-md-4">
            <div class="form-outline">
                <select class="form-select" id="role" name="role">
                    <option selected disabled>Rôle</option>
                    <?php 
                    $roles = getRoles($bdd);
                    foreach ($roles as $role){ 
                    ?>
                    <option value="<?php echo $role['id_role'];?>" <?php echo ($user_2['id_role'] == $role['id_role']) ? 'selected' : ''; ?> ><?php echo $role['role'];?></option>
                    <?php } ?>
                </select>
                <label for="validationCustom05" class="form-label">Rôle</label>
            </div>
        </div>
        <div class="col-md-4">
            <div data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-primary" id="validateButton" style="display: none;">
                valider
            </div>
        </div>

        <?php if (isset($_SESSION['success_role'])): ?>
        <div class="row text-center">
            <div class="col-12 greenSuccess"><?= $_SESSION['success_role'] ?></div>
        </div>
        <?php unset($_SESSION['success_role']);  ?>
        <?php endif; ?>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Vous êtes sûr de vouloir modifier le rôle de <?php echo $user_2['prenom']; ?>  <?php echo $user_2['nom']; ?> ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btnModal2" data-bs-dismiss="modal">non</button>
                <button class="p-2 btnModal" type="submit">oui</button>
            </div>
            </div>
        </div>
        </div>

    </div>

</form>





