<style><?php include 'style.css'; ?></style>
<?php
require_once "../config.php";

$id = $_GET["id"];
$apiUrl = $webServer . '/listparent/' . $id;

$curl = curl_init($apiUrl);
curl_setopt($curl, CURLOPT_ENCODING ,"");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($curl);
$post = json_decode($json);
curl_close($curl);
?>

<form>
    <label for="ID_FAMILIA">ID:</label>
    <input type="text" id="ID_FAMILIA" name="ID_FAMILIA" value="<?=$post->ID_FAMILIA?>" disabled>
    <br>
    <label for="NOM_FAMILIA">Nombre:</label>
    <input type="text" id="NOM_FAMILIA" name="NOM_FAMILIA" value="<?=$post->NOM_FAMILIA?>" disabled>
</form>
<br>
