<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gressklipers - Contact</title>
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/contact.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>

<?php
include_once "../includes/header.php";
?>
<main id="content">
    <h1>Nous contacter</h1>
    <hr>
    <h2>Vous souhaitez organiser la venue de notre groupe?</h2>
    <div id="consignesContact">
        <p>Quelques détails pratiques</p>
        <ul>
            <li>Lorem</li>
            <li>Lorem</li>
            <li>Lorem</li>
        </ul>
    </div>
    <form id="contactForm" method="post" action="../php/sendMail.php">
        <label for="nameInput">Nom</label>
        <input id="nameInput" type="text" name="nom" placeholder="Votre nom" required>
        <label for="firstNameInput">Prénom</label>
        <input id="firstNameInput" type="text" name="prenom" placeholder="Votre prénom" required>
        <label for="mailInput">Adresse Mail</label>
        <input id="mailInput" type="email" name="email" placeholder="Votre email" required>
        <label for="objetInput">Objet</label>
        <textarea id="objetInput" name="message" placeholder="Votre message" required></textarea>
        <div  id="captchaDiv" class="g-recaptcha" data-sitekey="6LdruB4rAAAAAHwbstHW5Di78j8mhhjhp7zm0y6A"></div>
        <button id="submitButton" type="submit">Envoyer</button>
    </form>

</main>
<?php
include_once "../includes/footer.php";
?>

</body>
</html>



