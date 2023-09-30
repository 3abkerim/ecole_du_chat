<?php
try{
    $bdd = new PDO(";
    dbname=;
    charset=UTF8","","");
}catch(PDOException $e){
    echo $e->getMessage();
    die();
}
?>