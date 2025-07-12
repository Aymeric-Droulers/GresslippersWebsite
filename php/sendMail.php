<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Destinataire du mail
    $destinataire = "droulers.aymeric@gmail.com";

    // Sujet du mail
    $sujet = "Nouveau message de $prenom $nom";

    // Corps du mail
    $contenu = "Vous avez reçu un nouveau message depuis votre formulaire de contact :\n\n";
    $contenu .= "Nom : $nom\n";
    $contenu .= "Prenom : $prenom\n";
    $contenu .= "Email : $email\n";
    $contenu .= "Message :\n$message";

    // Entêtes du mail
    $headers = "From: $email";


    //Vérifier le captcha
    $url = "https://www.google.com/recaptcha/api/siteverify";
    $data = array(
        'secret' => '6LdruB4rAAAAAEl7fvaTZhhoX8SKMR_VC3EmoMgs',
        'response' => $_POST["g-recaptcha-response"],
        'remoteip' => $_SERVER['REMOTE_ADDR']
    );
    $dataEncoded = http_build_query($data);

    // Configurer le contexte de la requête
    $options = array(
        'http' => array(
            'method' => 'POST', // Utiliser la méthode POST
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'content' => $dataEncoded, // Ajouter les données JSON au corps de la requête
            'ignore_errors' => true // Pour récupérer les réponses même en cas d'erreur HTTP
        )
    );

    // Créer le contexte HTTP
    $context = stream_context_create($options);

    // Envoyer la requête et récupérer la réponse
    $response = file_get_contents($url, false, $context);

    // Vérifier si une erreur est survenue
    if ($response === false) {
        $success = false;
    } else {
        // Afficher la réponse de l'API

        $response = json_decode($response, true);
        if ($response["success"] == true) {

            $success = true;
        } else {

            $_SESSION["error"] = "Le CAPTCHA n'a pas été validé. Merci de ressayer";
            $success = false;
        }
    }


// Envoi du mail
    if ($success) {
        if (mail($destinataire, $sujet, $contenu, $headers)) {
            $success = true;
        } else {
            $success = false;
        }
    }
}else{
    $success = false;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page 1</title>
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/global.css">
    <link rel="stylesheet" href="../assets/css/sendMail.css">
</head>
    <body id="content">
    <?php if($success){ ?>
        <h2>Nous avons bien recu votre message!</h2>
    <?php }else{ ?>
        <h2>Votre message n'a pas pu être envoyé. Veuillez reessayer.</h2>
    <?php } ?>
        <a href="../views/contact.php">Retour au site</a>

    </body>
</html>




