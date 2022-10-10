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
 *  Create parent distro
**/

if($url == '/post/parent' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("Create parent distro");
    $distroname = $_POST["distroname"];
    error_log($_POST["distroname"]);

    $post = addParent($distroname, $dbConn);

    echo json_encode($post);
}

function addParent($distroname, $db){

    $MAX_ID = $db->query("SELECT MAX(ID_FAMILIA) FROM UNIX.FAMILIA;");
    foreach($MAX_ID as $row) {  //NO tengo NI IDEA de por que tengo que hacer esto
        $MAX_ID = $row['0']; //Pero PHP es insufrible, y no quiero perder mas tiempo haciendo esto
    }
    $MAX_ID = ++$MAX_ID;
    error_log($MAX_ID);
    $statement = $db->prepare("
        INSERT INTO UNIX.FAMILIA (ID_FAMILIA,NOM_FAMILIA)
        VALUES (:id,:distroname)");
    $statement->bindValue(':id', strval($MAX_ID));
    $statement->bindValue(':distroname', $distroname);
    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}


/**
**  Create distro
**/

if($url == '/post/distro' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    error_log("Create distro");
    $distro_values[0] = $_POST["distroname"];
    $distro_values[1] = $_POST["de"];
    $distro_values[2] = $_POST["init"];
    $distro_values[3] = $_POST["manager"];
    $distro_values[4] = $_POST["family"];
    $i = 0; //Todo esto es para poder incluir L4S o distribuciones de el estilo
    while($i <= 4) {
        if("" == trim($distro_values[$i])){//Si esta vacio, N/A
            $distro_values[$i] = "N/A";
        }
        error_log($distro_values[$i]);
        $i = ++$i;
    }
    if($distro_values[4] == "N/A"){ //Si "familia" == N/A, cambiar a 6, es decir, la distro padre es N/A
        $distro_values[4] = 6;
    }

    $post = addDistro($distro_values, $dbConn);

    echo json_encode($post);
}

function addDistro($distro_values, $db){
    $statement = $db->prepare("
        INSERT INTO UNIX.DISTRO (NOM_DISTRO,DE_DISTRO,INIT_DISTRO,PACK_DISTRO,ID_FAMILIA)
	VALUES (:distroname,:de,:init,:manager,:family)");

    $statement->bindValue(':distroname', $distro_values[0]); //podria hacer esto con un while pero...
    $statement->bindValue(':de', $distro_values[1]);
    $statement->bindValue(':init', $distro_values[2]);
    $statement->bindValue(':manager', $distro_values[3]);
    $statement->bindValue(':family', $distro_values[4]);

    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}


/**
**  Editar distro
**/

if(preg_match("/post\/([0-9]+)/", $url, $matches) && $_SERVER['REQUEST_METHOD'] == 'PUT'){
    error_log("Modify distro");
    $id = $matches[1];
    error_log($id);
    $url_components = parse_url($url);
    parse_str($url_components['query'], $params);
    $distro_values[0] = $params["distroname"];
    $distro_values[1] = $params["de"];
    $distro_values[2] = $params["init"];
    $distro_values[3] = $params["manager"];
    $distro_values[4] = $params["family"];
    $i = 0; //Todo esto es para poder incluir L4S o distribuciones de el estilo
    while($i <= 4) {
        if("" == trim($distro_values[$i])){//Si esta vacio, N/A
            $distro_values[$i] = "N/A";
        }
        error_log($distro_values[$i]);
        $i = ++$i;
    }
    if($distro_values[4] == "N/A"){ //Si "familia" == N/A, cambiar a 6, es decir, la distro padre es N/A
        $distro_values[4] = 6;
    }


    $post = EditarDistro($distro_values, $id, $dbConn);

    echo json_encode($post);
}

function EditarDistro($distro_values, $id, $db){
    $statement = $db->prepare("
        UPDATE UNIX.DISTRO
	SET PACK_DISTRO=:manager,ID_FAMILIA=:family,NOM_DISTRO=:distroname,DE_DISTRO=:de,INIT_DISTRO=:init
	WHERE ID_DISTRO=:id;");

    $statement->bindValue(':id', $id);
    $statement->bindValue(':distroname', $distro_values[0]); //podria hacer esto con un while pero...
    $statement->bindValue(':de', $distro_values[1]);
    $statement->bindValue(':init', $distro_values[2]);
    $statement->bindValue(':manager', $distro_values[3]);
    $statement->bindValue(':family', $distro_values[4]);

    $statement->execute();
    $statement->setFetchMode(PDO::FETCH_ASSOC);
    return $statement->fetchAll();
}
