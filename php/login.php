<?php
session_start();
require_once ("../config/config.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    // Connexion à la base de données
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    // Vérification de la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $stmt=$conn->prepare("SELECT `SettingValue` FROM `settings` WHERE SettingName='Password'; ");
    $stmt->execute();
    $stmt->bind_result($storedPassword);
    $stmt->fetch();

    if(password_verify($password, $storedPassword)){
        $_SESSION['login']=true;
        header("Location: ../views/admin/admin.php"); // Redirection vers la page d'accueil ou le tableau de bord
        exit();
    }
    $_SESSION['login']=false;
}
$_SESSION['login']=false;





?>