<?php
session_start();
require_once ("../config/config.php");
require_once ("../config/connectDb.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION["login"])&& $_SESSION["login"]) {
    $ville = htmlspecialchars($_POST["ville"]);
    $date = htmlspecialchars($_POST["date"]);
    $lieu = htmlspecialchars($_POST["lieu"]);
    $notes = htmlspecialchars($_POST["notes"]);


    $SQL = "INSERT INTO concerts (Ville, Date, Lieu, Notes) values (:ville, :date, :lieu, :notes)";
    $stmt = $conn->prepare($SQL);
    $stmt->bindParam(":ville", $ville);
    $stmt->bindParam(":date", $date);
    $stmt->bindParam(":lieu", $lieu);
    $stmt->bindParam(":notes", $notes);
    $exec = $stmt->execute();
    if($exec) {
        echo "Concert ajouté avec succès";
    }else{
        echo "Erreur lors de l'ajout de la concert";
    }
    header("Location:../views/admin/admin.php");

}


?>