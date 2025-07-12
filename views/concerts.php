<?php
require_once ("../config/config.php");
require_once ("../config/connectDb.php");
require_once ("../php/adminFunctions.php");

$futureConcerts = getFutureConcerts($conn);
$passedConcerts =getPassedConcerts($conn);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gressklipers - Concerts</title>
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/concerts.css">
</head>

<body>

<?php
include_once "../includes/header.php";
?>
<main id="content">
    <h2>Concerts à venir</h2>
    <div class="concerts" id="concertsAVenir">
        <?php foreach ($futureConcerts as $concert){
            if(concertHadPhoto($conn,$concert['IdConcert'])){
                $link="href='galerie.php#concert".$concert['IdConcert']."'";
            }else{
                $link="";
            }?>
        <a <?=$link?>><?=$concert['Ville'].' - '.formatDate($concert['Date'])?></a>
        <?php } ?>
    </div>
    <h2>Concerts passés</h2>
    <div class="concerts" id="concertsPasses">
        <?php foreach ($passedConcerts as $concert){
            if(concertHadPhoto($conn,$concert['IdConcert'])){
                $link="href='galerie.php#concert".$concert['IdConcert']."'";
            }else{
                $link="";
            }?>
            <a <?=$link?>><?=$concert['Ville'].' - '.formatDate($concert['Date'])?></a>
        <?php } ?>

    </div>
</main>
<?php
include_once "../includes/footer.php";
?>

</body>
</html>
