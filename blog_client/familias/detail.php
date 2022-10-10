<?php
require_once "../config.php";

$id = $_GET["id"];
$apiUrl = $webServer . '/familias/' . $id;

$curl = curl_init($apiUrl);
curl_setopt($curl, CURLOPT_ENCODING ,"");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($curl);
$post = json_decode($json);
curl_close($curl);
?>

<form>
<label for="id">Id:</label>
<input type="text" id="id" name="id" value="<?=$post->id?>" disabled>
<br>
<label for="title">Title:</label>
<input type="text" id="title" name="title" value="<?=$post->title?>" disabled>
<br>
<label for="status">Status:</label>
<input type="status" id="status" name="status" value="<?=$post->status?>" disabled>
<br>
<label for="user_id">User:</label>
<input type="text" id="user_id" name="user_id" value="<?=$post->user_name?>" disabled>
<br>
<label for="content">Content:</label>
<input type="text" id="content" name="content" value="<?=$post->content?>" disabled>
</form>
<br>
