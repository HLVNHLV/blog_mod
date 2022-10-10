<h1>New Comment</h1><br>
<?php
require_once "../config.php";

$postId = $_GET["post_id"];
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $apiUrl = $webServer . '/comments';

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $apiUrl);
	curl_setopt($ch, CURLOPT_POST, 1);

	curl_setopt($ch, CURLOPT_POSTFIELDS, 
        http_build_query($_POST));

	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);

	curl_close ($ch);
    
	$comment = json_decode($server_output);
    $commentId = $comment->id;

	include("detail.php");
	echo '<br><a href = "/">Back</a>';
} else {
?>

<form method="post" >
<input type="hidden" name="post_id" value="<?=$postId?>">
<label for="post_id">PostId:</label>
<input type="text" id="post_id" value="<?=$postId?>" disabled>
<br>
<label for="comment">Comment:</label>
<input type="text" id="comment" name="comment">
<br>
<label for="user_id">UserId:</label>
<input type="text" id="user_id" name="user_id">
<br>
<input type="submit" value="Save">
</form>
<br><a href = "/">Back</a>

<?php
}
?>
