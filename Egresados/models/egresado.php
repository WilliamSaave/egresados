<?php
class Egresado {
    private $conn;
    private $table = 'egresados';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function obtenerEgresados() {
        $query = '
    SELECT 
        e.ID, e.MES, e.NOMBRES, e.TipoDocumentoID, e.NumeroDocumento,
        lr.nombre AS LugarResidencia, e.DireccionResidencia, e.CorreoElectronico,
        e.TelefonoCelular, e.OcupacionActual, e.VinculacionPatrocinio,
        e.CentroFormacion, e.Ficha, e.FechaCertificacion, e.EstudiosAdicionales,
        e.FechaUltimaLlamada, e.NumeroFijo, e.Genero, e.OtroTelefonoContacto,
        pfs.nombre AS ProgramaFormacionSENA
    FROM ' . $this->table . ' e
    LEFT JOIN lugarresidencia lr ON e.LugarResidenciaID = lr.ID
    LEFT JOIN programaformacionsena pfs ON e.ProgramaFormacionSENA = pfs.ID';
        
$stmt = $this->conn->prepare($query);
$stmt->execute();
return $stmt;

    }
}
?>
