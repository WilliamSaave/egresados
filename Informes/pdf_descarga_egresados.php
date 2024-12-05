<?php
include_once 'config/database.php';
require('fpdf/fpdf.php');

// Crear una instancia de la clase Database y obtener la conexión
$database = new Database();
$conexion = $database->getConnection();

// Crear el objeto FPDF y agregar una página
$pdf = new FPDF; 
$pdf->AddPage();

// Configuración de imagen y texto
$imageWidth = 30; 
$imagePath = '../Login/Imagenes/logoSena1.png';
$pageWidth = $pdf->GetPageWidth();
$imageX = ($pageWidth - $imageWidth) / 2;

$texto_solicitud = "  En el ámbito académico y profesional, la solicitud de egresados representa un pilar fundamental para el crecimiento y la evolución de las instituciones. La integración de estos profesionales formados con estándares rigurosos no solo enriquece el conocimiento colectivo, sino que también alimenta la innovación y el progreso en diversas áreas.

Según estudios recientes (APA, año), la colaboración con egresados ha demostrado ser una estrategia efectiva para potenciar el desarrollo institucional, fomentando la continuidad en la mejora continua y fortaleciendo las relaciones entre la academia y el sector laboral.

Es vital considerar la importancia estratégica de esta solicitud, no solo como un proceso administrativo, sino como un puente hacia el futuro, estableciendo conexiones duraderas entre la formación y la práctica, allanando el camino para la excelencia y la innovación.
";

$pdf->Image($imagePath, $imageX, 10, $imageWidth);
$pdf->SetFont('Arial', '', 10);
$pdf->SetXY(10, 50); // Posición para el texto
$pdf->MultiCell(0, 8, utf8_decode($texto_solicitud));

// Configuración para la tabla
$pdf->SetDrawColor(0); 
$pdf->SetFillColor(180, 180, 180); 
$pdf->SetTextColor(0);
$pdf->SetDrawColor(0); 
$pdf->SetFont('Arial', '', 6);

// Consulta de datos
$query = "SELECT 
    e.NOMBRES,
    e.NumeroDocumento,
    e.CorreoElectronico,
    e.TelefonoCelular,
    e.Ficha,
    e.FechaCertificacion,
    pf.NombrePrograma AS 'ProgramaFormacionSENA'
    FROM egresados e
    LEFT JOIN programaformacionsena pf ON e.ProgramaFormacionSENAID = pf.id";

$stmt = $conexion->prepare($query);
$stmt->execute();

$header = false; // Variable para imprimir la cabecera solo una vez
$columnWidth = 28; // Reducción del ancho de la columna
$fontSize = 6; // Reducción del tamaño de la fuente
$maxCharLength = 28; // Número máximo de caracteres a mostrar en una celda

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    if (!$header) {
        foreach ($fila as $campo => $valor) {
            $pdf->Cell($columnWidth, 10, utf8_decode(substr($campo, 0, $maxCharLength)), 1, 0, 'C', true); // Celdas centradas con color de fondo
        }
        $pdf->Ln(); 
        $header = true;
    }

    foreach ($fila as $valor) {
        $pdf->SetFont('Arial', '', 6);
        $textToDisplay = (mb_strlen($valor) > $maxCharLength) ? mb_substr($valor, 0, $maxCharLength - 3) . '...' : $valor;
        $pdf->Cell($columnWidth, 8, utf8_decode($textToDisplay), 1);
    }
    $pdf->Ln(); 
}

// Agregar separación visual entre el texto y la tabla
$pdf->SetLineWidth(0.5);
$pdf->SetDrawColor(0);
$pdf->Line(10, $pdf->GetY() + 10, $pdf->GetPageWidth() - 10, $pdf->GetY() + 10);

// Salida del PDF
$pdf->Output('D', 'tabla_egresados.pdf');
?>
