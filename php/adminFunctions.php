<?php

/**
 * @author Aymeric Droulers
 */

/**
 * @param PDO $conn Objet PDO de connexion à la BDD
 * @return array Retourne l'intégralité de la table concerts trié du plus récent au moins récent
 */
function getAllConcertsOrderByDate(PDO $conn)
{
    try {
        $SQL = "SELECT * FROM concerts ORDER BY Date DESC";
        $stmt = $conn->prepare($SQL);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    } catch (PDOException $e) {
        die("Erreur lors de la récupération des concerts : " . $e->getMessage());
    }
}

/**
 * @param PDO $conn Objet PDO de connexion à la BDD
 * @param int $id Identifiant du concert que l'on veut récuperer
 * @return array Retourne le concert demandé
 */
function getConcertById(PDO $conn, $id){
    $SQL = "SELECT concerts.IdConcert, concerts.Ville , concerts.Date, concerts.Lieu, concerts.Notes FROM concerts WHERE IdConcert = :id";
    $stmt = $conn->prepare($SQL);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * @param PDO $conn Objet PDO de connexion à la BDD
 * @param int $id Identifiant du concert dont on veut récuperer les photos
 * @return array Retourne les photos demandées
 */
function getPhotoByConcertId(PDO $conn, $id){
    $SQL="SELECT photos.IdPhoto, photos.URL, photos.Caption FROM photos WHERE photos.IdConcert = :id";
    $stmt = $conn->prepare($SQL);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


/**
 * @param PDO $conn
* @param $id
* @return mixed
 */
function  getPhotoById(PDO $conn, $id){
    $SQL = "SELECT photos.URL,photos.IdConcert FROM photos WHERE photos.IdPhoto = :id";
    $stmt = $conn->prepare($SQL);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * @param PDO $conn
 * @param $id id de la photo a supprimer de la bdd
 * @return void
 */
function deletePictureBddRowById(PDO $conn, $id)
{
    $SQL = "DELETE FROM photos WHERE IdPhoto = :id";
    $stmt = $conn->prepare($SQL);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
}

function getPhotosByURL(PDO $conn, $url){
    $SQL = "SELECT COUNT(photos.URL) FROM photos WHERE photos.URL = :url";
    $stmt = $conn->prepare($SQL);
    $stmt->bindParam(":url", $url);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

/**
 * @param PDO $conn
 * @return array
 */
function getConcertsWithPhotos(PDO $conn)
{
    $concerts = getAllConcertsOrderByDate($conn);
    $returnArray = array();
    foreach ($concerts as $concert) {
        $photos= getPhotoByConcertId($conn, $concert["IdConcert"]);
        if(count($photos) > 0){
            $returnArray[] = $concert;
        }
    }
    return $returnArray;
}

/**
 * @param $conn
 * @param $id
 * @return bool est ce que le concert a des photos associés
 */
function concertHadPhoto($conn,$id)
{
    $SQL = 'SELECT COUNT(photos.URL) FROM photos WHERE photos.IdConcert = :id';
    $stmt = $conn->prepare($SQL);
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $count = $stmt->fetch(PDO::FETCH_ASSOC);
    if($count['COUNT(photos.URL)'] > 0){
        return true;
    }
    return false;
}

/**
 * @param PDO $conn
 * @return array
 */
function getFutureConcerts(PDO $conn){
    $SQL="SELECT concerts.IdConcert, concerts.Ville, concerts.Date FROM concerts WHERE Date >= NOW() ORDER BY Date DESC";
    $stmt = $conn->prepare($SQL);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getPassedConcerts(PDO $conn){
    $SQL="SELECT  concerts.IdConcert, concerts.Ville, concerts.Date FROM concerts WHERE Date <= NOW() ORDER BY Date DESC";
    $stmt = $conn->prepare($SQL);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * @throws DateMalformedStringException
 */
function formatDate($date){
    $dateObj = new DateTime($date);

    $mois = [
        '01' => 'janvier', '02' => 'février', '03' => 'mars',
        '04' => 'avril', '05' => 'mai', '06' => 'juin',
        '07' => 'juillet', '08' => 'août', '09' => 'septembre',
        '10' => 'octobre', '11' => 'novembre', '12' => 'décembre'
    ];

    $jour = $dateObj->format('d');
    $moisTexte = $mois[$dateObj->format('m')];
    $annee = $dateObj->format('Y');

    return "$jour $moisTexte $annee";
}

?>
