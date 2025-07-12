<?php
require_once("../../config/config.php");
require_once("../../config/connectDb.php");
require_once("../../php/adminFunctions.php");
session_start();
if(isset($_SESSION["login"])&& $_SESSION["login"]==true){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../../assets/css/normalize.css">
    <link rel="stylesheet" href="../../assets/css/global.css">
    <link rel="stylesheet" href="../../assets/css/admin.css">
</head>
<body>
<?php
$concerts = getAllConcertsOrderByDate($conn);
?>
<a id="backLink" href="../../index.html">Retour au site</a>
<h1>Espace administrateur</h1>
<table>
    <thead>
        <th>Ville</th>
        <th>Date</th>
        <th>Lieu</th>
        <th>Notes</th>
        <th>Actions</th>
    </thead>
    <tbody>
        <tr id="addConcertRow">
            <form method="post" action="../../php/addConcert.php">
                <td><input placeholder="Ville" id="villeInput" type="text" name="ville"></td>
                <td><input placeholder="Date" id="dateInput" type="datetime-local" name="date"></td>
                <td><input placeholder="Lieu" id="lieuInput" type="text" name="lieu"></td>
                <td><input placeholder="Notes" id="noteInput" type="text" name="notes"></td>
                <td><input type="submit" value="ajouter"></td>
            </form>
        </tr>
        <?php foreach ($concerts as $concert){ ?>
        <tr>
            <td><?=$concert['Ville']?></td>
            <td><?=$concert['Date']?></td>
            <td><?=$concert['Lieu']?></td>
            <td><?=$concert['Notes']?></td>
            <td><a href="concert.php?id=<?=$concert['IdConcert']?>">Modifier</a></td>
        </tr>

    <?php }?>
    </tbody>
</table>

</body>
</html>
<?php }else{
   // header('Location: login.html');
    die();
} ?>