<?php
include '../Menu/menu.php';
require_once 'config/database.php'; // Ajusta la ruta según la ubicación real del archivo

// Crear una instancia de la clase Database
$database = new Database();
$db = $database->getConnection();

// Obtener y mostrar el historial
$query = "
    SELECT 
        h.*, 
        lr.Ciudad AS CiudadResidencia, 
        ps.NombrePrograma AS NombreProgramaFormacion 
    FROM 
        historial h
    LEFT JOIN 
        lugarresidencia lr ON h.LugarResidenciaID = lr.ID
    LEFT JOIN 
        programaformacionsena ps ON h.ProgramaFormacionSENAID = ps.ID
    ORDER BY 
        h.FechaRegistro DESC
";

// Ejecutar la consulta y manejar errores
try {
    $result = $db->query($query);
    if (!$result) {
        throw new Exception("Error en la consulta SQL: " . implode(", ", $db->errorInfo()));
    }
} catch (Exception $e) {
    die("Error al obtener el historial: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Egresados</title>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            margin: 2px auto;
            max-width: 1200px;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            overflow-x: auto;
        }
        .header h1 {
            color: #2d572c;
            margin-bottom: 20px;
        }
        .datetime {
            font-size: 18px;
            color: #333;
            background-color: #e0f2f1;
            border-radius: 5px;
            padding: 10px;
            margin: 10px 0;
            display: inline-block;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .datetime div {
            margin: 5px 0;
        }
        table.dataTable thead {
            background-color: #66CC99;
            color: #ffffff;
        }
        table.dataTable tbody tr:nth-child(even) {
            background-color: #e0f2e9;
        }
        table.dataTable tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
        table.dataTable tbody tr:hover {
            background-color: #c8e6c9;
        }
        table.dataTable td {
            color: #000;
        }
        footer {
            text-align: center;
            padding: 10px;
            margin-top: 30px;
            background-color: #007832;
            color: #fff;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <?php include '../Menu/menu.php'; ?>

    <div class="container">
        <h1>Historial de Egresados</h1>
        <button id="guardarHistorial" onclick="guardarHistorial()">Guardar Historial</button>
        <section>
            <table id="historialTable" class="display">
                <thead>
                    <tr>
                        <th>Fecha Registro</th>
                        <th>MES</th>
                        <th>Nombres</th>
                        <th>Tipo Documento</th>
                        <th>Numero Documento</th>
                        <th>Lugar Residencia</th>
                        <th>Direccion Residencia</th>
                        <th>Correo Electronico</th>
                        <th>Telefono Celular</th>
                        <th>Ocupacion Actual</th>
                        <th>Vinculacion Patrocinio</th>
                        <th>Centro Formacion</th>
                        <th>Ficha</th>
                        <th>Fecha Certificacion</th>
                        <th>Estudios Adicionales</th>
                        <th>Fecha Ultima Llamada</th>
                        <th>Numero Fijo</th>
                        <th>Genero</th>
                        <th>Otro Telefono Contacto</th>
                        <th>Programa Formacion SENA</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->rowCount() > 0): ?>
                        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['FechaRegistro']); ?></td>
                                <td><?php echo htmlspecialchars($row['MES']); ?></td>
                                <td><?php echo htmlspecialchars($row['NOMBRES']); ?></td>
                                <td><?php echo htmlspecialchars($row['TipoDocumentoID']); ?></td>
                                <td><?php echo htmlspecialchars($row['NumeroDocumento']); ?></td>
                                <td><?php echo htmlspecialchars($row['CiudadResidencia']); ?></td>
                                <td><?php echo htmlspecialchars($row['DireccionResidencia']); ?></td>
                                <td><?php echo htmlspecialchars($row['CorreoElectronico']); ?></td>
                                <td><?php echo htmlspecialchars($row['TelefonoCelular']); ?></td>
                                <td><?php echo htmlspecialchars($row['OcupacionActual']); ?></td>
                                <td><?php echo htmlspecialchars($row['VinculacionPatrocinio']); ?></td>
                                <td><?php echo htmlspecialchars($row['CentroFormacion']); ?></td>
                                <td><?php echo htmlspecialchars($row['Ficha']); ?></td>
                                <td><?php echo htmlspecialchars($row['FechaCertificacion']); ?></td>
                                <td><?php echo htmlspecialchars($row['EstudiosAdicionales']); ?></td>
                                <td><?php echo htmlspecialchars($row['FechaUltimaLlamada']); ?></td>
                                <td><?php echo htmlspecialchars($row['NumeroFijo']); ?></td>
                                <td><?php echo htmlspecialchars($row['Genero']); ?></td>
                                <td><?php echo htmlspecialchars($row['OtroTelefonoContacto']); ?></td>
                                <td><?php echo htmlspecialchars($row['NombreProgramaFormacion']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="20">No se encontraron registros en el historial.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#historialTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.3/i18n/es-ES.json"
                }
            });
        });

        function guardarHistorial() {
            fetch('guardar_historial.php')
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Historial guardado correctamente');
                        location.reload(); // Recargar la página para ver los datos actualizados
                    } else {
                        alert('Error al guardar el historial: ' + data.message);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Si tiene algún problema, escriba a este correo sena@problemas.com</p>
    </footer>
</body>
</html>
