<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = ""; 
$dbname = "proyecto_de_grado";

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si se han enviado las fechas
if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
    $start_date = $_GET['start_date'];
    $end_date = $_GET['end_date'];

    // Modifica la consulta SQL para filtrar por fecha
    $sql = "SELECT temperatura, ph, turbidez, conductividad, fecha, hora FROM lecturas 
            WHERE fecha BETWEEN '$start_date' AND '$end_date'"; 
} else {
    // Consulta predeterminada si no se han enviado fechas
    $sql = "SELECT temperatura, ph, turbidez, conductividad, fecha, hora FROM lecturas"; 
}

$result = $conn->query($sql);

$lecturas = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $lecturas[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PROYECTO DE GRADO</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=456029ab9eb3b2fd731d52b4eae68504">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=320bd0471c3e8d6b9dd55c98e185506c">
    <link rel="stylesheet" href="css/estilosBoton.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js"></script>

    <style>
        #content-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        #content {
            flex: 1;
        }
        
        .chart-container {
            width: 100%;
            height: 500px;
            padding-top: 0.7rem;
           
        }
        canvas {
            width: 100% !important;
            height: 500px !important; /* Ajusta la altura de los gráficos */
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: rgb(21,76,121);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-user"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>monitoreo</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="principal.php"><i class="fas fa-tachometer-alt"></i><span>Principal</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="far fa-user-circle"></i><span>Cerrar Sesión</span></a></li>
                    <li class="nav-item">
                        <div class="nav-item dropdown nav-link"><a class="dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#" style="color: rgb(234,237,244);"><i class="fas fa-user-circle"></i>Usuarios</a>
                            <div class="dropdown-menu"><a class="dropdown-item" href="">Nuevo</a><a class="dropdown-item" href="#">Modificar</a><a class="dropdown-item" href="#">Eliminar</a><a class="dropdown-item" href="#">Listar</a></div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item dropdown nav-link"><a class="dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#" style="color: rgb(234,237,244);"><i class="fas fa-user-circle"></i>Reportes</a>
                            <div class="dropdown-menu"><a class="dropdown-item" href="datos.php">Lecturas</a><a class="dropdown-item" href="graf.php">Graficos</a></div>
                        </div>
                    </li>
                    <li class="nav-item"></li>
                   
                                            <div class="text-dark font-weight-bold h5 mb-0"><span id = "temp"></span></div>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
            </div>
            </nav>
        <div class="d-flex flex-column" id="content-wrapper" style="background-color: #0d0025;">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-black shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button></div>
                </nav>

                
        <div class="d-flex flex-column" id="content-wrapper" style="background-color: #0d0025;">
            <div id="content">
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">GRAFICOS DE LOS DATOS</h3>
                    </div>

            <div class="header-container">
            <!-- Formulario de Filtrado de Fechas -->
            <form method="GET" action="" class="date-form">
                <label for="start_date">Desde:</label>
                <input type="date" id="start_date" name="start_date" value="<?php echo isset($_GET['start_date']) ? $_GET['start_date'] : ''; ?>" required>

                <label for="end_date">Hasta:</label>
                <input type="date" id="end_date" name="end_date" value="<?php echo isset($_GET['end_date']) ? $_GET['end_date'] : ''; ?>" required>

                <button type="submit" class="button">Filtrar</button>
            </form>

            <!-- Contenedor de Botones -->
            <div class="button-group">
                <button type="button" class="button" id="downloadButton"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5-.5h3.707L4.354 5.854a.5.5 0 1 1 .707-.708l2.147 2.147a.5.5 0 0 1 .707 0l2.147-2.147a.5.5 0 0 1 .707.708L11.5 9.5h3.707a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-14a.5.5 0 0 1-.5-.5v-4z"/>
                        <path d="M7.646 9.146a.5.5 0 0 1 .707 0l1.147 1.146V.5a.5.5 0 0 1 1 0v9.792l1.147-1.146a.5.5 0 1 1 .707.707l-2 2a.5.5 0 0 1-.707 0l-2-2a.5.5 0 0 1 0-.707z"/>
                    </svg>
                    Descargar
                </button>
            </div>
        </div>

        <!-- Contenedores de los gráficos -->
        <div class="chart-container">
            <canvas id="temperatureChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="phChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="turbidityChart"></canvas>
        </div>
        <div class="chart-container">
            <canvas id="conductivityChart"></canvas>
        </div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const temperatureCtx = document.getElementById('temperatureChart').getContext('2d');
        const phCtx = document.getElementById('phChart').getContext('2d');
        const turbidityCtx = document.getElementById('turbidityChart').getContext('2d');
        const conductivityCtx = document.getElementById('conductivityChart').getContext('2d');

        const commonOptions = {
            responsive: true,
                                scales: {
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            font: {
                                                size: 14 // Tamaño de la fuente para los ejes Y
                                            }
                                        }
                                    },
                                    x: {
                                        ticks: {
                                            font: {
                                                size: 14 // Tamaño de la fuente para los ejes X
                                            }
                                        }
                                    }
                                },
                                plugins: {
                                    title: {
                                        display: true,
                                        font: {
                                            size: 30 // Tamaño de la fuente para el título del gráfico
                                        }
                                    }
                                }
                            };
        const temperatureData = {
            labels: <?php echo json_encode(array_column($lecturas, 'fecha')); ?>,
            datasets: [{
                label: 'Temperatura',
                data: <?php echo json_encode(array_column($lecturas, 'temperatura')); ?>,
                borderColor: 'rgba(255, 99, 132, 1)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                fill: false
            }]
        };

        const phData = {
            labels: <?php echo json_encode(array_column($lecturas, 'fecha')); ?>,
            datasets: [{
                label: 'pH',
                data: <?php echo json_encode(array_column($lecturas, 'ph')); ?>,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: false
            }]
        };

        const turbidityData = {
            labels: <?php echo json_encode(array_column($lecturas, 'fecha')); ?>,
            datasets: [{
                label: 'Turbidez',
                data: <?php echo json_encode(array_column($lecturas, 'turbidez')); ?>,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                fill: false
            }]
        };

        const conductivityData = {
            labels: <?php echo json_encode(array_column($lecturas, 'fecha')); ?>,
            datasets: [{
                label: 'Conductividad',
                data: <?php echo json_encode(array_column($lecturas, 'conductividad')); ?>,
                borderColor: 'rgba(153, 102, 255, 1)',
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                fill: false
            }]
        };

        new Chart(temperatureCtx, {
            type: 'line',
            data: temperatureData,
            options: commonOptions
        });

        new Chart(phCtx, {
            type: 'line',
            data: phData,
            options: commonOptions
        });

        new Chart(turbidityCtx, {
            type: 'line',
            data: turbidityData,
            options: commonOptions
        });

        new Chart(conductivityCtx, {
            type: 'line',
            data: conductivityData,
            options: commonOptions
        });
    });

    document.getElementById('downloadButton').addEventListener('click', function() {
                            const { jsPDF } = window.jspdf;
                            const doc = new jsPDF();

                            const img = new Image();
                            img.src = 'assets/img/sela.jpg';
                            img.onload = function() {
                                doc.addImage(img, 'JPEG', 10, 10, 30, 30);
                                const pageWidth = doc.internal.pageSize.getWidth();
                                const title = "Reporte de Datos";
                                const titleX = pageWidth / 2 - (doc.getTextWidth(title) / 2);
                                doc.text(title, titleX, 50);

                                const charts = ['temperatureChart', 'phChart', 'turbidityChart', 'conductivityChart'];

                                let yOffset = 70;
                                charts.forEach((chartId, index) => {
                                    const canvas = document.getElementById(chartId);
                                    const imgData = canvas.toDataURL('image/png');
                                    doc.addImage(imgData, 'PNG', 15, yOffset, 180, 100);
                                    yOffset += 120;  // Aumentar el espacio entre gráficos
                                    if (index === 1) {
                                        doc.addPage(); // Agregar una nueva página después del segundo gráfico
                                        yOffset = 10; // Reiniciar el offset para la nueva página
                                    }
                                });

                                doc.save('reporte_' + '<?php echo $start_date; ?>' + '_' + '<?php echo $end_date; ?>' + '.pdf');
                            };
                        });
</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=99c003fa89398340e3d8f90406f57bdc"></script>

</body>
</html>
