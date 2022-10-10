<h1>Delete User</h1><br>
<?php
require_once "../config.php";

$id = $_GET["id"];
$apiUrl = $webServer . '/delete/' . $id;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($ch);

curl_close ($ch);

$result = json_decode($server_output);

    echo "User $id has been deleted";

?>
<br><a href = "/">Back</a>
