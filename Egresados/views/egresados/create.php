<?php
// Incluir el archivo que contiene la clase Database
require_once '../../config/database.php'; // Ajusta la ruta según la ubicación real del archivo

// Crear una instancia de la clase Database
$database = new Database();
$db = $database->getConnection();

// Consultar los programas de formación para el dropdown
$queryProgramas = "SELECT id, NombrePrograma FROM programaformacionsena";
$resultProgramas = $db->query($queryProgramas);

// Consultar los lugares de residencia para el dropdown
$queryLugares = "SELECT ID, Ciudad FROM lugarresidencia";
$resultLugares = $db->query($queryLugares);

// Procesar el formulario si se ha enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger datos del formulario
    $mes = $_POST['MES'];
    $nombres = $_POST['NOMBRES'];
    $tipoDocumento = $_POST['TipoDocumentoID'];
    $numeroDocumento = $_POST['NumeroDocumento'];
    $lugarResidenciaID = $_POST['LugarResidenciaID'];
    $direccionResidencia = $_POST['DireccionResidencia'];
    $correoElectronico = $_POST['CorreoElectronico'];
    $telefonoCelular = $_POST['TelefonoCelular'];
    $ocupacionActual = $_POST['OcupacionActual'];
    $vinculacionPatrocinio = $_POST['VinculacionPatrocinio'];
    $centroFormacion = $_POST['CentroFormacion'];
    $ficha = $_POST['Ficha'];
    $fechaCertificacion = $_POST['FechaCertificacion'];
    $estudiosAdicionales = $_POST['EstudiosAdicionales'];
    $fechaUltimaLlamada = $_POST['FechaUltimaLlamada'];
    $numeroFijo = $_POST['NumeroFijo'];
    $genero = $_POST['Genero'];
    $otroTelefonoContacto = $_POST['OtroTelefonoContacto'];
    $programaFormacionID = $_POST['ProgramaFormacionSENAID'];

    // Preparar la consulta SQL para insertar datos
    $query = "
        INSERT INTO egresados (MES, NOMBRES, TipoDocumentoID, NumeroDocumento, LugarResidenciaID, DireccionResidencia, 
        CorreoElectronico, TelefonoCelular, OcupacionActual, VinculacionPatrocinio, CentroFormacion, Ficha, 
        FechaCertificacion, EstudiosAdicionales, FechaUltimaLlamada, NumeroFijo, Genero, OtroTelefonoContacto, ProgramaFormacionSENAID) 
        VALUES (:mes, :nombres, :tipoDocumento, :numeroDocumento, :lugarResidenciaID, :direccionResidencia, :correoElectronico, 
        :telefonoCelular, :ocupacionActual, :vinculacionPatrocinio, :centroFormacion, :ficha, :fechaCertificacion, 
        :estudiosAdicionales, :fechaUltimaLlamada, :numeroFijo, :genero, :otroTelefonoContacto, :programaFormacionID)";

    // Preparar y ejecutar la consulta
    $stmt = $db->prepare($query);
    $stmt->bindParam(':mes', $mes);
    $stmt->bindParam(':nombres', $nombres);
    $stmt->bindParam(':tipoDocumento', $tipoDocumento);
    $stmt->bindParam(':numeroDocumento', $numeroDocumento);
    $stmt->bindParam(':lugarResidenciaID', $lugarResidenciaID);
    $stmt->bindParam(':direccionResidencia', $direccionResidencia);
    $stmt->bindParam(':correoElectronico', $correoElectronico);
    $stmt->bindParam(':telefonoCelular', $telefonoCelular);
    $stmt->bindParam(':ocupacionActual', $ocupacionActual);
    $stmt->bindParam(':vinculacionPatrocinio', $vinculacionPatrocinio);
    $stmt->bindParam(':centroFormacion', $centroFormacion);
    $stmt->bindParam(':ficha', $ficha);
    $stmt->bindParam(':fechaCertificacion', $fechaCertificacion);
    $stmt->bindParam(':estudiosAdicionales', $estudiosAdicionales);
    $stmt->bindParam(':fechaUltimaLlamada', $fechaUltimaLlamada);
    $stmt->bindParam(':numeroFijo', $numeroFijo);
    $stmt->bindParam(':genero', $genero);
    $stmt->bindParam(':otroTelefonoContacto', $otroTelefonoContacto);
    $stmt->bindParam(':programaFormacionID', $programaFormacionID);

    if ($stmt->execute()) {
        echo "<p>Egresado agregado correctamente.</p>";
    } else {
        echo "<p>Error al agregar el egresado.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Egresado</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            margin: 20px auto;
            max-width: 1200px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
        }
        input[type="text"], input[type="email"], input[type="date"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #6a1b29; /* Color morado oscuro */
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #9e2a39; /* Color morado más claro */
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
    </style>
</head>
<body>
<?php include '../../../Menu/Menu/menu.php'; ?>

    <div class="container">
        <header class="header">
            <h1>Agregar Nuevo Egresado</h1>
        </header>
        <form action="create.php" method="post">
            <label for="MES">Mes:</label>
            <input type="text" id="MES" name="MES" required>

            <label for="NOMBRES">Nombres:</label>
            <input type="text" id="NOMBRES" name="NOMBRES" required>

            <label for="TipoDocumentoID">Tipo de Documento:</label>
            <select id="TipoDocumentoID" name="TipoDocumentoID" required>
                <option value="CC">Cédula</option>
                <option value="TI">Tarjeta de Identidad</option>
                <option value="PASAPORTE">Pasaporte</option>
            </select>

            <label for="NumeroDocumento">Número de Documento:</label>
            <input type="text" id="NumeroDocumento" name="NumeroDocumento" required>

            <label for="LugarResidenciaID">Lugar de Residencia:</label>
            <select id="LugarResidenciaID" name="LugarResidenciaID" required>
                <?php while ($lugar = $resultLugares->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo htmlspecialchars($lugar['ID']); ?>">
                        <?php echo htmlspecialchars($lugar['Ciudad']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <label for="DireccionResidencia">Dirección de Residencia:</label>
            <input type="text" id="DireccionResidencia" name="DireccionResidencia">

            <label for="CorreoElectronico">Correo Electrónico:</label>
            <input type="email" id="CorreoElectronico" name="CorreoElectronico">

            <label for="TelefonoCelular">Teléfono Celular:</label>
            <input type="text" id="TelefonoCelular" name="TelefonoCelular">

            <label for="OcupacionActual">Ocupación Actual:</label>
            <select id="OcupacionActual" name="OcupacionActual">
                <option value="Trabaja">Trabaja</option>
                <option value="Estudia">Estudia</option>
                <option value="Otro">Otro</option>
            </select>

            <label for="VinculacionPatrocinio">Vinculación Patrocinio:</label>
            <select id="VinculacionPatrocinio" name="VinculacionPatrocinio">
                <option value="Si">Sí</option>
                <option value="No">No</option>
            </select>

            <label for="CentroFormacion">Centro de Formación:</label>
            <input type="text" id="CentroFormacion" name="CentroFormacion">

            <label for="Ficha">Ficha:</label>
            <input type="text" id="Ficha" name="Ficha">

            <label for="FechaCertificacion">Fecha de Certificación:</label>
            <input type="date" id="FechaCertificacion" name="FechaCertificacion">

            <label for="EstudiosAdicionales">Estudios Adicionales:</label>
            <input type="text" id="EstudiosAdicionales" name="EstudiosAdicionales">

            <label for="FechaUltimaLlamada">Fecha Última Llamada:</label>
            <input type="date" id="FechaUltimaLlamada" name="FechaUltimaLlamada">

            <label for="NumeroFijo">Número Fijo:</label>
            <input type="text" id="NumeroFijo" name="NumeroFijo">

            <label for="Genero">Género:</label>
            <select id="Genero" name="Genero">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
                <option value="Otro">Otro</option>
            </select>

            <label for="OtroTelefonoContacto">Otro Teléfono de Contacto:</label>
            <input type="text" id="OtroTelefonoContacto" name="OtroTelefonoContacto">

            <label for="ProgramaFormacionSENAID">Programa de Formación SENA:</label>
            <select id="ProgramaFormacionSENAID" name="ProgramaFormacionSENAID" required>
                <?php while ($programa = $resultProgramas->fetch(PDO::FETCH_ASSOC)): ?>
                    <option value="<?php echo htmlspecialchars($programa['id']); ?>">
                        <?php echo htmlspecialchars($programa['NombrePrograma']); ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <button type="submit">Guardar</button>
        </form>
    </div>
</body>
</html>
