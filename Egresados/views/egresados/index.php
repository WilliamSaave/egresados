<?php
// Incluir el archivo que contiene la clase Database
require_once '../../config/database.php'; // Ajusta la ruta según la ubicación real del archivo

// Crear una instancia de la clase Database
$database = new Database();
$db = $database->getConnection();

// Verificar si se ha recibido un ID para eliminar
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Preparar y ejecutar la consulta para eliminar el registro
    $query = "DELETE FROM egresados WHERE id = :delete_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':delete_id', $delete_id);

    if ($stmt->execute()) {
        // Redirigir a la misma página después de la eliminación
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error al intentar eliminar el registro.";
    }
}

// Obtener y mostrar la lista de egresados
$query = "
    SELECT 
        e.*, 
        lr.Ciudad AS CiudadResidencia, 
        ps.NombrePrograma AS NombreProgramaFormacion 
    FROM 
        egresados e
    LEFT JOIN 
        lugarresidencia lr ON e.LugarResidenciaID = lr.ID
    LEFT JOIN 
        programaformacionsena ps ON e.ProgramaFormacionSENAID = ps.ID
";
$result = $db->query($query);
?>
<!DOCTYPE html>
<html lang="es">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe de Egresados</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="tablas.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
    
</head>
<body>
<?php include '../../../Menu/Menu/menu.php'; ?>

    <div >
        <header class="header">
            <h1>Informe de Egresados</h1>
            <div class="datetime">
                <?php
                date_default_timezone_set('America/Bogota');
                $fechaActual = date("d/m/Y");
                $horaActual = date("h:i a");
                ?>
                <div>Fecha actual: <?php echo $fechaActual; ?></div>
                <div>Hora actual: <?php echo $horaActual; ?></div>
            </div>
        </header>
        <section>
            <div class="button-row">
                <a href="create.php" class="btn-edit">Agregar Nuevos Egresados</a>
            </div>
            
            <table id="egresadosTable" class="table table-striped table-bordered">
    <thead>
        <tr>
            <!-- Encabezados de la tabla en el nuevo orden -->
            <th>Nombres y Apellidos</th>
            <th>Tipo de Documento</th>
            <th># Documento</th>
            <th>Género</th>
            <th>Lugar de Residencia</th>
            <th>Dirección</th>
            <th># Fijo</th>
            <th># Celular</th>
            <th>Otro # de Contacto</th>
            <th>Correo Electrónico</th>
            <th>Programa de Formación</th>
            <th>Ficha</th>
            <th>Fecha de Certificación</th>
            <th>Centro de Formación</th>
            <th>Código Centro</th>
            <th>Ocupación Actual</th>
            <!-- Columnas adicionales al final -->
            <th>MES</th>
            <th>Vinculación Patrocinio</th>
            <th>Estudios Adicionales</th>
            <th>Fecha Última Llamada</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->rowCount() > 0): ?>
            <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['NOMBRES']); ?></td>
                    <td><?php echo htmlspecialchars($row['TipoDocumentoID']); ?></td>
                    <td><?php echo htmlspecialchars($row['NumeroDocumento']); ?></td>
                    <td><?php echo htmlspecialchars($row['Genero']); ?></td>
                    <td><?php echo htmlspecialchars($row['CiudadResidencia']); ?></td>
                    <td><?php echo htmlspecialchars($row['DireccionResidencia']); ?></td>
                    <td><?php echo htmlspecialchars($row['NumeroFijo']); ?></td>
                    <td><?php echo htmlspecialchars($row['TelefonoCelular']); ?></td>
                    <td><?php echo htmlspecialchars($row['OtroTelefonoContacto']); ?></td>
                    <td><?php echo htmlspecialchars($row['CorreoElectronico']); ?></td>
                    <td><?php echo htmlspecialchars($row['NombreProgramaFormacion']); ?></td>
                    <td><?php echo htmlspecialchars($row['Ficha']); ?></td>
                    <td><?php echo htmlspecialchars($row['FechaCertificacion']); ?></td>
                    <td><?php echo htmlspecialchars($row['CentroFormacion']); ?></td>
                    <td><?php echo htmlspecialchars($row['cod_centro']); ?></td>
                    <td><?php echo htmlspecialchars($row['OcupacionActual']); ?></td>
                    <!-- Columnas adicionales al final -->
                    <td><?php echo htmlspecialchars($row['MES']); ?></td>
                    <td><?php echo htmlspecialchars($row['VinculacionPatrocinio']); ?></td>
                    <td><?php echo htmlspecialchars($row['EstudiosAdicionales']); ?></td>
                    <td><?php echo htmlspecialchars($row['FechaUltimaLlamada']); ?></td>
                    <td class="actions">
                        <?php
                        $url_update = 'update.php?id=' . $row['id'];
                        echo "<a href='" . htmlspecialchars($url_update) . "' class='btn-edit'>Editar</a>";
                        $url_delete = htmlspecialchars($_SERVER["PHP_SELF"]) . "?delete_id=" . $row['id'];
                        echo "<a href='" . $url_delete . "' class='btn-delete' onclick=\"return confirm('¿Estás seguro de que quieres eliminar este registro?');\">Eliminar</a>";
                        ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="21">No hay registros disponibles.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

        </section>
    </div>
    <footer class="footer">
        <p>Todos los derechos reservados</p>
    </footer>

    <script>
        $(document).ready(function() {
            $('#egresadosTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copyHtml5',
                    'csvHtml5',
                    'excelHtml5',
                    'pdfHtml5'
                ],
                language: {
                    decimal: "",
                    emptyTable: "No hay datos disponibles en la tabla",
                    info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                    infoEmpty: "Mostrando 0 a 0 de 0 entradas",
                    infoFiltered: "(filtrado de _MAX_ entradas totales)",
                    lengthMenu: "Mostrar _MENU_ entradas",
                    loadingRecords: "Cargando...",
                    processing: "Procesando...",
                    search: "Buscar:",
                    zeroRecords: "No se encontraron registros coincidentes",
                    paginate: {
                        first: "Primero",
                        last: "Último",
                        next: "Siguiente",
                        previous: "Anterior"
                    },
                    aria: {
                        sortAscending: ": activar para ordenar la columna ascendente",
                        sortDescending: ": activar para ordenar la columna descendente"
                    }
                },
                paging: true,
                pageLength: 10
            });
        });
    </script>
</body>
</html>
