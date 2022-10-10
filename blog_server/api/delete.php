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
 ** Eliminar distro, AKA rm -rf /* --no-preserve-root
 **/

if(preg_match("/delete\/([0-9]+)/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'DELETE'){
    error_log("Eliminar distro específica");
    $id = $matches[1];
    $posts = rmDistro($dbConn, $id);
    echo json_encode($posts);
}


function rmDistro($db, $id) {
    $statement = $db->prepare("
        DELETE FROM UNIX.DISTRO
        WHERE ID_DISTRO=:id");
    $statement->bindValue(':id', $id);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}
