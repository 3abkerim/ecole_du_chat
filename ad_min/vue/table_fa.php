
      <tr>
        <td><?php echo $indice; ?></td>

        <td class="ellipsis"><?php echo $famille['prenom']; ?></td>

        <td class="ellipsis"><?php echo $famille['nom']; ?></td>

        <?php $catsCount = getCountAccueil($bdd,$famille['id_user']) ; ?>

        <td><?php echo $catsCount; ?></td>


        <td>
            <a class="p-2" href="fiche_fa-<?php echo $famille['id_user']; ?>"><img class="btns" src="public/assets/images/file.png" alt="" /></a>
        </td>

        <td>
          <div class="supprimer">
                <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $famille['id_user'];?>" > <img src="public/assets/images/dump.png" alt=""> </div>
                <div class="modal fade" id="deleteModal<?php echo $famille['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body modalTest">
                              Êtes-vous sûr de vouloir supprimer <?php echo $famille['civilite']; echo ' '; echo $famille['prenom'];echo ' ';echo $famille['nom'];  ?> de votre liste de familles d'accueil? <br>
                              N.B : Si des chats présents dans ce profil doivent être transférés dans une autre famille d'accueil, il est nécessaire de les supprimer d'abord de ce profil. </div>
                            <div class="modal-footer">
                                <button type="button" class="btnModal2" data-bs-dismiss="modal">non</button>
                                <div class="btnModal d-flex align-items-center justify-content-center">
                                    <a href="traitement_supprimer_fa-<?php echo $famille['id_user']; ?>">oui</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </td>
      </tr>
