<table border=1>
<tr>
<td>Id</td>
<td>Comment</td>
<td>User</td>
<td>Actions</td>
</tr>
<?php

$postId = $_GET["id"];
$apiUrl = $webServer . '/familias/' . $postId . "/comments";
$curl = curl_init($apiUrl);
curl_setopt($curl, CURLOPT_ENCODING ,"");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($curl);
$comments = json_decode($json);
curl_close($curl);

foreach ($comments as $comment) {
?>
<tr>
    <td><a href="/comments/view.php?id=<?=$comment->id?>"><?=$comment->id?></a></td>
    <td><?=$comment->comment ?></td>
    <td><?=$comment->user_name ?></td>
    <td>
        <a href="/comments/Editar.php?id=<?=$comment->id?>"<button>Editar</button></a>
        <a href="/comments/Eliminar.php?id=<?=$comment->id?>"<button>Eliminar</button></a>
    </td>
</tr>
<?php
}
?>
</table>
<a href="/comments/new.php?post_id=<?=$postId?>">New Comment</a>

