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
        <link rel="stylesheet" href="../../assets/css/concertAdmin.css">
    </head>
        <body>
        <?php
        $concertId=$_GET["id"];
        $concertData = getConcertById($conn, $concertId);
        ?>
        <a id="backLink" href="admin.php">Retour à la liste des concerts</a>
        <h1>Modifier le concert</h1>
        <main>
            <section id="sectionLeft">
                <h2>Informations:</h2>
                <!-- Formulaire de modification des informations du concert-->
                <form method="post" action="../../php/editConcert.php">
                    <label for="villeInput">Ville</label>
                    <input id="villeInput" name="ville" type="text" value="<?= $concertData["Ville"] ?>">
                    <br>
                    <label for="dateInput">Date</label>
                    <input id="dateInput" name="date" type="datetime-local" value="<?= $concertData["Date"] ?>">
                    <br>
                    <label for="lieuInput">Lieu</label>
                    <input id="lieuInput" name="lieu" type="text" value="<?= $concertData["Lieu"] ?>">
                    <br>
                    <label for="notesInput">Notes</label>
                    <input id="notesInput" name="notes" type="text" value="<?= $concertData["Notes"] ?>">
                    <input id="idConcert" name="idConcert" type="hidden" value="<?=$concertData['IdConcert']?>">
                    <br>
                    <input id="editButton" name="submit" type="submit" value="Modifier">
                </form>
            </section>
            <section id="sectionRight">
                <h2>Photos</h2>

                <table>
                    <thead>
                    <th>Nom</th>
                    <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr id="addPictureRow">
                            <form action="../../php/addPicture.php" method="post" enctype="multipart/form-data">
                            <td><input type="file" name="image" required><input type="hidden" name="id" value="<?=$concertId?>"><input type="text" name="caption" placeholder="texte alternatif"></td>
                            <td><input type="submit" value="Ajouter"></td>
                            </form>
                        </tr>
                        <?php
                        $photos = getPhotoByConcertId($conn, $concertId);
                        foreach($photos as $photo){
                        ?>
                        <tr>
                            <td><a target="_blank" href="../../uploads/<?=$photo['URL']?>" title="<?=$photo["Caption"]?>"><?=$photo["URL"]?></a></td>
                            <td><a href="../../php/deletePicture.php?pictureId=<?=$photo['IdPhoto']?>">Supprimer</a></td>
                        </tr>
                            <?php } ?>
                    </tbody>
                </table>
            </section>


        </main>

        </body>
    </html>
<?php }else{
    die();
} ?>