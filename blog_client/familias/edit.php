<style><?php include 'style.css'; ?></style>
<h1>Editar familia</h1><br>
<?php
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_GET['id'];
    $apiUrl = $webServer . '/postparent/' . $id;
    $params = array("parentname"   => $_POST['NOM_FAMILIA']);
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
    $apiUrl = $webServer . '/listparent/' . $id;
    
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_ENCODING ,"");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    $post = json_decode($json);
    curl_close($curl);
?>
    
<form method="POST">
    <label for="ID_FAMILIA">ID:</label>
    <input type="text" id="ID_FAMILIA" name="ID_FAMILIA" value="<?=$post->ID_FAMILIA?>" disabled>
    <br>
    <label for="NOM_FAMILIA">Nombre:</label>
    <input type="text" id="NOM_FAMILIA" name="NOM_FAMILIA" value="<?=$post->NOM_FAMILIA?>">
    <br>
    <input type="submit" value="Save">
</form>
<?php
}
?>
<br><a href = "/">Back</a>

