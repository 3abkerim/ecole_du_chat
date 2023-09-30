

<tr>
    <td><?php echo $indice; ?></td>

    <!-- IMAGES -->

    <?php 
    $images = getImagesChat($bdd, $chat['id_chat']);
    if (count($images) > 0) { 
        $firstImage = $images[0]['fichier']; 
    ?>
    <td>
        <img class="imgTable" src="<?php echo $firstImage; ?>" />
    </td>
    <?php } else { ?>
    <td>
        <span>No image</span>
    </td>
    <?php } ?>

    <td class="ellipsis">
        <?php echo $chat['nom_chat']; ?>
    </td>
    <td><?php echo $chat['id_chat']; ?></td>


    <td class="ellipsis demandes">
        <a href="gestion_adoption_chat-<?php echo $chat['id_chat']; ?>" onclick="setCurrentCatId(<?php echo $chat['id_chat']; ?>)" >
            <?php echo $chat['num_requests']; ?> 
            <?php echo $chat['num_requests'] == 1 ? 'demande' : 'demandes'; ?>
        </a>
    </td>




</tr>
