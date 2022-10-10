<h1>Eliminar Post</h1><br>
<?php
require_once "../config.php";

$id = $_GET["id"];
$apiUrl = $webServer . '/familias/' . $id;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "Eliminar");

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

$result = json_decode($server_output);

if ($result->Eliminard == "true") {
    echo "Post $id has been Eliminard";
} else {
    echo "ERROR: Can't Eliminar post $id";
}

?>
<br><a href = "/">Back</a>
