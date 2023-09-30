
<tr>
    <td><?php echo $indice; ?></td>

    <td class="ellipsis"><?php echo $produit['nom_produit']; ?></td>
    <td>
        <?php 
        $date_produit = DateTime::createFromFormat('Y-m-d H:i:s', $produit['date_ajout']);
        echo $date_produit ? $date_produit->format('d-m-Y H:i') : $produit['date_ajout'];
        ?>
    </td>

    <td class="ellipsis"><?php echo $produit['prix_unit']; ?> €</td>





    <td>
        <a class="p-2" href="fiche_produit-<?php echo $produit['id_produit']; ?>"><img class="btns" src="public/assets/images/edit.png" alt="" /></a>

        <div class="supprimer">
            <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $produit['id_produit'];?>" > <img src="public/assets/images/dump.png" alt=""> </div>
            <div class="modal fade" id="deleteModal<?php echo $produit['id_produit']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Êtes-vous sûr de vouloir supprimer le produit nº <?php echo $produit['id_produit']; ?>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btnModal2" data-bs-dismiss="modal">non</button>
                            <div class="btnModal d-flex align-items-center justify-content-center">
                                <a href="traitement_supprimer_produit-<?php echo $produit['id_produit']; ?>">oui</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </td>

    <td>
        <a class="p-2" href="photos_produit-<?php echo $produit['id_produit']; ?>"><img class="btns" src="public/assets/images/image.png" alt="" /></a>
    </td>




    <td class="text-center">
        <div class="d-flex justify-content-center">
        <div class="form-check form-switch mx-auto">
        <input class="form-check-input" type="checkbox" role="switch" data-type="produit" id="flexSwitchCheckDefault_<?php echo $produit['id_produit']; ?>" data-id-produit="<?php echo $produit['id_produit']; ?>" <?php echo $produit['en_ligne'] == 1 ? 'checked' : ''; ?>  >
        <!-- <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label> -->
        </div>
        </div>
    </td>

</tr>
