<?php
session_start();
require_once ("../config/config.php");
require_once ("../config/connectDb.php");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION["login"])&& $_SESSION["login"]) {
    $ville = htmlspecialchars($_POST["ville"]);
    $date = htmlspecialchars($_POST["date"]);
    $lieu = htmlspecialchars($_POST["lieu"]);
    $notes = htmlspecialchars($_POST["notes"]);
    $idConcert = htmlspecialchars($_POST["idConcert"]);

    $SQL = "UPDATE `concerts` SET `Ville` = :ville, `Date` = :date, `Lieu` = :lieu, `Notes` = :notes WHERE `concerts`.`IdConcert` = :id ";
    $stmt = $conn->prepare($SQL);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':lieu', $lieu);
    $stmt->bindParam(':notes', $notes);
    $stmt->bindParam(':id', $idConcert);
    if($stmt->execute()) {
        echo "le concerte a été mis à jour";
    }else{
        echo "une erreur est survenue";
    }
    header("location: ../views/admin/concert.php?id=".$idConcert);

}