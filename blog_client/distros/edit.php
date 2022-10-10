<h1>Editar distribución</h1><br>
<?php
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_GET['id'];
    $apiUrl = $webServer . '/post/' . $id;
    $params = array("distroname"   => $_POST['NOM_DISTRO'],
                    "de"     => $_POST['DE_DISTRO'],
                    "init"   =>  $_POST['INIT_DISTRO'],
                    "manager"   =>  $_POST['PACK_DISTRO'],
                    "family"   =>  $_POST['ID_FAMILIA']);
    $apiUrl .= "?" . http_build_query($params);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);

	curl_close ($ch);
    
	$result = json_decode($server_output);

	include("detail.php");
} else {
    $id = $_GET["id"];
    $apiUrl = $webServer . '/list/' . $id;
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_ENCODING ,"");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    $user = json_decode($json);
    curl_close($curl);
?>

<form method="post" >
    <label for="ID_DISTRO">ID distro:</label>
    <input type="text" id="ID_DISTRO" name="ID_DISTRO" value="<?=$user->ID_DISTRO?>" disabled>
    <br>
    <label for="NOM_DISTRO">Nombre:</label>
    <input type="text" id="NOM_DISTRO" name="NOM_DISTRO" value="<?=$user->NOM_DISTRO?>">
    <br>
    <label for="DE_DISTRO">Entorno de escritorio:</label>
    <input type="text" id="DE_DISTRO" name="DE_DISTRO" value="<?=$user->DE_DISTRO?>">
    <br>
    <label for="INIT_DISTRO">Init:</label>
    <input type="text" id="INIT_DISTRO" name="INIT_DISTRO" value="<?=$user->INIT_DISTRO?>">
    <br>
    <label for="PACK_DISTRO">Gestor de paquetes:</label>
    <input type="text" id="PACK_DISTRO" name="PACK_DISTRO" value="<?=$user->PACK_DISTRO?>">
    <br>
    <label for="ID_FAMILIA">ID familia:</label>
    <input type="text" id="ID_FAMILIA" name="ID_FAMILIA" value="<?=$user->ID_FAMILIA?>">
    <br>
    <input type="submit" value="Save">
</form>

<?php
}
?>
<br><a href = "/">Back</a>

