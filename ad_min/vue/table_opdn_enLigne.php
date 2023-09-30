     
<tr>
<td><?php echo $indice; ?></td>

<td class="ellipsis"><?php echo $opdn['titre']; ?></td>
<td>
    <?php 
    $date_opdn = DateTime::createFromFormat('Y-m-d H:i:s', $opdn['date_publication']);
    echo $date_opdn ? $date_opdn->format('d-m-Y H:i') : $opdn['date_publication'];
    ?>
</td>

<td class="ellipsis"><?php echo $opdn['par_qui']; ?></td>

<td class="ellipsis"><?php echo $opdn['lien']; ?></td>




<td>
    <a class="p-2" href="fiche_opdn-<?php echo $opdn['id_on_parle_de_nous']; ?>"><img class="btns" src="public/assets/images/edit.png" alt="" /></a>

    <div class="supprimer">
        <div class="dump2" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $opdn['id_on_parle_de_nous'];?>" > <img src="../public/assets/images/dump.png" alt=""> </div>
        <div class="modal fade" id="deleteModal<?php echo $opdn['id_on_parle_de_nous']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir supprimer l'article <?php echo $opdn['id_on_parle_de_nous']; ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btnModal2" data-bs-dismiss="modal">non</button>
                        <div class="btnModal d-flex align-items-center justify-content-center">
                            <a href="traitement_supprimer_opdn-<?php echo $opdn['id_on_parle_de_nous']; ?>">oui</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</td>

<td>
    <a class="p-2" href="photo_opdn-<?php echo $opdn['id_on_parle_de_nous']; ?>"><img class="btns" src="public/assets/images/image.png" alt="" /></a>
</td>




<td class="text-center">
    <div class="d-flex justify-content-center">
    <div class="form-check form-switch mx-auto">
    <input class="form-check-input" type="checkbox" role="switch" data-type="opdn" id="flexSwitchCheckDefault_<?php echo $opdn['id_on_parle_de_nous']; ?>" data-id-opdn="<?php echo $opdn['id_on_parle_de_nous']; ?>" <?php echo $opdn['en_ligne'] == 1 ? 'checked' : ''; ?>  >
    <!-- <label class="form-check-label" for="flexSwitchCheckDefault">Default switch checkbox input</label> -->
    </div>
    </div>
</td>

</tr>
