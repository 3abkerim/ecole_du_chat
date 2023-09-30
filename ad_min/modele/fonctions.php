<?php
// CONNEXION

function adminExists($bdd,$email){
    $req = "SELECT * FROM users u
    JOIN role r ON r.id_role = u.id_role 
    WHERE email = :mail AND (r.role='Superadmin' OR r.role='Admin')";
    $reqUserExists = $bdd->prepare($req);
    $reqUserExists->execute([':mail'=>$email]);
    $userExists=$reqUserExists->fetch();

    return $userExists;
}

function getUserById($bdd,$idUser){
    try{
    $req = $bdd->prepare('
    SELECT * 
    FROM users u
    LEFT JOIN images i ON u.id_user = i.id_user
    LEFT JOIN civilite c ON c.id_civilite = u.id_civilite
    LEFT JOIN adresses a ON a.id_user = u.id_user
    LEFT JOIN ville v ON v.id_ville = a.id_ville
    LEFT JOIN departement d ON d.id_departement = v.id_departement
    LEFT JOIN role r ON r.id_role = u.id_role
    WHERE u.id_user = :idUser');
    $req->execute([':idUser'=>$idUser]);
    $res = $req->fetch();
    return $res;
}catch(PDOException $e){
    echo $e->getMessage();
    die();
}
}

// chats


function ajouterChat($bdd,$nom,$identification,$age,$desc,$sexe,$race,$sterilise,$fiv,$flv,$en_ligne){
    $req = $bdd->prepare('INSERT INTO chats(nom_chat,identifiant,age,description,sexe_id_sexe,race_id_race,sterilise,fiv,flv,en_ligne) VALUES (?,?,?,?,?,?,?,?,?,?)');
    $insert = $req->execute([$nom,$identification,$age,$desc,$sexe,$race,$sterilise,$fiv,$flv,$en_ligne]);
    return $insert;
}


function getSexeChats($bdd){
    $req = $bdd->prepare('SELECT * FROM sexe');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

function getRacesChats($bdd){
    $req = $bdd->prepare('SELECT * FROM race');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

function getChats($bdd){
    try{
        $req = $bdd->prepare("
        SELECT * FROM chats c
        LEFT JOIN adoption a ON a.chats_id_chat = c.id_chat
        LEFT JOIN sexe s ON s.id_sexe = c.sexe_id_sexe
        LEFT JOIN familles_accueil f ON f.chats_id_chat = c.id_chat
        WHERE c.supprime = 0 AND c.decede = 0 AND a.chats_id_chat IS NULL
        ");
        $req->execute();
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}

function getImagesChat($bdd,$idChat){
    try{
        $req = $bdd->prepare("SELECT * FROM images WHERE chats_id_chat=:idChat ORDER BY ordre ASC");
        $req->execute([':idChat'=>$idChat]);
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
function deleteChat($bdd,$idChat){
    $req = $bdd->prepare('UPDATE chats SET supprime = 1 WHERE id_chat = :idChat');
    $req->execute([':idChat'=>$idChat]);
}
function getChatById($bdd,$idChat){
    $req = $bdd->prepare('
    SELECT * FROM chats c
    LEFT JOIN adoption a ON a.chats_id_chat = c.id_chat
    LEFT JOIN sexe s ON s.id_sexe = c.sexe_id_sexe
    LEFT JOIN familles_accueil f ON f.chats_id_chat = c.id_chat
    where id_chat = :idChat');
    $req->execute([':idChat'=>$idChat]);
    $res = $req->fetch();
    return $res;
}
function updatePublish($bdd,$idChat,$published){
    $req = $bdd->prepare('UPDATE chats SET en_ligne = :published WHERE id_chat = :idProd');
    $res = $req->execute([':published'=>$published,':idProd'=>$idChat ]);
    return $res;
}



function updateChat($bdd,$idChat,$nomChat,$sexe,$race,$age,$identifiant,$chatDescription,$sterilisation,$fiv,$flv){
    $req = $bdd->prepare('UPDATE chats SET nom_chat = :nomChat, identifiant = :ident, age = :age, description = :desc, sexe_id_sexe = :sexe, race_id_race = :idRace, sterilise = :ster, fiv = :fiv, flv = :flv WHERE id_chat = :idChat');
    $res = $req->execute([':idChat'=>$idChat,':nomChat'=>$nomChat,':ident'=>$identifiant, ':age'=>$age,'sexe'=>$sexe,':desc'=>$chatDescription, ':idRace'=>$race, ':ster'=>$sterilisation,'fiv'=>$fiv,':flv'=>$flv]);
    return $res;
}
function insertImage($bdd, $image, $idChat) {

    try {
        $bdd->beginTransaction();

        $maxOrderQuery = $bdd->prepare('SELECT MAX(ordre) as max_ordre FROM images WHERE chats_id_chat = ?');
        $maxOrderQuery->execute([$idChat]);
        $row = $maxOrderQuery->fetch();

        $max_ordre = $row['max_ordre'] ?? 0;
        // echo "Max Order: $max_ordre <br>"; 

        $ordre = $max_ordre + 1;

        $req = $bdd->prepare('INSERT INTO images (fichier, chats_id_chat, ordre) VALUES (?, ?,?)');
        $result = $req->execute([$image, $idChat, $ordre]);
        
        $bdd->commit();

        return $result;
    } catch (Exception $e) {
        $bdd->rollBack();
        echo "Failed: " . $e->getMessage();
    }
}

function supprimerImageChat($bdd,$idImage,$idChat){
    $req = $bdd->prepare('DELETE FROM images WHERE id_image = :idImage AND chats_id_chat = :idChat');
    $result = $req->execute([':idImage'=>$idImage,':idChat'=>$idChat]);
    return $result;
}

// Articles

function ajouterArticle($bdd,$titre_article,$article,$date_Article,$en_ligne,$user){
    $req = $bdd->prepare('INSERT INTO articles(titre_article,article,date_article,en_ligne,users_id_user) VALUES (?,?,?,?,?)');
    $insert = $req->execute([$titre_article,$article,$date_Article,$en_ligne,$user]);
    return $insert;
}

function getArticles($bdd){
    try{
        $req = $bdd->prepare("
        SELECT * FROM articles a
        JOIN users u ON a.users_id_user = u.id_user
        WHERE supprime = 0");
        $req->execute();
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
function getImagesArticle($bdd,$idArticle){
    try{
        $req = $bdd->prepare("SELECT * FROM images WHERE articles_id_article=:idArticle ORDER BY ordre ASC");
        $req->execute([':idArticle'=>$idArticle]);
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
function getArticleById($bdd,$idArticle){
    try{
        $req = $bdd->prepare("SELECT * FROM articles WHERE id_article=:idArticle");
        $req->execute([':idArticle'=>$idArticle]);
        $res = $req->fetch();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }

}

function updateArticle($bdd,$idArticle,$titre,$article){
    $req = $bdd->prepare('UPDATE articles SET titre_article = :titre, article = :article WHERE id_article = :idArticle');
    $res = $req->execute([':idArticle'=>$idArticle,':article'=>$article,':titre'=>$titre]);
    // if (!$res) {
    //     var_dump($req->errorInfo());
    // }
    return $res;
}
function insertImageArticle($bdd, $image, $idArticle) {

    try {
        $bdd->beginTransaction();

        $maxOrderQuery = $bdd->prepare('SELECT MAX(ordre) as max_ordre FROM images WHERE articles_id_article = ?');
        $maxOrderQuery->execute([$idArticle]);
        $row = $maxOrderQuery->fetch();

        $max_ordre = $row['max_ordre'] ?? 0;
        // echo "Max Order: $max_ordre <br>"; 

        $ordre = $max_ordre + 1;

        $req = $bdd->prepare('INSERT INTO images (fichier, articles_id_article, ordre) VALUES (?, ?,?)');
        $result = $req->execute([$image, $idArticle, $ordre]);
        
        $bdd->commit();

        return $result;
    } catch (Exception $e) {
        $bdd->rollBack();
        echo "Failed: " . $e->getMessage();
    }
}

function supprimerImageArticle($bdd,$idImage,$idArticle){
    $req = $bdd->prepare('DELETE FROM images WHERE id_image = :idImage AND articles_id_article = :idArticle');
    $result = $req->execute([':idImage'=>$idImage,':idArticle'=>$idArticle]);
    return $result;
}

function deleteArticle($bdd,$idArticle){
    $req = $bdd->prepare('UPDATE articles SET supprime = 1 WHERE id_article = :idArticle');
    $req->execute([':idArticle'=>$idArticle]);
}

function updatePublishArticle($bdd,$idArticle,$published){
    $req = $bdd->prepare('UPDATE articles SET en_ligne = :published WHERE id_article = :idArticle');
    $res = $req->execute([':published'=>$published,':idArticle'=>$idArticle ]);
    return $res;
}


// ? Events

function ajouterEvent($bdd,$event,$date_event,$date_fin_event,$date_publication,$en_ligne,$id_user){
    $req = $bdd->prepare('INSERT INTO events(event,date_event,date_fin_event,date_publication,en_ligne,id_user) VALUES (?,?,?,?,?,?)');
    $insert = $req->execute([$event,$date_event,$date_fin_event,$date_publication,$en_ligne,$id_user]);
    // if($insert === false) {
    //     var_dump($bdd->errorInfo());
    // }
    // if (!$insert) {
    //     print_r($req->errorInfo());
    // }
    
    return $insert;

}

function getEvents($bdd){
    try{
        $req = $bdd->prepare("
        SELECT * FROM events e
        JOIN users u ON e.id_user = u.id_user
        WHERE supprime = 0");
        $req->execute();
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}

function getImageEvent($bdd,$idEvent){
    try{
        $req = $bdd->prepare("SELECT * FROM images WHERE events_id_event=:idEvent");
        $req->execute([':idEvent'=>$idEvent]);
        $res = $req->fetch();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
function getEventById($bdd,$idEvent){
    try{
        $req = $bdd->prepare("SELECT * FROM events WHERE id_event=:idEvent");
        $req->execute([':idEvent'=>$idEvent]);
        $res = $req->fetch();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }

}

function updateEvent($bdd,$idEvent,$event,$date_event,$date_fin_event){
    $req = $bdd->prepare('UPDATE events SET event = :event, date_event = :date_event, date_fin_event = :date_fin_event  WHERE id_event = :idEvent');
    $res = $req->execute([':event'=>$event,':date_event'=>$date_event,':date_fin_event'=>$date_fin_event,':idEvent'=>$idEvent]);
    if (!$res) {
        var_dump($req->errorInfo());
    }
    return $res;
}
function insertImageEvent($bdd, $image, $idEvent) {

    try {
        $bdd->beginTransaction();
        // Check if an image already exists for this event
        $checkQuery = $bdd->prepare('SELECT fichier FROM images WHERE events_id_event = ?');
        $checkQuery->execute([$idEvent]);
        $existingImage = $checkQuery->fetch();

        if ($existingImage) {
            // If an image exists, delete it
            $oldImagePath = $existingImage['fichier'];
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Update the existing record
            $updateQuery = $bdd->prepare('UPDATE images SET fichier = ? WHERE events_id_event = ?');
            $result = $updateQuery->execute([$image, $idEvent]);
        } else {
            // If no image exists, insert a new record
            $req = $bdd->prepare('INSERT INTO images (fichier, events_id_event, ordre) VALUES (?, ?, 1)');
            $result = $req->execute([$image, $idEvent]);
        }
        
        $bdd->commit();

        return $result;
    } catch (Exception $e) {
        $bdd->rollBack();
        echo "Failed: " . $e->getMessage();
    }
}


function supprimerImageEvent($bdd,$idImage,$idEvent){
    $req = $bdd->prepare('DELETE FROM images WHERE id_image = :idImage AND events_id_event = :idEvent');
    $result = $req->execute([':idImage'=>$idImage,':idEvent'=>$idEvent]);
    return $result;
}

function deleteEvent($bdd,$idEvent){
    $req = $bdd->prepare('UPDATE events SET supprime = 1 WHERE id_event = :idEvent');
    $req->execute([':idEvent'=>$idEvent]);
}

function updatePublishEvent($bdd,$idEvent,$published){
    $req = $bdd->prepare('UPDATE events SET en_ligne = :published WHERE id_event = :idEvent');
    $res = $req->execute([':published'=>$published,':idEvent'=>$idEvent ]);
    return $res;
}

// ? OPDN


function ajouterOPDN($bdd,$titre,$lien,$date,$par_qui){
    $req = $bdd->prepare('INSERT INTO on_parle_de_nous(titre,lien,date_publication,par_qui) VALUES (?,?,?,?)');
    $insert = $req->execute([$titre,$lien,$date,$par_qui]);
    return $insert;
}

function getOPDN($bdd){
    try{
        $req = $bdd->prepare("SELECT * FROM on_parle_de_nous WHERE supprime = 0");
        $req->execute();
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}

function getImageOPDN($bdd,$idOPDN){
    try{
        $req = $bdd->prepare("SELECT * FROM images WHERE id_on_parle_de_nous=:idOPDN");
        $req->execute([':idOPDN'=>$idOPDN]);
        $res = $req->fetch();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
function getOPDNById($bdd,$idOPDN){
    try{
        $req = $bdd->prepare("SELECT * FROM on_parle_de_nous WHERE id_on_parle_de_nous=:idOPDN");
        $req->execute([':idOPDN'=>$idOPDN]);
        $res = $req->fetch();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }

}

function updateOPDN($bdd,$idOPDN,$titre,$lien,$date_publication,$par_qui){
    $req = $bdd->prepare('UPDATE on_parle_de_nous SET titre = :titre, lien = :lien, date_publication = :date_publication, par_qui = :par_qui  WHERE id_on_parle_de_nous = :idOPDN');
    $res = $req->execute([':idOPDN'=>$idOPDN,':titre'=>$titre,':lien'=>$lien,':date_publication'=>$date_publication, ':par_qui'=>$par_qui]);
    if (!$res) {
        var_dump($req->errorInfo());
    }
    return $res;
}
function insertImageOPDN($bdd, $image, $idOPDN) {

    try {
        $bdd->beginTransaction();
        // Check if an image already exists for this event
        $checkQuery = $bdd->prepare('SELECT fichier FROM images WHERE id_on_parle_de_nous = ?');
        $checkQuery->execute([$idOPDN]);
        $existingImage = $checkQuery->fetch();

        if ($existingImage) {
            // If an image exists, delete it
            $oldImagePath = $existingImage['fichier'];
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Update the existing record
            $updateQuery = $bdd->prepare('UPDATE images SET fichier = ? WHERE id_on_parle_de_nous = ?');
            $result = $updateQuery->execute([$image, $idOPDN]);
            // if(!$result) {
            //     print_r($bdd->errorInfo());
            // }

        } else {
            // If no image exists, insert a new record
            $req = $bdd->prepare('INSERT INTO images (fichier, id_on_parle_de_nous, ordre) VALUES (?, ?, 1)');
            $result = $req->execute([$image, $idOPDN]);
            // if(!$result) {
            //     print_r($bdd->errorInfo());
            // }
        }
        
        $bdd->commit();

        return $result;
    } catch (Exception $e) {
        $bdd->rollBack();
        echo "Failed: " . $e->getMessage();
    }
}


function supprimerImageOPDN($bdd,$idImage,$idOPDN){
    $req = $bdd->prepare('DELETE FROM images WHERE id_image = :idImage AND id_on_parle_de_nous = :idOPDN');
    $result = $req->execute([':idImage'=>$idImage,':idOPDN'=>$idOPDN]);
    return $result;
}

function deleteOPDN($bdd,$idOPDN){
    $req = $bdd->prepare('UPDATE on_parle_de_nous SET supprime = 1 WHERE id_on_parle_de_nous = :idOPDN');
    $req->execute([':idOPDN'=>$idOPDN]);
}

function updatePublishOPDN($bdd,$idOPDN,$published){
    $req = $bdd->prepare('UPDATE on_parle_de_nous SET en_ligne = :published WHERE id_on_parle_de_nous = :idOPDN');
    $res = $req->execute([':published'=>$published,':idOPDN'=>$idOPDN ]);
    return $res;
}


// ! PRODUITS

function ajouterProd($bdd,$nom_produit,$prixUnit,$produitDescription,$date){
    $req = $bdd->prepare('INSERT INTO produits(nom_produit,prix_unit,description_produit,date_ajout) VALUES (?,?,?,?) ');
    $insert = $req->execute([$nom_produit,$prixUnit,$produitDescription,$date]);
    return $insert;
}
function getProduits($bdd) {
    $query = 'SELECT * FROM produits WHERE deleted = 0';
    $req = $bdd->prepare($query);
    $req->execute();
    $produits = $req->fetchAll();
    return $produits;
}

function getProduitById($bdd,$idProd) {
    $query = 'SELECT * FROM produits WHERE id_produit = :idProd';
    $req = $bdd->prepare($query);
    $req->execute([':idProd'=>$idProd]);
    $produit = $req->fetch();
    return $produit;
}

function updateProduit($bdd,$idProd,$nom,$prix,$desc){
    $req = $bdd->prepare('UPDATE produits SET nom_produit = :nomProd, prix_unit = :prix, description_produit = :descr WHERE id_produit = :idProd');
    $res = $req->execute([':idProd'=>$idProd,':nomProd'=>$nom,':prix'=>$prix, ':descr'=>$desc]);
    return $res;
}

function deleteProduit($bdd,$id_produit){
    $req = $bdd->prepare('UPDATE produits SET deleted = 1 WHERE id_produit = :idProd');
    $res = $req->execute([':idProd'=>$id_produit]);
    return $res;
}

function getImagesProduit($bdd,$id_produit){
    try{
        $reqImages = $bdd->prepare("SELECT * FROM images WHERE id_produit=:id_prod ORDER BY ordre ASC");
        $reqImages->execute([':id_prod'=>$id_produit]);
        $images = $reqImages->fetchAll();
        return $images;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}

function insertImagesProduit($bdd, $image, $idProduit) {

    try {
        $bdd->beginTransaction();

        $maxOrderQuery = $bdd->prepare('SELECT MAX(ordre) as max_ordre FROM images WHERE id_produit = ?');
        $maxOrderQuery->execute([$idProduit]);
        $row = $maxOrderQuery->fetch();

        $max_ordre = $row['max_ordre'] ?? 0;
        // echo "Max Order: $max_ordre <br>"; 

        $ordre = $max_ordre + 1;

        $req = $bdd->prepare('INSERT INTO images (fichier, id_produit, ordre) VALUES (?, ?,?)');
        $result = $req->execute([$image, $idProduit, $ordre]);
        
        $bdd->commit();

        return $result;
    } catch (Exception $e) {
        $bdd->rollBack();
        echo "Failed: " . $e->getMessage();
    }
}

function supprimerImageProduit($bdd,$idImage,$idProd){
    $req = $bdd->prepare('DELETE FROM images WHERE id_image = :idImage AND id_produit = :idProd');
    $result = $req->execute([':idImage'=>$idImage,':idProd'=>$idProd]);
    return $result;
}

function updatePublishProduit($bdd,$idProduit,$published){
    $req = $bdd->prepare('UPDATE produits SET en_ligne = :published WHERE id_produit = :idProduit');
    $res = $req->execute([':published'=>$published,':idProduit'=>$idProduit ]);
    return $res;
}

// Adoption



function getChatsAdoption($bdd){
    $req = $bdd->prepare('
    SELECT c.*, COUNT(f.id_chat) as num_requests 
    FROM chats c
    JOIN formulaires f ON c.id_chat = f.id_chat
    WHERE f.form_type = 1
    GROUP BY c.id_chat
    ORDER BY num_requests DESC
    ');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

function getRequestsForCat($bdd, $idChat){
    $req = $bdd->prepare('
    SELECT * 
    FROM formulaires f
    LEFT JOIN users u ON u.id_user = f.id_user
    LEFT JOIN chats c ON c.id_chat = f.id_chat
    WHERE f.id_chat = :idChat AND f.form_type = 1
    ');
    $req->execute([':idChat' => $idChat]);
    $res = $req->fetchAll();
    return $res;
}

function getRequestById($bdd,$idForm){
    $req = $bdd->prepare('
    SELECT * 
    FROM formulaires f
    LEFT JOIN users u ON u.id_user = f.id_user
    LEFT JOIN adresses a ON a.id_user = u.id_user
    LEFT JOIN civilite ci ON ci.id_civilite = u.id_civilite
    LEFT JOIN situation s ON s.id_situation = f.id_situation
    LEFT JOIN statut st ON st.id_statut = f.id_statut
    LEFT JOIN revenus r ON r.id_revenus = f.id_revenus
    LEFT JOIN taille_logement ta ON ta.id_taille = f.taille_logement
    LEFT JOIN type_logement ty ON ty.id_type = f.type_logement
    LEFT JOIN ville v ON a.id_ville = v.id_ville
    LEFT JOIN departement d on d.id_departement = v.id_departement
    LEFT JOIN chats c ON f.id_chat = c.id_chat
    WHERE f.id_fa = :idForm
    ');
    $req->execute([':idForm' => $idForm]);
    $res = $req->fetch();
    return $res;
}


// Familles d'accueil

function getFamilles($bdd){
    $req = $bdd->prepare('
    SELECT * 
    FROM users u
    LEFT JOIN civilite c
    ON u.id_civilite = c.id_civilite 
    WHERE u.famille_accueil = 1');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

function getCountAccueil($bdd, $idUser) {
    $req = $bdd->prepare('
    SELECT COUNT(f.chats_id_chat) as cat_count 
    FROM users u
    LEFT JOIN familles_accueil f ON u.id_user = f.users_id_user AND f.date_end IS NULL
    WHERE u.id_user = :idUser
    GROUP BY u.id_user
    ');
    $req->execute([':idUser'=>$idUser]);
    $res = $req->fetch();
    return $res ? $res['cat_count'] : 0;
}


function getChatsSansFamilleAccueil($bdd){
    $req = $bdd->prepare('
    SELECT c.*
    FROM chats c
    LEFT JOIN familles_accueil f ON c.id_chat = f.chats_id_chat
    WHERE f.chats_id_chat IS NULL
    ');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

function getChatEnAccueilUser($bdd,$idUser){
    $req = $bdd->prepare('
    SELECT * 
    FROM familles_accueil f
    JOIN chats c ON f.chats_id_chat = c.id_chat
    WHERE users_id_user = ?'
    );
    $req->execute([$idUser]);
    $res = $req->fetchAll();
    return $res;
}

function insertFA($bdd,$idChat,$idUser){
    $req = $bdd->prepare('INSERT INTO familles_accueil (chats_id_chat,users_id_user) VALUES  (?,?)');
    $req->execute([$idChat,$idUser]);
    return $req;
}
function updateFA($bdd,$idChat,$idUser,$date_start,$date_end){
    $req = $bdd->prepare('UPDATE familles_accueil SET date_start = :date_start, date_end = :date_end WHERE chats_id_chat = :chats_id_chat AND users_id_user = :users_id_user');
    $res = $req->execute([':chats_id_chat'=>$idChat,':users_id_user'=>$idUser,':date_start'=>$date_start,':date_end'=>$date_end]);

    if(!$res) {
        $errorInfo = $req->errorInfo();
        echo "Error: " . $errorInfo[2];
        return false;
    }
    return $res;
}

function deleteChatFamille($bdd,$idChat,$idUser){
    $req = $bdd->prepare('DELETE FROM familles_accueil WHERE chats_id_chat = :idChat AND users_id_user = :idUser');
    $result = $req->execute([':idChat'=>$idChat,':idUser'=>$idUser]);
    return $result;
}

function getRequestsForFoster($bdd){
    $req = $bdd->prepare('
    SELECT * 
    FROM formulaires f
    LEFT JOIN users u ON u.id_user = f.id_user
    WHERE form_type = 2 AND valide = 0 AND supprime = 0
    ');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

function getRequestsForFosterById($bdd,$id_fa){
    $req = $bdd->prepare('
    SELECT * 
    FROM formulaires f
    LEFT JOIN users u ON u.id_user = f.id_user
    LEFT JOIN adresses a ON a.id_user = u.id_user
    LEFT JOIN civilite ci ON ci.id_civilite = u.id_civilite
    LEFT JOIN situation s ON s.id_situation = f.id_situation
    LEFT JOIN statut st ON st.id_statut = f.id_statut
    LEFT JOIN revenus r ON r.id_revenus = f.id_revenus
    LEFT JOIN taille_logement ta ON ta.id_taille = f.taille_logement
    LEFT JOIN type_logement ty ON ty.id_type = f.type_logement
    LEFT JOIN ville v ON a.id_ville = v.id_ville
    LEFT JOIN departement d on d.id_departement = v.id_departement
    WHERE f.id_fa = :id_fa
    ');
    $req->execute([':id_fa'=>$id_fa]);
    $res = $req->fetch();
    return $res;
}

function valideFa_1($bdd,$idForm){
    $req = $bdd->prepare('UPDATE formulaires SET valide = 1 WHERE id_fa = :idForm');
    $res = $req->execute([':idForm'=>$idForm]);
    if(!$res) {
    $errorInfo = $req->errorInfo();
    echo "Error: " . $errorInfo[2];
    return false;
    }
    return $res;
}
function valideFa_2($bdd,$idUser){
    $req = $bdd->prepare('UPDATE users SET famille_accueil = 1 WHERE id_user = :idUser');
    $res = $req->execute([':idUser'=>$idUser]);
    if(!$res) {
    $errorInfo = $req->errorInfo();
    echo "Error: " . $errorInfo[2];
    return false;
    }
    return $res;
}
function refuseFa($bdd,$idForm){
    $req = $bdd->prepare('UPDATE formulaires SET supprime = 1 WHERE id_fa = :idForm');
    $res = $req->execute([':idForm'=>$idForm]);
    if(!$res) {
    $errorInfo = $req->errorInfo();
    echo "Error: " . $errorInfo[2];
    return false;
    }
    return $res;
}

function supprimerFa($bdd,$idUser){
    $req = $bdd->prepare('UPDATE users SET famille_accueil = 0 WHERE id_user = :idUser');
    $res = $req->execute([':idUser'=>$idUser]);
    if(!$res) {
    $errorInfo = $req->errorInfo();
    echo "Error: " . $errorInfo[2];
    return false;
    }
    return $res;
}

//utilisateurs

function getUsers($bdd){
    $req = $bdd->prepare('
    SELECT * 
    FROM users u
    LEFT JOIN role r ON r.id_role = u.id_role
    WHERE compte = 1 AND (r.role != "Superadmin")
    ');
    $req->execute();
    $res = $req->fetchAll();
    if(!$res) {
        $errorInfo = $req->errorInfo();
        echo "Error: " . $errorInfo[2];
        return false;
        }
        return $res;
    }

function getRoles($bdd){
    $req = $bdd->prepare('SELECT * FROM role WHERE role != "Superadmin"  ');
    $req->execute();
    $res = $req->fetchAll();
    if(!$res) {
        $errorInfo = $req->errorInfo();
        echo "Error: " . $errorInfo[2];
        return false;
        }
        return $res;
    }

function changerRole($bdd,$idUser,$idRole){
    $req = $bdd->prepare('UPDATE users SET id_role = :idRole WHERE id_user = :idUser');
    $res = $req->execute([':idUser'=>$idUser,':idRole'=>$idRole]);
    if(!$res) {
    $errorInfo = $req->errorInfo();
    echo "Error: " . $errorInfo[2];
    return false;
    }
    return $res;
}

//valider adoption

function getFormFromId($bdd,$idForm){
    $req = $bdd->prepare('
    SELECT *
    FROM formulaires f
    LEFT JOIN chats c ON c.id_chat = f.id_chat
    WHERE id_fa = :idForm');
    $req->execute([':idForm'=>$idForm]);
    $res = $req->fetch();
    return $res;
}

function validateForm($bdd, $idForm) {
    $req = $bdd->prepare('UPDATE formulaires SET valide = 1 WHERE id_fa = :idForm');
    $req->execute([':idForm' => $idForm]);
    return $req->rowCount(); 
}

function insertAdoption($bdd, $idUser, $idChat,$idForm) {
    $req = $bdd->prepare('INSERT INTO adoption (users_id_user, chats_id_chat, formulaires_id_formulaire) VALUES (?, ?,?)');
    $req->execute([$idUser, $idChat,$idForm]);
    return $bdd->lastInsertId(); 
}
function insertAdoptionHorsSite($bdd, $idChat) {
    try {
        $req = $bdd->prepare('INSERT INTO adoption (chats_id_chat,non_site) VALUES (?,1)');
        $req->execute([$idChat]);
        return $bdd->lastInsertId(); 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    
}

function deleteOtherForms($bdd, $idChat, $idForm) {
    $req = $bdd->prepare('UPDATE formulaires SET supprime = 1 WHERE id_chat = :idChat AND id_fa != :idForm');
    $req->execute([':idChat' => $idChat, ':idForm' => $idForm]);
    return $req->rowCount(); 
}

function deleteForms($bdd,$idChat){
    $req = $bdd->prepare('UPDATE formulaires SET supprime = 1 WHERE id_chat = :idChat');
    $req->execute([':idChat' => $idChat]);
    return $req->rowCount(); 
}

function getAdoptions($bdd){
    $req = $bdd->prepare('
    SELECT *
    FROM adoption a
    LEFT JOIN chats c ON c.id_chat = a.chats_id_chat
    LEFT JOIN users u ON u.id_user = a.users_id_user
    ');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

function getChatsFromForm($bdd,$idChat){
    $req = $bdd->prepare('SELECT * FROM chats WHERE id_chat = :idChat');
    $req->execute([':idChat'=>$idChat]);
    $res = $req->fetch();
    return $res;
}

function deleteAdoption($bdd,$idChat){
    $req = $bdd->prepare('DELETE FROM adoption WHERE chats_id_chat = :idChat');
    $req->execute([':idChat'=>$idChat]);
}

function getAdoptionFromChat($bdd,$idChat){
    $req = $bdd->prepare('
    SELECT *
    FROM adoption a
    LEFT JOIN chats c ON c.id_chat = a.chats_id_chat
    LEFT JOIN sexe s ON s.id_sexe = c.sexe_id_sexe
    LEFT JOIN users u ON u.id_user = a.users_id_user
    LEFT JOIN adresses ad ON ad.id_user = u.id_user
    LEFT JOIN ville v ON v.id_ville = ad.id_ville
    WHERE chats_id_chat = :idChat;
    ');
    $req->execute([':idChat'=>$idChat]);
    $res = $req->fetch();
    return $res;
}
function getFaFromChat($bdd,$idChat){
    $req = $bdd->prepare('
    SELECT *
    FROM familles_accueil f
    LEFT JOIN chats c ON c.id_chat = f.chats_id_chat
    LEFT JOIN sexe s ON s.id_sexe = c.sexe_id_sexe
    LEFT JOIN users u ON u.id_user = f.users_id_user
    LEFT JOIN adresses ad ON ad.id_user = u.id_user
    LEFT JOIN ville v ON v.id_ville = ad.id_ville
    WHERE chats_id_chat = :idChat;
    ');
    $req->execute([':idChat'=>$idChat]);
    $res = $req->fetch();
    return $res;
}
function updateDateFinAccueil($bdd,$idChat,$dateEnd){
    $req = $bdd->prepare('UPDATE familles_accueil SET date_end = :date WHERE chats_id_chat = :idChat');
    $req->execute([':date'=>$dateEnd,':idChat'=>$idChat]);
}


// TABLEAU DE BORD

function countChatsEnLigne($bdd){
    $req = $bdd->prepare('SELECT COUNT(id_chat) as number FROM chats WHERE en_ligne = 1 AND supprime = 0');
    $req->execute();
    $res = $req->fetch();
    return $res;
}

function countFormsFA($bdd){
    $req = $bdd->prepare('SELECT COUNT(id_fa) as number_fa FROM formulaires WHERE form_type = 2 AND valide = 0 AND supprime = 0');
    $req->execute();
    $res = $req->fetch();
    return $res;
}

function countFormsAD($bdd){
    $req = $bdd->prepare('SELECT COUNT(id_fa) as number_ad FROM formulaires WHERE form_type = 1 AND valide = 0 AND supprime = 0 ');
    $req->execute();
    $res = $req->fetch();
    return $res;
}


?>