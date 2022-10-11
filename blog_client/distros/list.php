<style><?php include 'style.css'; ?></style>

<h1>Distribuciones Unix-like</h1><br>

<table>
<tr>
<td class="table-top">ID</td>
<td class="table-top">Nombre</td>
<td class="table-top">Entorno de escitorio</td>
<td class="table-top">Sistema de init</td>
<td class="table-top">Gestor de paquetes</td>
<td class="table-top">Familia</td>
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
    <td class="table-id"><?=$distro_data->ID_DISTRO?></td>
    <td><?=$distro_data->NOM_DISTRO ?></td>
    <td><?=$distro_data->DE_DISTRO ?></td>
    <td><?=$distro_data->INIT_DISTRO ?></td>
    <td><?=$distro_data->PACK_DISTRO ?></td>
    <td><?=$distro_data->NOM_FAMILIA ?></td>
    <td class="table-edit">
        <a href="/distros/edit.php?id=<?=$distro_data->ID_DISTRO?>"<button>Editar</button></a>
        <a href="/distros/delete.php?id=<?=$distro_data->ID_DISTRO?>"<button>Eliminar</button></a>
    </td>
</tr>

<?php
}
?>
</table>
<a href="/distros/new.php">Insertar nueva distribución</a>

