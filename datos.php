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

    <style>
        /* Aseguramos que el contenedor ocupe toda la altura disponible */
        #content-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #content {
            flex: 1;
        }

        /* Ajustes adicionales para asegurar que la tabla ocupe todo el espacio */
        .card-body {
            padding: 0;
        }

        .table-responsive {
            height: calc(100vh - 300px); /* Ajuste según tu necesidad */
            overflow-y: auto;
        }

        .table {
            margin-bottom: 0;

            
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
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="far fa-user-circle"></i><span>Cerrar Seción</span></a></li>
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
                        <h3 class="text-dark mb-0">DATOS DE MONITOREO</h3>
                    </div>


            <div class="header-container">
            <!-- Formulario de Filtrado de Fechas -->
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
                <!-- Botón de Actualizar -->
                <button type="button" class="button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                        <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41zm-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9z"></path>
                        <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5.002 5.002 0 0 0 8 3zM3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9H3.1z"></path>
                    </svg>
                    Actualizar
                </button>

                <!-- Botón de Descargar -->
                <button type="button" class="button" id="downloadButton"> 
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5-.5h3.707L4.354 5.854a.5.5 0 1 1 .707-.708l2.147 2.147a.5.5 0 0 1 .707 0l2.147-2.147a.5.5 0 0 1 .707.708L11.5 9.5h3.707a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-14a.5.5 0 0 1-.5-.5v-4z"/>
                        <path d="M7.646 9.146a.5.5 0 0 1 .707 0l1.147 1.146V.5a.5.5 0 0 1 1 0v9.792l1.147-1.146a.5.5 0 1 1 .707.707l-2 2a.5.5 0 0 1-.707 0l-2-2a.5.5 0 0 1 0-.707z"/>
                    </svg>
                    Descargar
                </button>
            </div>
        </div>

        <style>
        .header-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .date-form {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .button-group {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* Media Queries para pantallas pequeñas */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                align-items: flex-start;
            }

            .button-group {
                margin-top: 10px; /* Añade espacio entre el formulario y los botones en pantallas pequeñas */
            }
        }
        </style>




                    <div class="row">
                    <div class="col-md-12 col-xl-12 mb-4">
                            <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                    <div class="table-responsive" >
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="max-width: 100%;">
                            <thead>
                                <tr>
                                    <th>Temperatura</th>
                                    <th>pH</th>
                                    <th>Turbidez</th>
                                    <th>Conductividad</th>
                                    <th>Fecha</th>
                                    <th>Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["temperatura"] . "</td>";
                                        echo "<td>" . $row["ph"] . "</td>";
                                        echo "<td>" . $row["turbidez"] . "</td>";
                                        echo "<td>" . $row["conductividad"] . "</td>";
                                        echo "<td>" . $row["fecha"] . "</td>";
                                        echo "<td>" . $row["hora"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No hay datos disponibles</td></tr>";
                                }
                                ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.29/jspdf.plugin.autotable.min.js"></script>
<script>


document.getElementById('downloadButton').addEventListener('click', function() {
    // Obtener las fechas del filtro
    var startDate = document.getElementById('start_date').value;
    var endDate = document.getElementById('end_date').value;

    // Hacer una petición AJAX para obtener los datos filtrados
    fetch('get_filtered_data.php?start_date=' + startDate + '&end_date=' + endDate)
        .then(response => response.json())
        .then(data => {
            // Crear el PDF
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            // Añadir el logo
            const img = new Image();
            img.src = 'assets/img/sela.jpg';  // Ruta a la imagen del logo
            img.onload = function() {
                doc.addImage(img, 'JPEG', 10, 10, 30, 30); // Añadir la imagen en la posición deseada

                 // Centrar el título debajo del logo
                 const pageWidth = doc.internal.pageSize.getWidth();
                const title = "Reporte de Datos";
                const titleX = pageWidth / 2 - (doc.getTextWidth(title) / 2);
                doc.text(title, titleX, 50); 
                // Preparar los datos para la tabla
                const tableColumn = ["Temperatura", "pH", "Turbidez", "Conductividad", "Fecha", "Hora"];
                const tableRows = [];

                data.forEach(item => {
                    const rowData = [
                        item.temperatura,
                        item.ph,
                        item.turbidez,
                        item.conductividad,
                        item.fecha,
                        item.hora
                    ];
                    tableRows.push(rowData);
                });

                // Generar la tabla
                doc.autoTable({
                    head: [tableColumn],
                    body: tableRows,
                    startY: 70  // Empieza la tabla después del logo
                });

                // Guardar el PDF
                doc.save('reporte_' + startDate + '_' + endDate + '.pdf');
            };
        })
        .catch(error => {
            console.error('Error al generar el PDF:', error);
            alert('Hubo un error al generar el reporte. Por favor, inténtalo de nuevo.');
        });
});

</script>
                            </tbody>
                        </table>
                    </div>
             

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=99c003fa89398340e3d8f90406f57bdc"></script>
