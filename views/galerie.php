<?php
require_once ("../config/config.php");
require_once ("../config/connectDb.php");
require_once ("../php/adminFunctions.php")
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page 1</title>
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/galerie.css">
</head>

<body>

<?php
include_once "../includes/header.php";
?>
<main id="content">
    <?php
    $concerts = getConcertsWithPhotos($conn);
    foreach ($concerts as $concert) {
        ?>
    <h2 id="concert<?=$concert['IdConcert']?>"><?=$concert["Ville"].' - '.formatDate($concert['Date'])?></h2>
    <hr>
    <div class="grid">
        <?php
        $photos=getPhotoByConcertId($conn,$concert["IdConcert"]);
        foreach ($photos as $photo) {
            ?>
            <div class="grid-item"><img src="../uploads/<?=$photo['URL']?>"></div>
            <?php
        }
        ?>
    </div>

<?php
    }
    ?>
</main>
<?php
include_once "../includes/footer.php";
?>

<script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
<script src="../js/galerie.js"></script>
<script src="../js/script.js"></script>

</body>
</html>
