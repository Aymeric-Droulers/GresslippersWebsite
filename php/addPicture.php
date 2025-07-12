<?php
require_once('../config/config.php');
require_once('../config/connectDb.php');
session_start();
if(isset($_POST) && isset($_SESSION["login"])&& $_SESSION["login"]) {

    $concertId = intval($_POST['id']);
    $caption = htmlspecialchars($_POST['caption']);

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../uploads/';
        $fileName = basename($_FILES['image']['name']);
        $targetFile = $uploadDir . $fileName;
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Vérification du type de fichier (optionnel mais conseillé)
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            // Déplacement du fichier uploadé
            if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
                var_dump($_POST['id']);

                // Insertion dans la base de données
                $stmt = $conn->prepare("INSERT INTO photos (IdConcert,URL,Caption) VALUES (:IdConcert,:URL,:Caption)");
                $stmt->bindParam(':IdConcert', $concertId);
                $stmt->bindParam(':URL', $fileName);
                $stmt->bindParam(':Caption', $caption);

                if ($stmt->execute()) {
                    echo "Image uploadée et enregistrée avec succès !";
                    header('Location: ../views/admin/concert.php?id=' . $concertId);
                } else {
                    echo "Erreur lors de l'enregistrement en base : " . $stmt->error;
                    header('Location: ../views/admin/concert.php?id=' . $concertId);
                }


            } else {
                echo "Erreur lors de l'upload du fichier.";
                header('Location: ../views/admin/concert.php?id=' . $concertId);
            }
        } else {
            echo "Type de fichier non autorisé. Formats acceptés : jpg, jpeg, png, gif.";
            header('Location: ../views/admin/concert.php?id=' . $concertId);
        }
    } else {
        echo "Aucun fichier sélectionné ou erreur lors de l'envoi.";
        header('Location: ../views/admin/concert.php?id=' . $concertId);
    }
}else{
    header('Location: ../views/admin/admin.php');
}
?>
