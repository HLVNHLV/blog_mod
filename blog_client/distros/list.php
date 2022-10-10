<h1>Distribuciones Unix-like</h1><br>

<table border=1>
<tr>
<td>ID</td>
<td>Nombre</td>
<td>Entorno de escitorio</td>
<td>Sistema de init</td>
<td>Gestor de paquetes</td>
<td>Familia</td>
</tr>
<?php

$apiUrl = $webServer . '/list';
$curl = curl_init($apiUrl);
curl_setopt($curl, CURLOPT_ENCODING ,"");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($curl);
$db_data = json_decode($json);
curl_close($curl);

foreach ($db_data as $distro_data) {
?>
<tr>
    <td><a href="/list/<?=$distro_data->ID_DISTRO?>"><?=$distro_data->ID_DISTRO?></a></td>
    <td><?=$distro_data->NOM_DISTRO ?></td>
    <td><?=$distro_data->DE_DISTRO ?></td>
    <td><?=$distro_data->INIT_DISTRO ?></td>
    <td><?=$distro_data->PACK_DISTRO ?></td>
    <td><?=$distro_data->NOM_FAMILIA ?></td>
    <td>
        <a href="/distros/edit.php?id=<?=$distro_data->ID_DISTRO?>"<button>Editar</button></a>
        <!--<a href="/distros/posts.php?user_id=<?=$distro_data->id?>"<button>Posts</button></a>-->
        <a href="/distros/delete.php?id=<?=$distro_data->ID_DISTRO?>"<button>Eliminar</button></a>
    </td>
</tr>

<!--

<tr>
    <td><a href="/distros/view.php?id=<?=$distro_data->id?>"><?=$distro_data->id?></a></td>
    <td><?=$distro_data->name ?></td>
    <td><?=$distro_data->email ?></td>
    <td>
        <a href="/distros/Editar.php?id=<?=$distro_data->id?>"<button>Editar</button></a>
        <a href="/distros/posts.php?user_id=<?=$distro_data->id?>"<button>Posts</button></a>
        <a href="/distros/Eliminar.php?id=<?=$distro_data->id?>"<button>Eliminar</button></a>
    </td>
</tr>

-->

<?php
}
?>
</table>
<a href="/distros/new.php">Insertar nueva distribución</a>

