<?php
require_once "../config.php";

$userId = isset($_GET['user_id'])?$_GET['user_id']:null;
$title = "New Post";
if ($userId != null) {
    $title .= " for user " . $userId;
}
?>
<h1><?=$title?></h1><br>
<?php

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $apiUrl = $webServer . '/posts';

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $apiUrl);
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, 
          http_build_query($_POST));

	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);

	curl_close ($ch);
    
	$post = json_decode($server_output);
    $_GET["id"] = $post->id;

	include("detail.php");
} else {
	$apiUrl = $webServer . '/users';
	$curl = curl_init($apiUrl);
	curl_setopt($curl, CURLOPT_ENCODING ,"");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$json = curl_exec($curl);
	$users = json_decode($json);
	curl_close($curl);
?>

<form method="post" >
<label for="title">Title:</label>
<input type="text" id="title" name="title">
<br>
<label for="status">Status:</label>
<select name="status" id="status">
	<option value="draft">Draft</option>
	<option value="published">Published</option>
</select>
<br>
<label for="user_id">User:</label>
<?php
if ($userId == null){
?>
	<select name="user_id" id="user_id">
<?php
}else{
?>
	<input type="hidden" name="user_id" value="<?=$userId?>">
	<select name="user_id" id="user_id" disabled>
<?php
}
foreach ($users as $user) {
	$selected = $userId==$user->id?"selected":"";
	echo "<option value=$user->id $selected>$user->name</option>";
}
?>
</select>
<br>
<label for="content">Content:</label>
<input type="text" id="content" name="content">
<br>
<input type="submit" value="Save">
</form>
<?php
}
?>
<br><a href = "/">Back</a>

