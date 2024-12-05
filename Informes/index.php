<?php
include '../Menu/menu.php';

require 'vendor/autoload.php';
include_once 'config/database.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$mensaje = "";
$tipoMensaje = "";

if (isset($_POST['submit'])) {
    $file_mimes = array('application/vnd.ms-excel','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    
    if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
        
        $arr_file = explode('.', $_FILES['file']['name']);
        $extension = end($arr_file);

        if ('xlsx' == $extension) {
            $reader = IOFactory::createReader('Xlsx');
        } else {
            $reader = IOFactory::createReader('Xls');
        }

        $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        
        $database = new Database();
        $conn = $database->getConnection();

        for ($i = 2; $i <= count($sheetData); $i++) {
            $nombres = $sheetData[$i]['B'];

            if (empty($nombres)) {
                break;
            }

            $mes = $sheetData[$i]['A'];
            $tipoDocumentoID = $sheetData[$i]['C'];
            $numeroDocumento = $sheetData[$i]['D'];
            $correoElectronico = $sheetData[$i]['F'];
            $telefonoCelular = $sheetData[$i]['G'];
            $centroFormacion = $sheetData[$i]['O'];
            $ficha = $sheetData[$i]['P'];


            
            $fechaCertificacion = $sheetData[$i]['Q'];
            $estudiosAdicionales = $sheetData[$i]['T'];
            $fechaUltimaLlamada = $sheetData[$i]['W'];
            $numeroFijo = $sheetData[$i]['H'];

            $sql = "INSERT INTO egresados (MES, NOMBRES, TipoDocumentoID, NumeroDocumento, CorreoElectronico, TelefonoCelular, CentroFormacion, Ficha, FechaCertificacion, EstudiosAdicionales, FechaUltimaLlamada, NumeroFijo) 
                    VALUES (:mes, :nombres, :tipoDocumentoID, :numeroDocumento, :correoElectronico, :telefonoCelular, :centroFormacion, :ficha, :fechaCertificacion, :estudiosAdicionales, :fechaUltimaLlamada, :numeroFijo)";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':mes', $mes);
            $stmt->bindParam(':nombres', $nombres);
            $stmt->bindParam(':tipoDocumentoID', $tipoDocumentoID);
            $stmt->bindParam(':numeroDocumento', $numeroDocumento);
            $stmt->bindParam(':correoElectronico', $correoElectronico);
            $stmt->bindParam(':telefonoCelular', $telefonoCelular);
            $stmt->bindParam(':centroFormacion', $centroFormacion);
            $stmt->bindParam(':ficha', $ficha);
            $stmt->bindParam(':fechaCertificacion', $fechaCertificacion);
            $stmt->bindParam(':estudiosAdicionales', $estudiosAdicionales);
            $stmt->bindParam(':fechaUltimaLlamada', $fechaUltimaLlamada);
            $stmt->bindParam(':numeroFijo', $numeroFijo);
            
            $stmt->execute();
        }

        $deleteDuplicates = "DELETE t1 FROM egresados t1
                             INNER JOIN egresados t2 
                             WHERE 
                               t1.id < t2.id AND 
                               t1.NumeroDocumento = t2.NumeroDocumento";
        $conn->exec($deleteDuplicates);

        $mensaje = "Datos insertados correctamente y duplicados eliminados.";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Por favor, sube un archivo Excel válido.";
        $tipoMensaje = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Excel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 2px;
            margin-top: 25px; 
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            margin: auto;
            max-width: 1200px;
            padding: 20px;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header h1 {
            color: #2d572c;
            margin-bottom: 20px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .alert-error {
            color: #a94442;
            background-color: #f2dede;
            border-color: #ebccd1;
        }
        .btn {
            display: inline-block;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 10px 20px;
            font-size: 16px;
            line-height: 1.5;
            border-radius: 4px;
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
            cursor: pointer;
            text-decoration: none;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #449d44;
            border-color: #398439;
        }
        .btn-error {
            background-color: #d9534f;
            border-color: #d43f3a;
        }
        .btn-error:hover {
            background-color: #c9302c;
            border-color: #ac2925;
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
    <div class="container">
        <header class="header">
            <h1>Subir Archivo Excel para Egresados e Informe</h1>
        </header>
        <?php if (!empty($mensaje)): ?>
            <div class="alert alert-<?php echo $tipoMensaje; ?>">
                <?php echo $mensaje; ?>
            </div>
        <?php endif; ?>
        <form action="index.php" method="post" enctype="multipart/form-data" >
            <label for="file">Seleccionar archivo Excel:</label>
            <input type="file"  name="file" id="file" accept=".xlsx,.xls" >
            <br><br>
            <input type="submit" name="submit" value="Subir y Procesar" class="btn">
            <a href="pdf_descarga_egresados.php" class="btn" target="_blank">Descargar informe de Egresados</a>
        </form>
    </div>
    
    
    <footer>
        Si tiene algún problema, escriba a este correo sena@problemas.com
    </footer>
</body>
</html>
