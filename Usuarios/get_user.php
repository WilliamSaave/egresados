<?php
require("../Conexion/conexion.php");

$id = $_GET['id'];
$result = $conexion->query("SELECT * FROM t_usuarios WHERE Id_usuario = $id");
$user = $result->fetch_assoc();

echo json_encode($user);
?>