<?php
$url = $_SERVER['REQUEST_URI'];
if(strpos($url,"/") !== 0){
    $url = "/$url";
}

$dbInstance = new DB();
$dbConn = $dbInstance->connect($db);

header("Content-Type:application/json");
error_log("URL: " . $url);
error_log("METHOD: " . $_SERVER['REQUEST_METHOD']);

/**
 * Get all distros
**/
if($url == '/list' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    error_log("List distros");
    $posts = getAllDistros($dbConn);
    echo json_encode($posts);
}

function getAllDistros($db) {
    $statement = $db->prepare("
        SELECT * FROM DISTRO INNER JOIN FAMILIA ON DISTRO.ID_FAMILIA=FAMILIA.ID_FAMILIA");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    return $statement->fetchAll();
}

/**
 * Get specific distro
**/


if(preg_match("/list\/([0-9]+)/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    error_log("List specific distro");
    $id = $matches[1];
    $posts = getDistro($dbConn, $id);
    echo json_encode($posts);
}


function getDistro($db, $id) {
    $statement = $db->prepare("
        SELECT * FROM DISTRO INNER JOIN FAMILIA ON DISTRO.ID_FAMILIA=FAMILIA.ID_FAMILIA
         WHERE DISTRO.ID_DISTRO=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

/**
 * Get familias
**/
if($url == '/listparent' && $_SERVER['REQUEST_METHOD'] == 'GET') {
    error_log("List familias");
    $posts = getAllParents($dbConn);
    echo json_encode($posts);
}

function getAllParents($db) {
    $statement = $db->prepare("
        SELECT * FROM FAMILIA");
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);

    return $statement->fetchAll();
}

/**
 * Get familia
**/
if(preg_match("/listparent\/([0-9]+)/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    error_log("List familia");
    $id = $matches[1];
    $posts = getParent($dbConn, $id);
    echo json_encode($posts);
}

function getParent($db, $id) {
    $statement = $db->prepare("
        SELECT * FROM FAMILIA WHERE ID_FAMILIA=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}