<?php
session_start();
require_once ("../config/config.php");
require_once('../config/connectDb.php');
require_once('adminFunctions.php');

if(isset($_SESSION["login"])&& $_SESSION["login"]){
    $pictureId=intval($_GET["pictureId"]);
    $pictureData = getPhotoById($conn,$pictureId);
    if($pictureData) {
        $pictureName = $pictureData["URL"];
        $idConcert = $pictureData["IdConcert"];
        var_dump($idConcert);
        deletePictureBddRowById($conn, $pictureId);
        $numberPhotoUses=(intval(getPhotosByURL($conn,$pictureName)["COUNT(photos.URL)"]));
        if($numberPhotoUses == 0){
            $filePath = "../uploads/".$pictureName;
            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    echo "Image supprimée du dossier.<br>";
                    header("Location: ../views/admin/concert.php?id=".$idConcert);
                }
            }
        }
        header("Location: ../views/admin/concert.php?id=".$idConcert);
    }else{
        echo "La photo n'éxiste pas";
        header("Location: ../views/admin/concert.php?id=".$idConcert);
    }


}