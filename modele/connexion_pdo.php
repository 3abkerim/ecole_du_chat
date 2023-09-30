<?php
try{
    $bdd = new PDO("mysql:host=;
    dbname=;
    charset=UTF8","","");
}catch(PDOException $e){
    echo $e->getMessage();
    die();
}
?>