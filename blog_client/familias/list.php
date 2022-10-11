<style><?php include 'style.css'; ?></style>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/config.php";
$userId = isset($_GET['user_id'])?$_GET['user_id']:null;
$title = "Lista de familias";
if ($userId != null) {
    $title .= " for user " . $userId;
}
?>
<h1><?=$title?></h1><br>

<table>
<td class="table-top">ID</td>
<td class="table-top">Familia</td>
</tr>
<?php

if ($userId == null) {
    $apiUrl = $webServer . '/listparent';
} else {
    $apiUrl = $webServer . '/distros/' . $userId . "/posts";
}

$curl = curl_init($apiUrl);
curl_setopt($curl, CURLOPT_ENCODING ,"");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($curl);
$db_data = json_decode($json);
curl_close($curl);

foreach ($db_data as $distro_data) {
?>
<tr>
    <td class="table-id"><?=$distro_data->ID_FAMILIA?></td>
    <td><?=$distro_data->NOM_FAMILIA ?></td>
    <td class="table-edit">
        <a href="/familias/edit.php?id=<?=$distro_data->ID_FAMILIA?>"<button>Editar</button></a>
        <a href="/familias/delete.php?id=<?=$distro_data->ID_FAMILIA?>"<button>Eliminar</button></a>
    </td>
</tr>
<?php
}
?>
</table>
<a href="/familias/new.php<?=$userId!=null?'?user_id='.$userId:''?>">Insertar nueva familia</a>

