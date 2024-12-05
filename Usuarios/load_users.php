<?php
require("../Conexion/conexion.php");

$result = $conexion->query("SELECT * FROM t_usuarios");
$users = array();

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>