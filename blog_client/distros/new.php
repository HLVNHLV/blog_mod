<h1>Nueva distro</h1><br>
<?php
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $apiUrl = $webServer . '/post/distro';
    $params = array("distroname"   => $_POST['NOM_DISTRO'],
                    "de"     => $_POST['DE_DISTRO'],
                    "init"   =>  $_POST['INIT_DISTRO'],
                    "manager"   =>  $_POST['PACK_DISTRO'],
                    "family"   =>  $_POST['ID_FAMILIA']);
    $apiUrl .= "?" . http_build_query($params);


	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $apiUrl);
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, 
          http_build_query($_POST));

	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);

	curl_close ($ch);
    
	$user = json_decode($server_output);
    $_GET["id"] = $user->id;

	include("detail.php");
	echo '<br><a href = "/">Back</a>';
} else {
?>

<form method="post" >
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
<br><a href = "/">Back</a>

<?php
}
?>
