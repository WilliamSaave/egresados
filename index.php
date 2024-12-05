<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido</title>
    <style>
        /* Estilos generales */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(135deg, #39A900, #8BC34A);
            color: white;
        }

        /* Contenedor principal */
        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.1);
            padding: 30px 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Título */
        .container h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #ffffff;
        }

        /* Botón */
        .container a {
            display: inline-block;
            text-decoration: none;
            padding: 15px 30px;
            font-size: 1.2em;
            color: #39A900;
            background-color: white;
            border-radius: 10px;
            transition: all 0.3s ease-in-out;
            font-weight: bold;
        }

        .container a:hover {
            background-color: #ffffff;
            color: #2E7D00;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bienvenido </h1>
        <a href="login/index.php" class="nav-link">Ingresar</a>
    </div>
</body>
</html>
