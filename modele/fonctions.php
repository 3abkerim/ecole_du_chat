<?php

// chats

function getChatsEnLigne($bdd){
    $req = $bdd->prepare('
        SELECT * 
        FROM chats c
        JOIN sexe s ON c.sexe_id_sexe = s.id_sexe
        JOIN race r ON c.race_id_race = r.id_race
        WHERE c.en_ligne = 1 AND c.supprime = 0 AND c.decede = 0
    ');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

function getImagesChat($bdd,$idChat){
    $req = $bdd->prepare('SELECT * FROM images WHERE chats_id_chat = :idChat ORDER BY ordre ASC');
    $req->execute([':idChat'=>$idChat]);
    $res = $req->fetchAll();
    return $res;
}

function getFirstImageChat($bdd, $idChat){
    $req = $bdd->prepare('SELECT * FROM images WHERE chats_id_chat = :idChat ORDER BY ordre ASC LIMIT 1');
    $req->execute([':idChat'=>$idChat]);
    $res = $req->fetch();
    return $res;
}

function getAge($bdd,$idChat){
    $req = $bdd->prepare('SELECT age FROM chats WHERE id_chat = :idChat');
    $req->execute([':idChat'=>$idChat]);
    $res = $req->fetch();
    return $res['age'];
}
function getChatById($bdd,$idChat){
    $req = $bdd->prepare('
    SELECT * 
    FROM chats c
    JOIN sexe s ON c.sexe_id_sexe = s.id_sexe
    LEFT JOIN race r ON c.race_id_race = r.id_race
    WHERE c.id_chat = :idChat
');
$req->execute([':idChat'=>$idChat]);
$res = $req->fetch();
return $res;
}

function getChatFB($bdd,$idChat){
    $req = $bdd->prepare('
    SELECT * 
    FROM chats c
    JOIN sexe s ON c.sexe_id_sexe = s.id_sexe
    JOIN race r ON c.race_id_race = r.id_race
    WHERE c.id_chat = :idChat
    ');
    $req->execute([':idChat'=>$idChat]);
    $res = $req->fetch();
    return $res;
}
//On_parle_de_nous

function getOPDNEnLigne($bdd){
    $req = $bdd->prepare('SELECT * FROM on_parle_de_nous WHERE en_ligne = 1 AND supprime = 0 ORDER BY date_publication DESC');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}
function getImagesOPDN($bdd,$idOPDN){
    try{
        $req = $bdd->prepare('SELECT * FROM images WHERE id_on_parle_de_nous = :idOPDN');
        $req->execute([':idOPDN'=>$idOPDN]);
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
}
}
function getOPDNById($bdd,$idOPDN){
    $req = $bdd->prepare('SELECT * FROM on_parle_de_nous WHERE id_on_parle_de_nous = :idOPDN');
    $req->execute([':idOPDN'=>$idOPDN]);
    $res = $req->fetch();
    return $res;
}


// Articles

function getArticlesEnLigne($bdd){
    $req = $bdd->prepare('SELECT * FROM articles WHERE en_ligne = 1 AND supprime = 0 ORDER BY date_article DESC');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}
function getImagesArticle($bdd,$idArticle){
    try{
        $req = $bdd->prepare('SELECT * FROM images WHERE articles_id_article = :idArticle ORDER BY ordre ASC');
        $req->execute([':idArticle'=>$idArticle]);
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
}
}
function getImageArticleFB($bdd,$idArticle){
    try{
        $req = $bdd->prepare('SELECT * FROM images WHERE articles_id_article = :idArticle ORDER by ordre ASC LIMIT 1');
        $req->execute([':idArticle'=>$idArticle]);
        $res = $req->fetch();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
}
}
function getArticleById($bdd,$idArticle){
    $req = $bdd->prepare('SELECT * FROM articles WHERE id_article = :idArticle');
    $req->execute([':idArticle'=>$idArticle]);
    $res = $req->fetch();
    return $res;
}

// EVENTS
function getEventsEnLigne($bdd){
    $req = $bdd->prepare('SELECT * FROM events WHERE en_ligne = 1 AND supprime = 0 ORDER BY date_publication DESC');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}
function getImagesEvent($bdd,$idEvent){
    try{
        $req = $bdd->prepare('SELECT * FROM images WHERE events_id_event = :idEvent');
        $req->execute([':idEvent'=>$idEvent]);
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
}
}

// Inscription

function createUser($bdd,$civilite, $nom, $prenom, $email, $mdp, $dob,$numero, $role, $ville, $departement, $adresse){
    $reqCreateUser = $bdd->prepare('INSERT INTO users (nom, prenom, date_naissance, email, mdp,numero, id_role) VALUES (?,?,?,?,?,?,?)');
    $reqCreateUser->execute([$civilite,$nom, $prenom, $dob, $email, $mdp,$numero, $role]);
    $user_id = $bdd->lastInsertId();

    return  $user_id;
    
}
function createUserFromForm($bdd, $civilite, $nom, $prenom, $email, $dob, $numero, $role){
    $reqCreateUser = $bdd->prepare('INSERT INTO users (id_civilite, nom, prenom, email, date_naissance, numero, id_role) VALUES (?,?,?,?,?,?,?)');
    
    try {
        $reqCreateUser->execute([$civilite, $nom, $prenom, $email, $dob, $numero, $role]);

        // If execution is successful, check the number of affected rows
        $affectedRows = $reqCreateUser->rowCount();

        if($affectedRows > 0) {
            // Fetch the last inserted id
            $id_user = $bdd->lastInsertId();
            
            // Check the id
            var_dump($id_user);
            
            return $id_user;
        } else {
            // If no rows were affected, output some debug info
            var_dump($reqCreateUser->errorInfo());
            return false;
        }
    } catch (PDOException $e) {
        // Catch and display SQL execution errors
        echo 'Error executing query: ' . $e->getMessage();
        return false;
    }
}


function createCompteUser($bdd,$civilite, $nom, $prenom, $dob, $email, $mdp,$numero, $role,$compte){
    $reqCreateUser = $bdd->prepare('INSERT INTO users (id_civilite,nom, prenom, date_naissance, email, mdp,numero, id_role,compte) VALUES (?,?,?,?,?,?,?,?,?)');
    $reqCreateUser->execute([$civilite,$nom, $prenom, $dob, $email, $mdp,$numero, $role,$compte]);
    $user_id = $bdd->lastInsertId();

    return  $user_id;
    
}
function getDep($bdd){
    try{
        $reqDep = $bdd->prepare("SELECT * FROM departement");
        $reqDep->execute();
        $depts = $reqDep->fetchAll();
        return $depts;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
function getDepParVille($bdd,$idVille){
    try{
        $reqDep = $bdd->prepare("SELECT * FROM departement WHERE id_ville=:idVille");
        $reqDep->execute([[':idVille'=>$idVille]]);
        $depts = $reqDep->fetchAll();
        return $depts;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
function recupDep($bdd,$id_departement){

    $reqRecupDep= $bdd->prepare("SELECT nom_departement FROM departement WHERE id_departement = :departement_id");
    $reqRecupDep -> execute([':departement_id'=>$id_departement]);
    $listeDepts = $reqRecupDep->fetchAll();
    return $listeDepts;
}

function getVilles($bdd, $departement_id) {
    $ville = "SELECT * FROM ville WHERE id_departement = :departement_id ORDER BY nom_ville";
    $ville_qry = $bdd->prepare($ville);
    $ville_qry->execute([':departement_id' => $departement_id]);
    $villes = $ville_qry->fetchAll();

    return $villes;
}
function getToutVilles($bdd) {
    $ville = "SELECT * FROM ville";
    $ville_qry = $bdd->prepare($ville);
    $ville_qry->execute();
    $villes = $ville_qry->fetchAll();

    return $villes;
}

function userExists($bdd,$email){
    try {
        $req = "SELECT * FROM users WHERE email = :mail";
        $reqUserExists = $bdd->prepare($req);
        $reqUserExists->execute([':mail'=>$email]);
        $userExists=$reqUserExists->fetch();
        return $userExists;

    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
}
}

function userCompteExists($bdd,$email){
    try {
        $req = "SELECT * FROM users WHERE email = :mail AND compte = 1";
        $reqUserExists = $bdd->prepare($req);
        $reqUserExists->execute([':mail'=>$email]);
        $userExists = $reqUserExists->fetch();

        if ($userExists && is_array($userExists)) {
            echo "User exists in the database.<br/>";
        } else {
            echo "No user found in the database with email: " . $email . "<br/>";
        }

        return $userExists;
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }
}



function insertAdresseUser($bdd,$adresse, $ville_id,$id_user){
    $reqCreateAdresse = $bdd->prepare('INSERT INTO adresses(adresse, id_ville,id_user) VALUES (?,?,?)');
    $reqCreateAdresse->execute([$adresse, $ville_id,$id_user]); 
    return $bdd->lastInsertId();
}
// CONNEXION

function getUser($bdd, $idUser) {
    try {
        $req = $bdd->prepare(
            'SELECT *
             FROM users u
             LEFT JOIN images i ON u.id_user = i.id_user
             LEFT JOIN adresses a ON u.id_user = a.id_user
             LEFT JOIN ville v ON a.id_ville = v.id_ville
             LEFT JOIN departement d ON v.id_departement = d.id_departement
             LEFT JOIN civilite c ON c.id_civilite = u.id_civilite
             WHERE u.id_user = :idUser'
        );
        $req->execute([':idUser' => $idUser]);
        $user = $req->fetch();
        return $user;
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage());
    }
}





// form

function getCivliteUser($bdd){
    $req = $bdd->prepare('SELECT * FROM civilite');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}
function getStatutUser($bdd){
    $req = $bdd->prepare('SELECT * FROM statut');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}
function getSituationUser($bdd){
    $req = $bdd->prepare('SELECT * FROM situation');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}
function getRevenusUser($bdd){
    $req = $bdd->prepare('SELECT * FROM revenus');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}
function getTypeLogement($bdd){
    $req = $bdd->prepare('SELECT * FROM type_logement');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}
function getTailleLogement($bdd){
    $req = $bdd->prepare('SELECT * FROM taille_logement');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}

// function insertFormAdoption($bdd){
//     $req = $bdd->prepare('INSERT INTO formulaires(id_user,id_chat,date_form,id_statut,id_situation,id_revenus,taille_logement,superficie_logement,enfants,nombres_enfants,acces_balcon,securite_balcon,faire_securite_balcon,dtls_securite_balcon,route_proche,permission_animal,vehicule,accord,asthme,enfants_contacts,enceinte,avoir_animal,dtls_animaux,degats_chat,animaux_possedes,especes,sexe,sterlises,vaccins_ajour,veto_referant,deja_adopte_animal,raison_decedes,separation_animal,raison_separation,chat_seul_heures,nourriture,bool_budget,budget,absence,raison_adoption,pq_ce_chat,adaptation_mal) VALUES (?,?,?,?,?,?,?,?) ');
//     $insert = $req->execute([]);
//     return $insert;
// }





function insertFormAdoption($bdd, $data){
    try {
        $columns = implode(',', array_keys($data));
        $placeholders = implode(',', array_fill(0, count($data), '?'));

        $req = $bdd->prepare("INSERT INTO formulaires ({$columns}) VALUES ({$placeholders})");
        $insert = $req->execute(array_values($data));
        
        if(!$insert) {
            $error = $req->errorInfo();
            throw new Exception("Database error: $error[2]");
        }
        
        return $insert;
    } catch (Exception $e) {
        die('Error : ' . $e->getMessage() . '. PDO Error: ' . implode(", ", $bdd->errorInfo()));
    }
}


// function insertFormAdoption($bdd, $data) {
//     $columns = implode(',', array_keys($data));
//     $placeholders = implode(',', array_fill(0, count($data), '?'));

//     // Prepare the query
//     $query = "INSERT INTO formulaires ({$columns}) VALUES ({$placeholders})";
//     $stmt = $bdd->prepare($query);

//     // For debugging: print the prepared query
//     echo 'Prepared query: ' . str_replace(',', ', ', $query) . '<br>';

//     // Execute the query
//     if (!$stmt->execute(array_values($data))) {
//         // If there is an error, print the error information
//         print_r($stmt->errorInfo());
//         return false;
//     }
//     return true;
// }


// ESPACE USER

function updateUserInfo($bdd,$idUser,$nom,$prenom,$email,$dob){
    try{
    $req = $bdd->prepare('UPDATE users SET nom = :nom, prenom = :prenom, email = :email, date_naissance = :dob WHERE id_user = :idUser');
    $req->execute([':idUser'=>$idUser,':nom'=>$nom,':prenom'=>$prenom,':email'=>$email,':dob'=>$dob]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function updateAdresse($bdd, $idUser, $adresse, $idVille){
    try {
        $req = $bdd->prepare(
            'UPDATE adresses
            SET adresse = :adresse, id_ville = :idVille
            WHERE id_user = :idUser'
        );
        $result = $req->execute([':idUser' => $idUser, ':adresse' => $adresse, ':idVille' => $idVille]);
        
        if ($result) {
            echo "Updated addresses table successfully.<br/>";
        } else {
            echo "Failed to update addresses table.<br/>";
        }
        
        

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}


function getUsermdp($bdd,$idUser){
    $req = $bdd->prepare('SELECT * FROM users WHERE id_user = :idUser');
    $req->execute([':idUser'=>$idUser]);
    $mdp = $req->fetch();
    return $mdp['mdp'];
}
function modifierMdp($bdd,$mdp,$idUser){
    $req = $bdd->prepare('UPDATE users SET mdp=:mdp WHERE id_user=:idUser');
    $req->execute([':mdp'=>$mdp,':idUser'=>$idUser]);
}
// chats espace user

function getChatsAccueillis($bdd,$idUser){
    $req = $bdd->prepare('
        SELECT * 
        FROM chats c
        JOIN sexe s ON c.sexe_id_sexe = s.id_sexe
        JOIN race r ON c.race_id_race = r.id_race
        JOIN familles_accueil f ON f.chats_id_chat = c.id_chat
        WHERE c.en_ligne = 1 AND c.supprime = 0 AND c.decede = 0 AND f.users_id_user = :idUser
    ');
    $req->execute([':idUser'=>$idUser]);
    $res = $req->fetchAll();
    return $res;
}

function getChatsAdoptes($bdd,$idUser){
    $req = $bdd->prepare('
        SELECT * 
        FROM chats c
        JOIN sexe s ON c.sexe_id_sexe = s.id_sexe
        JOIN race r ON c.race_id_race = r.id_race
        JOIN adoption a ON a.chats_id_chat = c.id_chat
        WHERE c.supprime = 0 AND c.decede = 0 AND a.users_id_user = :idUser
    ');
    $req->execute([':idUser'=>$idUser]);
    $res = $req->fetchAll();
    return $res;
}
// Boutique
function getProduitsEnLigne($bdd){
    $req = $bdd->prepare('SELECT * FROM produits WHERE en_ligne = 1 AND deleted = 0');
    $req->execute();
    $res = $req->fetchAll();
    return $res;
}
function getImagesProduit($bdd,$idProduit){
    try{
        $req = $bdd->prepare('SELECT * FROM images WHERE id_produit = :idProduit ORDER BY ordre ASC');
        $req->execute([':idProduit'=>$idProduit]);
        $res = $req->fetchAll();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
}
}
function getProduitById($bdd,$idProduit){
    $req = $bdd->prepare('SELECT * FROM produits WHERE id_produit = :idProduit');
    $req->execute([':idProduit'=>$idProduit]);
    $res = $req->fetch();
    return $res;
}


// PANIER


function produitExists($bdd, $id_produit){
    $stmt = $bdd->prepare('SELECT * FROM produits WHERE id_produit = :id');
    $stmt->execute([':id' => $id_produit]);
    $produit = $stmt->fetch();
    return $produit;
}

function recupPrixProd($bdd,$idProd){
    $req = $bdd->prepare('SELECT prix_unit FROM produits WHERE id_produit=?');
    $req->execute([$idProd]);
    $prixProd = $req->fetch();

    return $prixProd['prix_unit'];
}

//!correction JUGURTA 

function insertPanier($bdd,$montantProduit,$date,$idUser){

    //$reqInsertPanier = $pdo->prepare('INSERT INTO panier(montant,date_creation,id_user)') VALUES (?,?,?);
    //reqInsertPanier->execute([$montantProduit,$date,$_SESSION['idUser']]);
/*
    $req = 'INSERT INTO panier(montant,date_creation,id_user) VALUES (?,?,?)';
    $tabValues = [$montantProduit,$date,$id_user];
    if($id_user == 0){
        $req = 'INSERT INTO panier(montant,date_creation) VALUES (?,?)';
        $tabValues = [$montantProduit,$date];
    } 

}
*/
//* est equivalent a

if($idUser == 0){
    $req = 'INSERT INTO panier(montant,date_creation) VALUES (?,?)';
    $tabValues = [$montantProduit,$date];
}else{
    $req = 'INSERT INTO panier(montant,date_creation,id_user) VALUES (?,?,?)';
    $tabValues = [$montantProduit,$date,$idUser];
}
$reqInsertPanier = $bdd->prepare($req);
$reqInsertPanier->execute($tabValues);
}
//!-------------

function supprimerArticle($bdd,$idProduit){
    $req = $bdd->prepare('DELETE FROM details_panier WHERE id_produit = :id_produit');
    $req->execute([':id_produit'=>$idProduit]);
    $supArticle = $req;
    return $supArticle;
}
function updateTotalPanier($bdd,$id_panier){
    $req = $bdd->prepare('UPDATE panier 
    SET montant =(
        SELECT SUM(dp.prix_unit * dp.qte_com)
        FROM details_panier dp
        WHERE dp.id_panier = :idPanier
    )
    WHERE id_panier = :idPanier
    ');
    $updateMontant = $req->execute([':idPanier'=>$id_panier]);
    return $updateMontant;
}
function panierVide($bdd,$id_panier){
    $req = $bdd->prepare('SELECT COUNT(*) FROM details_panier WHERE id_panier = :id_panier');
    $req->execute([':id_panier' => $id_panier]);
    $count = $req->fetchColumn();
    return $count === '0'; 
}
function supprimerPanier($bdd,$id_panier){
    $req = $bdd->prepare('DELETE FROM panier WHERE id_panier = :id_panier');
    $req -> execute([':id_panier'=>$id_panier]);
}

function modifQteProd($bdd,$product_id,$qte){
    $req = $bdd->prepare('UPDATE details_panier SET qte_com = :qte WHERE id_produit = :idProd');
    $resultat = $req -> execute([':idProd'=>$product_id,':qte'=>$qte]);
    return $resultat;
}
function getTotalPanier($bdd,$id_panier){
    $req = $bdd->prepare('SELECT montant FROM panier WHERE id_panier = :idPanier');
    $req->execute([':idPanier' => $id_panier]);
    $newTotalPanier = $req->fetchColumn();
    return $newTotalPanier;
}

function getCartItems($bdd, $id_panier) {
    $reqCartItems = $bdd->prepare("
        SELECT p.nom_produit, p.prix_unit, dp.qte_com, dp.id_produit
        FROM details_panier dp 
        INNER JOIN produits p ON p.id_produit = dp.id_produit
        WHERE dp.id_panier = :id_panier
    ");
    $reqCartItems->execute([':id_panier' => $id_panier]);
    $cartItems = $reqCartItems->fetchAll();
    return $cartItems;
}

function getCartItemCount($cartItems) {
    $count = 0;
    foreach ($cartItems as $item) {
        $count += $item['qte_com'];
    }
    return $count;
}
function getImages($bdd,$id_produit){
    try{
        $reqImages = $bdd->prepare("SELECT * FROM images WHERE id_produit=:id_prod");
        $reqImages->execute([':id_prod'=>$id_produit]);
        $images = $reqImages->fetchAll();
        return $images;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}

// user



function getImageUser($bdd,$idUser){
    try{
        $req = $bdd->prepare("SELECT * FROM images WHERE id_user=:idUser");
        $req->execute([':idUser'=>$idUser]);
        $res = $req->fetch();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}

function insertImageUser($bdd, $image, $idUser) {

    try {
        $bdd->beginTransaction();
        // Check if an image already exists for this event
        $checkQuery = $bdd->prepare('SELECT fichier FROM images WHERE id_user = ?');
        $checkQuery->execute([$idUser]);
        $existingImage = $checkQuery->fetch();

        if ($existingImage) {
            // If an image exists, delete it
            $oldImagePath = $existingImage['fichier'];
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            // Update the existing record
            $updateQuery = $bdd->prepare('UPDATE images SET fichier = ? WHERE id_user = ?');
            $result = $updateQuery->execute([$image, $idUser]);
            // if(!$result) {
            //     print_r($bdd->errorInfo());
            // }

        } else {
            // If no image exists, insert a new record
            $req = $bdd->prepare('INSERT INTO images (fichier, id_user, ordre) VALUES (?, ?, 1)');
            $result = $req->execute([$image, $idUser]);
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

function supprimerImageProfil($bdd,$idImage,$idUser){
    $req = $bdd->prepare('DELETE FROM images WHERE id_image = :idImage AND id_user = :idUser');
    $result = $req->execute([':idImage'=>$idImage,':idUser'=>$idUser]);
    return $result;
}

// MDP oublie

function createPasswordReset($bdd,$idUser,$token,$expiresAt){
    $req = $bdd->prepare('INSERT INTO password_reset (users_id_user, token, date_expiration) VALUES (?, ?, ?)');
    $resultat = $req -> execute([$idUser,$token,$expiresAt]);
    return $resultat;
}

function updateMdp($bdd,$idUser,$mdp){
    $req = $bdd->prepare('UPDATE users SET mdp = :mdp WHERE id_user = :idUser');
    $req->execute([':mdp'=>$mdp,':idUser'=>$idUser]);
    return $req;
}

function getPasswordResetEntry($bdd,$idUser,$token){
    try{
        $req = $bdd->prepare("SELECT * FROM password_reset WHERE users_id_user=:idUser AND token = :token AND used = 0");
        $req->execute([':idUser'=>$idUser, ':token'=>$token]);
        $res = $req->fetch();
        return $res;
    }catch(PDOException $e){
        echo $e->getMessage();
        die();
    }
}
function updateToken($bdd, $idUser, $token) {
    $req = $bdd->prepare('UPDATE password_reset SET used = 1 WHERE users_id_user = :idUser AND token = :token');
    $req->execute([
        'idUser' => $idUser,
        'token' => $token,
    ]);
}
?>