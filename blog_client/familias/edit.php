<h1>Editar Post</h1><br>
<?php
require_once "../config.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_GET['id'];
    $apiUrl = $webServer . '/familias/' . $id;

    $params = array("content"   => $_POST['content'],
                    "title"     => $_POST['title'],
                    "status"    => $_POST['status'],
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

	include("detail.php");
} else {
    $id = $_GET["id"];
    $apiUrl = $webServer . '/familias/' . $id;
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_ENCODING ,"");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    $post = json_decode($json);
    curl_close($curl);

    $apiUrl = $webServer . '/users';
    $curl = curl_init($apiUrl);
    curl_setopt($curl, CURLOPT_ENCODING ,"");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($curl);
    $users = json_decode($json);
    curl_close($curl);

?>

<form method="post" >
    <label for="id">Id:</label>
    <input type="text" id="id" name="id" value="<?=$post->id?>" disabled>
    <br>
    <label for="title">Title:</label>
    <input type="text" id="title" name="title" value="<?=$post->title?>">
    <br>
    <label for="status">Status:</label>
    <select name="status" id="status">
        <option value="draft" <?=$post->status=="draft"?"selected":""?>>Draft</option>
        <option value="published" <?=$post->status=="published"?"selected":""?>>Published</option>
    </select>
    <br>
    <label for="user_id">User:</label>
    <select name="user_id" id="user_id">
<?php
    foreach ($users as $user) {
        $selected = $post->user_id==$user->id?"selected":"";
        echo "<option value=$user->id $selected>$user->name</option>";
    }
?>
    </select>
    <br>
    <label for="content">Content:</label>
    <input type="text" id="content" name="content" value="<?=$post->content?>">
    <br>
    <input type="submit" value="Save">
</form>

<?php
}
?>
<br><a href = "/">Back</a>

