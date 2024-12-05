<?php
include('../Conexion/conexion.php');

// Manejo de creación y edición de usuarios
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['userId'];
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];
    $rol = $_POST['rol'];
    $especialidad = $_POST['especialidad'];
    $estado = isset($_POST['estado']) ? 1 : 0;

    if ($id) {
        // Editar usuario existente
        $sql = "UPDATE t_usuarios SET Nombres='$nombres', Apellidos='$apellidos', Correo='$correo', Clave='$clave', Rol='$rol', Especialidad='$especialidad', Estado_Usuario='$estado' WHERE Id_usuario='$id'";
    } else {
        // Crear nuevo usuario
        $sql = "INSERT INTO t_usuarios (Nombres, Apellidos, Correo, Clave, Rol, Especialidad, Estado_Usuario) VALUES ('$nombres', '$apellidos', '$correo', '$clave', '$rol', '$especialidad', '$estado')";
    }

    if ($conexion->query($sql) === TRUE) {
        echo "Usuario guardado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }
}

// Manejo de eliminación de usuarios
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM t_usuarios WHERE Id_usuario='$id'";
    if ($conexion->query($sql) === TRUE) {
        echo "Usuario eliminado correctamente";
    } else {
        echo "Error al eliminar usuario: " . $conexion->error;
    }
}

// Obtener usuarios
$sql = "SELECT * FROM t_usuarios";
$result = $conexion->query($sql);
$usuarios = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="path/to/style.css">
    <style>
    body {
        margin-top: 30px;
        width: 100%;
        margin: 20px auto;
        max-width: 1200px;
        padding: 20px;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow-x: auto;
        font-family: Arial, sans-serif; /* Mejora la tipografía */
    }
    footer {
            text-align: center;
            padding: 10px;
            margin-top: 30px;
            background-color: #007832;
            color: #fff;
            border-radius: 5px;
        }
    
    table.dataTable thead {
        background-color: #66CC99;
        color: #2d572c;
        font-weight: bold;
    }
    
    table.dataTable tbody tr {
        background-color: #f9f9f9;
    }
    
    table.dataTable tbody tr:nth-child(even) {
        background-color: #e0f2e9;
    }
    
    table.dataTable tbody tr:hover {
        background-color: #c8e6c9;
    }
    
    table.dataTable td {
        color: #000; /* Cambiar color de texto a negro */
    }
    
    .btn-edit, .btn-delete {
        cursor: pointer;
        padding: 8px 12px;
        border-radius: 4px;
        border: none;
        color: #ffffff;
        font-weight: bold;
    }
   
       
        h1 {
            color: #2d572c;
            margin-bottom: 20px;
        }

        #searchForm {
            margin-bottom: 20px;
        }

        #searchForm input[type="text"] {
            padding: 10px;
            width: calc(100% - 22px);
            border: 1px solid #66CC99;
            border-radius: 4px;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table thead {
            background-color: #66CC99;
            color: #ffffff;
        }

        table thead th {
            padding: 10px;
            text-align: left;
        }

        table tbody tr:nth-child(even) {
            background-color: #e0f2e9;
        }

        table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #c8e6c9;
        }

        table tbody td {
            padding: 10px;
        }

        table tbody td a {
            color: #66CC99;
            text-decoration: none;
        }

        table tbody td a:hover {
            text-decoration: underline;
        }
    
    
    .btn-edit {
        background-color: #66CC99;
    }
    
    .btn-delete {
        background-color: #d9534f;
    }
    
    #userForm {
        margin-top: 20px;
        padding: 20px;
        border: 1px solid #66CC99;
        border-radius: 8px;
        background-color: #f5f5f5; /* Fondo más claro para el formulario */
    }
    
    #userForm h2 {
        color: #2d572c;
    }
    
    #userForm label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }
    
    #userForm input[type="text"], 
    #userForm input[type="email"], 
    #userForm input[type="password"], 
    #userForm select {
        width: calc(100% - 22px); /* Ajusta el ancho para padding y borde */
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #66CC99;
        border-radius: 4px;
        box-sizing: border-box; /* Incluye padding y border en el ancho */
    }
    
    #userForm input[type="checkbox"] {
        margin-right: 10px;
    }
    
    #userForm button {
        background-color: #66CC99;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        font-weight: bold;
    }
    
    #userForm button:hover {
        background-color: #4CAF50; /* Color verde más oscuro al pasar el ratón */
    }
</style>

</head>
<body>
    <?php include '../Menu/menu.php'; ?>

    <h1>Gestión de Usuarios</h1>

    <table id="usuarios" class="display">
        <thead>
            <tr>
                <th>Nombres</th>
                <th>Apellidos</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Especialidad</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= $usuario['Nombres'] ?></td>
                    <td><?= $usuario['Apellidos'] ?></td>
                    <td><?= $usuario['Correo'] ?></td>
                    <td><?= $usuario['Rol'] ?></td>
                    <td><?= $usuario['Especialidad'] ?></td>
                    <td><?= $usuario['Estado_Usuario'] ? 'Activo' : 'Inactivo' ?></td>
                    <td>
                        <a href="index.php?edit=<?= $usuario['Id_usuario'] ?>">Editar</a> | 
                        <a href="index.php?delete=<?= $usuario['Id_usuario'] ?>" onclick="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    $editUser = null;
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
        $result = $conexion->query("SELECT * FROM t_usuarios WHERE Id_usuario='$id'");
        $editUser = $result->fetch_assoc();
    }
    ?>

    <div id="userForm">
        <h2><?= $editUser ? 'Editar Usuario' : 'Crear Usuario' ?></h2>
        <form method="POST" action="index.php">
            <input type="hidden" id="userId" name="userId" value="<?= $editUser['Id_usuario'] ?? '' ?>">
            <label for="nombres">Nombres:</label>
            <input type="text" id="nombres" name="nombres" value="<?= $editUser['Nombres'] ?? '' ?>" required>
            <br>
            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" value="<?= $editUser['Apellidos'] ?? '' ?>" required>
            <br>
            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?= $editUser['Correo'] ?? '' ?>" required>
            <br>
            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" value="<?= $editUser['Clave'] ?? '' ?>" required>
            <br>
            <label for="rol">Rol:</label>
            <select id="rol" name="rol" required>
                <option value="Administrador" <?= isset($editUser) && $editUser['Rol'] == 'Administrador' ? 'selected' : '' ?>>Administrador</option>
                <option value="Instructor" <?= isset($editUser) && $editUser['Rol'] == 'Instructor' ? 'selected' : '' ?>>Instructor</option>
                <option value="Encargado" <?= isset($editUser) && $editUser['Rol'] == 'Encargado' ? 'selected' : '' ?>>Encargado</option>
            </select>
            <br>
            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" value="<?= $editUser['Especialidad'] ?? '' ?>" required>
            <br>
            <label for="estado">Activo:</label>
            <input type="checkbox" id="estado" name="estado" <?= $editUser && $editUser['Estado_Usuario'] ? 'checked' : '' ?>>
            <br>
            <button type="submit"><?= $editUser ? 'Guardar Cambios' : 'Crear Usuario' ?></button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usuarios').DataTable();

            <?php if (isset($_GET['edit'])): ?>
                $('#userForm').show();
            <?php endif; ?>
        });
    </script>
    <footer>
        Si tiene algún problema, escriba a este correo sena@problemas.com
    </footer>
</body>
</html>
