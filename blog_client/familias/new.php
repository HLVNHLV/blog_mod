<style><?php include 'style.css'; ?></style>
<?php
require_once "../config.php";

$title = "Nueva familia";
?>
<h1><?=$title?></h1><br>
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $apiUrl = $webServer . '/post/parent';
	$params = array("distroname"    =>  $_POST['distroname']);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $apiUrl);
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, 
          http_build_query($params));

	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);

	curl_close ($ch);
} else {
?>

<form method="post" >
<label for="distroname">Nombre:</label>
<input type="text" id="distroname" name="distroname">
<br>
<input type="submit" value="Guardar">
</form>
<?php
}
?>
<br><a href = "/">Atrás</a>

