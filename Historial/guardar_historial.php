<?php
require_once 'config/database.php'; // Ajusta la ruta según la ubicación real del archivo

// Crear una instancia de la clase Database
$database = new Database();
$db = $database->getConnection();

try {
    // Iniciar una transacción
    $db->beginTransaction();

    // Insertar datos de la tabla egresados en la tabla historial
    $insertQuery = "
        INSERT INTO historial ( MES, NOMBRES, TipoDocumentoID, NumeroDocumento, LugarResidenciaID, DireccionResidencia, CorreoElectronico, TelefonoCelular, OcupacionActual, VinculacionPatrocinio, CentroFormacion, Ficha, FechaCertificacion, EstudiosAdicionales, FechaUltimaLlamada, NumeroFijo, Genero, OtroTelefonoContacto, ProgramaFormacionSENAID)
        SELECT  MES, NOMBRES, TipoDocumentoID, NumeroDocumento, LugarResidenciaID, DireccionResidencia, CorreoElectronico, TelefonoCelular, OcupacionActual, VinculacionPatrocinio, CentroFormacion, Ficha, FechaCertificacion, EstudiosAdicionales, FechaUltimaLlamada, NumeroFijo, Genero, OtroTelefonoContacto, ProgramaFormacionSENAID
        FROM egresados
    ";
    
    $result = $db->query($insertQuery);

    if (!$result) {
        throw new Exception("Error al insertar datos: " . implode(", ", $db->errorInfo()));
    }

    // Confirmar la transacción
    $db->commit();

    // Devolver una respuesta JSON
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    // Revertir la transacción en caso de error
    $db->rollBack();
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
?>
