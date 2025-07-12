<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gressklipers - Concerts</title>
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/groupe.css">
</head>

<body>

<?php
include_once "../includes/header.php";
?>
<main id="content">
    <h1>Qui sommes nous?</h1>
    <hr>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim  veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  commodo consequat. Duis aute irure dolor in reprehenderit in voluptate  velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod  tempor incididunt ut labore et dolore magna aliqua. </p>
    <div id="people">
        <div class="peopleDiv" onclick="openDiv('LouisSection')"></div>
        <div class="peopleDiv" onclick="openDiv('CelestinSection')"></div>
        <div class="peopleDiv"></div>
        <div class="peopleDiv"></div>
        <div class="peopleDiv"></div>
        <div class="peopleDiv"></div>
    </div>


<?php
$name="Louis";
require "../includes/people.php";
$name="Celestin";
require "../includes/people.php";
?>

</main>
<?php
include_once "../includes/footer.php";
?>




</body>
<script src="../js/groupe.js"></script>

</html>
