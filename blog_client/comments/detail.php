<?php
require_once "../config.php";

$apiUrl = $webServer . '/comments/' . $commentId;

$curl = curl_init($apiUrl);
curl_setopt($curl, CURLOPT_ENCODING ,"");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($curl);
$comment = json_decode($json);
curl_close($curl);
?>

<form>
<label for="id">Id:</label>
<input type="text" id="id" name="id" value="<?=$comment->id?>" disabled>
<br>
<label for="comment">Comment:</label>
<input type="text" id="comment" name="comment" value="<?=$comment->comment?>" disabled>
<br>
<label for="user_id">User:</label>
<input type="text" id="user_id" name="user_id" value="<?=$comment->user_name?>" disabled>
<br>
<label for="post_id">PostId:</label>
<input type="text" id="post_id" name="post_id" value="<?=$comment->post_id?>" disabled>
<br>
</form>
<br>
