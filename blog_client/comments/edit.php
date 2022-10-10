<h1>Editar Comment</h1><br>
<?php
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_GET['id'];
    $apiUrl = $webServer . '/comments/' . $id;
    $params = array("comment"   => $_POST['comment'],
                    "post_id"     => $_POST['post_id'],
                    "user_id"   =>  $_POST['user_id']);
    $apiUrl .= "?" . http_build_query($params);

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");

	// Receive server response ...
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	$server_output = curl_exec($ch);

	curl_close ($ch);
    
	$result = json_decode($server_output);

	$commentId=$id;
	include("detail.php");
} else {
    $id = $_GET["id"];
    $apiUrl = $webServer . '/comments/' . $id;
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_ENCODING ,"");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    $comment = json_decode($json);
    curl_close($curl);
?>

<form method="post" >
    <label for="id">Id:</label>
    <input type="text" id="id" name "id" value="<?=$comment->id?>" disabled>
    <br>
    <input type="hidden" name ="post_id" value="<?=$comment->post_id?>">
    <label for="post_id">PostId:</label>
    <input type="text" id="post_id" value="<?=$comment->post_id?>" disabled>
    <br>
    <label for="comment">Comment:</label>
    <input type="text" id="comment" name="comment" value="<?=$comment->comment?>">
    <br>
    <label for="user_id">UserId:</label>
    <input type="text" id="user_id" name="user_id" value="<?=$comment->user_id?>">
    <br>
    <input type="submit" value="Save">
</form>

<?php
}
?>
<br><a href = "/">Back</a>

