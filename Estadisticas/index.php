<?php
include '../Menu/menu.php';
include_once 'config/database.php';

$database = new Database();
$conn = $database->getConnection();

// Consulta para obtener la cantidad de egresados por mes
$queryMes = "SELECT MES, COUNT(*) as cantidad FROM egresados GROUP BY MES";
$stmtMes = $conn->prepare($queryMes);
$stmtMes->execute();
$meses = $stmtMes->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener la distribución por género
$queryGenero = "SELECT Genero, COUNT(*) as cantidad FROM egresados GROUP BY Genero";
$stmtGenero = $conn->prepare($queryGenero);
$stmtGenero->execute();
$generos = $stmtGenero->fetchAll(PDO::FETCH_ASSOC);

// Consulta para obtener la distribución por lugar de residencia
$queryResidencia = "SELECT LugarResidenciaID, COUNT(*) as cantidad FROM egresados GROUP BY LugarResidenciaID";
$stmtResidencia = $conn->prepare($queryResidencia);
$stmtResidencia->execute();
$residencias = $stmtResidencia->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gráficas de Egresados</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #e8f5e9;
        }
        .container {
            width: 100%;
            margin: auto;
            max-width: 1200px;
            padding: 20px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0,0,0,0.2);
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .chart-container {
            flex: 1;
            margin-right: 20px;
            background: #ffffff;
            border: 1px solid #ccc;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .chart-container:last-child {
            margin-right: 0;
        }
        canvas {
            border-radius: 12px;
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
        <div class="row">
            <div class="chart-container">
                <canvas id="egresadosPorMes"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="distribucionGenero"></canvas>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="distribucionResidencia"></canvas>
        </div>
    </div>
    <script>
        // Datos para el gráfico de egresados por mes
        const ctxMes = document.getElementById('egresadosPorMes').getContext('2d');
        const mesesData = <?php echo json_encode($meses); ?>;
        const mesesLabels = mesesData.map(row => row.MES);
        const mesesCounts = mesesData.map(row => row.cantidad);

        new Chart(ctxMes, {
            type: 'line', // Cambiado a gráfico de líneas
            data: {
                labels: mesesLabels,
                datasets: [{
                    label: 'Cantidad de Egresados por Mes',
                    data: mesesCounts,
                    backgroundColor: 'rgba(102, 204, 153, 0.2)',
                    borderColor: '#66CC99',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Datos para el gráfico de distribución por género
        const ctxGenero = document.getElementById('distribucionGenero').getContext('2d');
        const generosData = <?php echo json_encode($generos); ?>;
        const generosLabels = generosData.map(row => row.Genero);
        const generosCounts = generosData.map(row => row.cantidad);

        new Chart(ctxGenero, {
            type: 'doughnut', // Cambiado a gráfico de donut
            data: {
                labels: generosLabels,
                datasets: [{
                    label: 'Distribución por Género',
                    data: generosCounts,
                    backgroundColor: ['#007832', '#009688', '#FF5722'],
                    borderColor: '#ffffff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' egresados';
                            }
                        }
                    }
                }
            }
        });

        // Datos para el gráfico de distribución por lugar de residencia
        const ctxResidencia = document.getElementById('distribucionResidencia').getContext('2d');
        const residenciasData = <?php echo json_encode($residencias); ?>;
        const residenciasLabels = residenciasData.map(row => row.LugarResidenciaID);
        const residenciasCounts = residenciasData.map(row => row.cantidad);

        new Chart(ctxResidencia, {
            type: 'bar',
            data: {
                labels: residenciasLabels,
                datasets: [{
                    label: 'Distribución por Lugar de Residencia',
                    data: residenciasCounts,
                    backgroundColor: '#66CC99',
                    borderColor: '#4CAF50',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.label + ': ' + tooltipItem.raw + ' egresados';
                            }
                        }
                    }
                }
            }
        });
    </script>
    <footer>
        Si tiene algún problema, escriba a este correo sena@problemas.com
    </footer>
</body>
</html>
