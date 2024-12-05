

<?php
// Establecer la ruta de las imágenes
$images = ["ima1.jpg", "ima2.jpg", "ima3.jpg"];

// Obtener el índice de la imagen actual desde la URL (parámetro 'img')
$imgIndex = isset($_GET['img']) ? intval($_GET['img']) : 0;
$imgIndex = ($imgIndex >= count($images)) ? 0 : $imgIndex;

// Obtener la imagen actual
$currentImage = $images[$imgIndex];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            margin-top: 25px; 
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #39A900;
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
        }
        h2 {
            color: #007832;
            font-size: 28px;
            margin-top: 30px;
        }
        .image-slider img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .info, .instructions {
            margin-top: 20px;
        }
        ul, ol {
            line-height: 1.6;
        }
        .info ul {
            list-style: none;
            padding: 0;
        }
        .info li {
            background: #e9f5e5;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            border-left: 5px solid #39A900;
        }
        .instructions ol {
            margin-left: 20px;
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
    <script>
        // Cambiar imagen automáticamente cada 5 segundos
        function startImageRotation() {
            let imgIndex = <?php echo $imgIndex; ?>;
            const totalImages = <?php echo count($images); ?>;
            setInterval(() => {
                imgIndex = (imgIndex + 1) % totalImages;
                window.location.href = `?img=${imgIndex}`;
            }, 5000);
        }
        window.onload = startImageRotation;
    </script>
</head>
<body>
<?php include '../Menu/menu.php'; ?>
    <div class="container">
        <h1>¡Bienvenido a nuestra app de gestión de egresados!</h1>
        <div class="image-slider">
            <img src="imagenes/<?php echo $currentImage; ?>" alt="Anuncio">
        </div>

        <div class="info">
            <h2>Información Básica</h2>
            <ul>
                <li><strong>Registro de Egresados:</strong> Agrega datos manualmente o automáticamente, y carga nuevos datos mensualmente.</li>
                <li><strong>Datos de Egresados:</strong> Incluye información esencial como nombres, tipo y número de documento, y lugar de residencia.</li>
                <li><strong>Formularios:</strong> Facilita la actualización de datos a través de formularios en línea conectados a la base de datos.</li>
                <li><strong>Informes:</strong> Genera informes periódicos, aplica filtros, y descarga en varios formatos.</li>
                <li><strong>Estadísticas y Análisis:</strong> Obtén estadísticas detalladas y reporta errores si es necesario.</li>
            </ul>
        </div>

        <div class="instructions">
            <h2>Instrucciones Simples</h2>
            <ol>
                <li>Navega por las secciones usando el menú.</li>
                <li>Actualiza la información usando los formularios en línea.</li>
                <li>Genera y personaliza informes desde el panel correspondiente.</li>
                <li>Consulta el historial de informes y búsquedas.</li>
                <li>Revisa estadísticas detalladas y reporta cualquier error.</li>
            </ol>
        </div>
    </div>
    <footer>
    Si tiene algún problema, escriba a este correo sena@problemas.com 
    </footer>
</body>
</html>
