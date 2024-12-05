<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($db === null) {
    echo "No se pudo conectar a la base de datos.";
    exit();
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Recibir y validar los datos del formulario
        $mes = $_POST['mes'] ?? '';
        $nombres = $_POST['nombres'] ?? '';
        $tipo_documento = $_POST['tipo_documento'] ?? '';
        $numero_documento = $_POST['numero_documento'] ?? '';
        $lugar_residencia = $_POST['lugar_residencia'] ?? '';
        $direccion_residencia = $_POST['direccion_residencia'] ?? '';
        $correo_electronico = $_POST['correo_electronico'] ?? '';
        $telefono_celular = $_POST['telefono_celular'] ?? '';
        $ocupacion_actual = $_POST['ocupacion_actual'] ?? '';
        $vinculacion_patrocinio = $_POST['vinculacion_patrocinio'] ?? '';
        $centro_formacion = $_POST['centro_formacion'] ?? '';
        $ficha = $_POST['ficha'] ?? '';
        $fecha_certificacion = $_POST['fecha_certificacion'] ?? '';
        $estudios_adicionales = $_POST['estudios_adicionales'] ?? '';
        $fecha_ultima_llamada = $_POST['fecha_ultima_llamada'] ?? '';
        $numero_fijo = $_POST['numero_fijo'] ?? '';
        $genero = $_POST['genero'] ?? '';
        $otro_telefono_contacto = $_POST['otro_telefono_contacto'] ?? '';
        $programa_formacion_id = $_POST['programa_formacion_id'] ?? '';
        $cod_centro = $_POST['cod_centro'] ?? '';

        // Actualizar los datos en la base de datos
        $query = "UPDATE egresados 
                  SET MES = :mes, 
                      NOMBRES = :nombres, 
                      TipoDocumentoID = :tipo_documento, 
                      NumeroDocumento = :numero_documento, 
                      LugarResidenciaID = :lugar_residencia, 
                      DireccionResidencia = :direccion_residencia, 
                      CorreoElectronico = :correo_electronico, 
                      TelefonoCelular = :telefono_celular, 
                      OcupacionActual = :ocupacion_actual, 
                      VinculacionPatrocinio = :vinculacion_patrocinio, 
                      CentroFormacion = :centro_formacion, 
                      Ficha = :ficha, 
                      FechaCertificacion = :fecha_certificacion, 
                      EstudiosAdicionales = :estudios_adicionales, 
                      FechaUltimaLlamada = :fecha_ultima_llamada, 
                      NumeroFijo = :numero_fijo, 
                      Genero = :genero, 
                      OtroTelefonoContacto = :otro_telefono_contacto, 
                      ProgramaFormacionSENAID = :programa_formacion_id,
                       cod_centro = :cod_centro 
                  WHERE ID = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':mes', $mes);
        $stmt->bindParam(':nombres', $nombres);
        $stmt->bindParam(':tipo_documento', $tipo_documento);
        $stmt->bindParam(':numero_documento', $numero_documento);
        $stmt->bindParam(':lugar_residencia', $lugar_residencia);
        $stmt->bindParam(':direccion_residencia', $direccion_residencia);
        $stmt->bindParam(':correo_electronico', $correo_electronico);
        $stmt->bindParam(':telefono_celular', $telefono_celular);
        $stmt->bindParam(':ocupacion_actual', $ocupacion_actual);
        $stmt->bindParam(':vinculacion_patrocinio', $vinculacion_patrocinio);
        $stmt->bindParam(':centro_formacion', $centro_formacion);
        $stmt->bindParam(':ficha', $ficha);
        $stmt->bindParam(':fecha_certificacion', $fecha_certificacion);
        $stmt->bindParam(':estudios_adicionales', $estudios_adicionales);
        $stmt->bindParam(':fecha_ultima_llamada', $fecha_ultima_llamada);
        $stmt->bindParam(':numero_fijo', $numero_fijo);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':otro_telefono_contacto', $otro_telefono_contacto);
        $stmt->bindParam(':programa_formacion_id', $programa_formacion_id);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':cod_centro', $cod_centro); 


        // Ejecutar la actualización
        try {
            $stmt->execute();
            // Redirigir de vuelta a la página de listado de egresados con SweetAlert
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
                    document.addEventListener("DOMContentLoaded", function() {
                        Swal.fire({
                            title: "Actualización exitosa",
                            text: "Los datos del egresado han sido actualizados.",
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "index.php";
                            }
                        });
                    });
                  </script>';
            exit();
        } catch (PDOException $e) {
            echo "Error al intentar actualizar el egresado: " . $e->getMessage();
        }
        
    } else {
        // Obtener los datos actuales del egresado para mostrar en el formulario
        $query = "SELECT e.*, l.Ciudad
                  FROM egresados e
                  LEFT JOIN lugarresidencia l ON e.LugarResidenciaID = l.ID
                  WHERE e.ID = :id";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $egresado = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$egresado) {
            echo "Egresado no encontrado.";
            exit();
        }

        // Obtener los programas de formación para el campo de selección
        $query_programas = "SELECT ID, NombrePrograma FROM programaformacionsena";
        $stmt_programas = $db->query($query_programas);
        $programas = $stmt_programas->fetchAll(PDO::FETCH_ASSOC);

        // Obtener los lugares de residencia para el campo de selección
        $query_lugares = "SELECT ID, Ciudad FROM lugarresidencia";
        $stmt_lugares = $db->query($query_lugares);
        $lugares = $stmt_lugares->fetchAll(PDO::FETCH_ASSOC);

        // Función para manejar valores NULL
        function handleNull($value) {
            return $value === null ? '' : htmlspecialchars($value);
        }

        // Mostrar los datos del egresado en el formulario
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Actualizar Egresado</title>
            <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
            <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
                    max-width: 800px;
                    padding: 20px;
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                    position: relative;
                }
                h1 {
                    text-align: center;
                    color: #4CAF50;
                }
                form {
                    display: flex;
                    flex-direction: column;
                }
                label {
                    margin: 10px 0 5px;
                    font-weight: bold;
                }
                input, select {
                    padding: 10px;
                    margin-bottom: 10px;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                }
                button {
                    padding: 10px;
                    border: none;
                    border-radius: 4px;
                    background-color: #4CAF50;
                    color: #fff;
                    font-size: 16px;
                    cursor: pointer;
                    margin-top: 10px;
                }
                button:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
        <?php include '../../../Menu/Menu/menu.php'; ?>

            <div class="container">
                <h1>Actualizar Egresado</h1>
                <form action="update.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
                    <label for="mes">Mes:</label>
                    <input type="text" id="mes" name="mes" value="<?php echo handleNull($egresado['MES']); ?>">

                    <label for="nombres">Nombres:</label>
                    <input type="text" id="nombres" name="nombres" value="<?php echo handleNull($egresado['NOMBRES']); ?>">

                    <label for="tipo_documento">Tipo de Documento:</label>
                    <input type="text" id="tipo_documento" name="tipo_documento" value="<?php echo handleNull($egresado['TipoDocumentoID']); ?>">

                    <label for="numero_documento">Número de Documento:</label>
                    <input type="text" id="numero_documento" name="numero_documento" value="<?php echo handleNull($egresado['NumeroDocumento']); ?>">

                    <label for="lugar_residencia">Lugar de Residencia:</label>
                    <select id="lugar_residencia" name="lugar_residencia">
                        <?php foreach ($lugares as $lugar): ?>
                            <option value="<?php echo htmlspecialchars($lugar['ID']); ?>" <?php echo ($lugar['ID'] == $egresado['LugarResidenciaID']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($lugar['Ciudad']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>

                    <label for="direccion_residencia">Dirección de Residencia:</label>
                    <input type="text" id="direccion_residencia" name="direccion_residencia" value="<?php echo handleNull($egresado['DireccionResidencia']); ?>">

                    <label for="correo_electronico">Correo Electrónico:</label>
                    <input type="email" id="correo_electronico" name="correo_electronico" value="<?php echo handleNull($egresado['CorreoElectronico']); ?>">

                    <label for="telefono_celular">Teléfono Celular:</label>
                    <input type="text" id="telefono_celular" name="telefono_celular" value="<?php echo handleNull($egresado['TelefonoCelular']); ?>">

                    <label for="ocupacion_actual">Ocupación Actual:</label>
                    <input type="text" id="ocupacion_actual" name="ocupacion_actual" value="<?php echo handleNull($egresado['OcupacionActual']); ?>">

                    <label for="vinculacion_patrocinio">Vinculación Patrocinio:</label>
                    <input type="text" id="vinculacion_patrocinio" name="vinculacion_patrocinio" value="<?php echo handleNull($egresado['VinculacionPatrocinio']); ?>">

                    <label for="centro_formacion">Centro de Formación:</label>
                    <input type="text" id="centro_formacion" name="centro_formacion" value="<?php echo handleNull($egresado['CentroFormacion']); ?>">

                    <label for="ficha">Ficha:</label>
                    <input type="text" id="ficha" name="ficha" value="<?php echo handleNull($egresado['Ficha']); ?>">

                    <label for="fecha_certificacion">Fecha de Certificación:</label>
                    <input type="date" id="fecha_certificacion" name="fecha_certificacion" value="<?php echo handleNull($egresado['FechaCertificacion']); ?>">

                    <label for="estudios_adicionales">Estudios Adicionales:</label>
                    <input type="text" id="estudios_adicionales" name="estudios_adicionales" value="<?php echo handleNull($egresado['EstudiosAdicionales']); ?>">

                    <label for="fecha_ultima_llamada">Fecha de Última Llamada:</label>
                    <input type="date" id="fecha_ultima_llamada" name="fecha_ultima_llamada" value="<?php echo handleNull($egresado['FechaUltimaLlamada']); ?>">

                    <label for="numero_fijo">Número Fijo:</label>
                    <input type="text" id="numero_fijo" name="numero_fijo" value="<?php echo handleNull($egresado['NumeroFijo']); ?>">

                    <label for="genero">Género:</label>
                    <input type="text" id="genero" name="genero" value="<?php echo handleNull($egresado['Genero']); ?>">

                    <label for="otro_telefono_contacto">Otro Teléfono de Contacto:</label>
                    <input type="text" id="otro_telefono_contacto" name="otro_telefono_contacto" value="<?php echo handleNull($egresado['OtroTelefonoContacto']); ?>">
                    <label for="cod_centro">Centro de Formación:</label>
                    <select id="cod_centro" name="cod_centro">
    <option value="1010" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '1010') ? 'selected' : ''; ?>>1010</option>
    <option value="9405" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9405') ? 'selected' : ''; ?>>9405</option>
    <option value="101011" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '101011') ? 'selected' : ''; ?>>101011</option>
    <option value="9209" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9209') ? 'selected' : ''; ?>>9209</option>
    <option value="9210" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9210') ? 'selected' : ''; ?>>9210</option>
    <option value="9212" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9212') ? 'selected' : ''; ?>>9212</option>
    <option value="9214" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9214') ? 'selected' : ''; ?>>9214</option>
    <option value="9215" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9215') ? 'selected' : ''; ?>>9215</option>
    <option value="9211" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9211') ? 'selected' : ''; ?>>9211</option>
    <option value="9216" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9216') ? 'selected' : ''; ?>>9216</option>
    <option value="9217" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9217') ? 'selected' : ''; ?>>9217</option>
    <option value="9406" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9406') ? 'selected' : ''; ?>>9406</option>
    <option value="9403" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9403') ? 'selected' : ''; ?>>9403</option>
    <option value="9404" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9404') ? 'selected' : ''; ?>>9404</option>
    <option value="9508" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9508') ? 'selected' : ''; ?>>9508</option>
    <option value="9303" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9303') ? 'selected' : ''; ?>>9303</option>
    <option value="9213" <?php echo (isset($egresado['CodCentro']) && $egresado['CodCentro'] == '9213') ? 'selected' : ''; ?>>9213</option>
</select>


                    <label for="programa_formacion_id">Programa de Formación:</label>
                    <select id="programa_formacion_id" name="programa_formacion_id">
                        <?php foreach ($programas as $programa): ?>
                            <option value="<?php echo htmlspecialchars($programa['ID']); ?>" <?php echo ($programa['ID'] == $egresado['ProgramaFormacionSENAID']) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($programa['NombrePrograma']); ?>
                            </option>
                        <?php endforeach; ?>

                        
                    </select>
                    

                    <button type="submit">Actualizar</button>
                </form>
            </div>
        </body>
        </html>
        <?php
    }
} else {
    echo "ID no especificado.";
}
?>
