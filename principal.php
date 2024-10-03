<?php
    include ("conexion.php");
    $conexion= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname,);
    if($conexion==false)
    {
        die("Error de conexion".mysqli_connect_error());
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PROYECTO DE GRADO</title>


  <style>
    #content-wrapper, #content { /* graficos*/
      background-color: #0d0025 !important;
    }
    .col-md-6.col-xl-3 .card {
      background-color: #0d0025 !important;
      color: white !important;
      
    }
    .chart-container {
    background-color: #0d0025; /* Color azul marino */
    padding: 0 20px; /* Ajuste de padding solo en los costados */
    border-radius: 10px; /* Bordes redondeados */
    margin: 0 auto; /* Centrar el gráfico */
    
    
}

    .col-lg-7.col-xl-12 .card {
    background-color: #0d0025;
    padding: 20px;
    border-radius: 10px;
    margin: 0 auto 20px; /* Centra la tarjeta y añade margen abajo */
    max-width: 97.5%; /* Limita el ancho máximo */
}

        /* Asegúrate de que el canvas ocupe todo el contenedor */
        #temperaturas {
            width: 45%;   
        }
        #phs {
            width: 45%;   
        }
        #turbidezz {
            width: 45%;   
        }
        #conductividads {
            width: 45%;   
        }

  .chart-area {
    background-color: #0d0025 !important;
    color: white !important;
  }



  /* Definir la animación de neón */
@keyframes neon-green {
    0%, 100% {
        box-shadow: 0 0 10px rgba(0, 255, 0, 0), 0 0 20px rgba(0, 255, 0, 0), 0 0 30px rgba(0, 255, 0, 0), 0 0 40px rgba(0, 255, 0, 0);
    }
    50% {
        box-shadow: 0 0 20px rgba(0, 255, 0, 1), 0 0 30px rgba(0, 255, 0, 1), 0 0 40px rgba(0, 255, 0, 1), 0 0 50px rgba(0, 255, 0, 1);
    }
}

/* Estilo de las luces verdes con animación de neón */
.sensor-light.green {
    background-color: green;
    animation: neon-green 1s infinite; /* Aplicar la animación con una duración de 2 segundos en bucle */
}

/* Ajustes generales para las luces */
.sensor-light {
    width: 20px;
    height: 20px;
    background-color: #222;
    border-radius: 50%;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    margin-top: 10px;
}

@keyframes neon-red {
    0%, 100% {
        box-shadow: 0 0 20px rgba(255, 0, 0, 0), 0 0 30px rgba(255, 0, 0, 0), 0 0 40px rgba(255, 0, 0, 0), 0 0 50px rgba(255, 0, 0, 0);
    }
    50% {
        box-shadow: 0 0 40px rgba(255, 0, 0, 1), 0 0 60px rgba(255, 0, 0, 1), 0 0 80px rgba(255, 0, 0, 1), 0 0 100px rgba(255, 0, 0, 1);
    }
}

.sensor-light.red {
    background-color: red;
    animation: neon-red 1s infinite; /* Reducción de la duración de la animación para parpadeo más rápido */
}



</style>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=456029ab9eb3b2fd731d52b4eae68504">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css?h=320bd0471c3e8d6b9dd55c98e185506c">
    
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
                    <li class="nav-item">
                        <a class="nav-link active" href="principal.php"><i class="fas fa-tachometer-alt"></i><span>Principal</span></a>
                    </li>
                    <li class="nav-item"> 
                        <a class="nav-link" href="index.php"><i class="far fa-user-circle"></i><span>Cerrar Seción</span></a>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item dropdown nav-link">
                            <a class="dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#" style="color: rgb(234,237,244);"><i class="fas fa-user-circle"></i>Usuarios</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" data-toggle="modal" href="#nuevo">Nuevo</a>
                                <a class="dropdown-item" data-toggle="modal" href="#modificar">Modificar</a>
                                <a class="dropdown-item" data-toggle="modal" href="#eliminar">Eliminar</a>
                                <a class="dropdown-item" data-toggle="modal" href="#listar">Listar</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <div class="nav-item dropdown nav-link">
                            <a class="dropdown-toggle" aria-expanded="false" data-toggle="dropdown" href="#" style="color: rgb(234,237,244);"><i class="fas fa-user-circle"></i>Reportes</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="datos.php">Lecturas</a>
                                <a class="dropdown-item" href="graf.php">Graficos</a>
                            </div>
                        </div>
                    
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper" style="background-color: #0d0025;">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-black shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button></div>
                </nav>
                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">SISTEMA DE MONITOREO DE LA CALIDAD DEL AGUA</h3>
                    </div>
            
                  


                    <div class="row">
                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Temperatura</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span id="temp"></span></div>
                                        <div class="sensor-light green" id="temp-light"></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-temperature-low fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>PH</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span id="ph"></span></div>
                                        <div class="sensor-light green" id="ph-light"></div>
                                    </div>
                                    <div class="col-auto"><i class="fab fa-creative-commons-sampling fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Turbidez</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span id="turb"></span></div>
                                        <div class="sensor-light green" id="turb-light"></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-water fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-xl-3 mb-4">
                        <div class="card shadow border-left-primary py-2">
                            <div class="card-body">
                                <div class="row align-items-center no-gutters">
                                    <div class="col mr-2">
                                        <div class="text-uppercase text-primary font-weight-bold text-xs mb-1"><span>Conductividad</span></div>
                                        <div class="text-dark font-weight-bold h5 mb-0"><span id="cond"></span></div>
                                        <div class="sensor-light green" id="cond-light"></div>
                                    </div>
                                    <div class="col-auto"><i class="fas fa-crutch fa-2x text-gray-300"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                </div><!-- Start: Chart -->
                    <div class="row">
                        <div class="col-lg-7 col-xl-12">
                            <div class="card shadow mb-4">
                                <div class=" d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0">Control de Temperatura en Tiempo real</h6>
                                    <div class="dropdown no-arrow">
                                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id = "temperaturas"></canvas></div>
                                </div> 
                            </div>
                        </div>


                
                        </div><!-- Start: Chart -->
                    <div class="row">
                        <div class="col-lg-7 col-xl-12">
                            <div class="card shadow mb-4">
                                <div class=" d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0">Control del PH en Tiempo real</h6>
                                    <div class="dropdown no-arrow">
                                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id = "phs"></canvas></div>
                                </div> 
                            </div>
                        </div>





                        </div><!-- Start: Chart -->
                    <div class="row">
                        <div class="col-lg-7 col-xl-12">
                            <div class="card shadow mb-4">
                                <div class=" d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0">Control de la Turbidez en Tiempo real</h6>
                                    <div class="dropdown no-arrow">
                                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id = "turbidezz"></canvas></div>
                                </div> 
                            </div>
                        </div>



                        </div><!-- Start: Chart -->
                    <div class="row">
                        <div class="col-lg-7 col-xl-12">
                            <div class="card shadow mb-4">
                                <div class=" d-flex justify-content-between align-items-center">
                                    <h6 class="text-primary font-weight-bold m-0">Control de Conductividad en Tiempo real</h6>
                                    <div class="dropdown no-arrow">
                                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart-container">
                                        <canvas id = "conductividads"></canvas></div>
                                </div> 
                            </div>
                        </div>
                       
                
                        

        <div class="modal fade" role="dialog" tabindex="-1" id="nuevo">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registro de Usuarios</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Nuevo Usuario</h4>
                            </div>
                            <form class="user" method="post" action="guardar.php">
                                <div class="form-group row">
                                    <input class="form-control form-control-user" type="text" placeholder="Nombre Completo" name="nombres" require="" onKeyUp="this.value=this.value.toUpperCase();">
                            </div>
                                <div class="form-group row">
                                    <input class="form-control form-control-user" type="password" placeholder="Contraseña" name="password" require="">
                            </div>
                                <div class="form-group row">
                                    <input class="form-control form-control-user" type="text" placeholder="Carnet de Identidad" name="carnet" inputmode="numeric"  require="">
                            </div>
                                <div class="form-group row">
                                    <input class="form-control form-control-user" type="text" placeholder="Telefono/Celular" name="telefono" inputmode="numeric" require="">
                                    </div>
                                <div class="form-group row">
                                    <input class="form-control form-control-user" type="text" id="exampleFirstName-6" placeholder="Cargo" name="cargo"  require="">
                                    </div>
                                <button class="btn btn-primary btn-block text-white btn-user" type="submit">Registrar Usuario</button>
                                <hr>
                                <hr>
                            </form>
                        </div>
                    </div> 
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cerrar</button></div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" tabindex="-1" id="modificar">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registro de Usuarios</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Modificar Usuario</h4>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Cargo</th>
                                        <th>Modificar</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                        
                                    <?php
                                        $sql=mysqli_query($conexion,"select nombres, cargo from usuarios order by nombres;");
                                        while($row=mysqli_fetch_array($sql))
                                        {
                                            echo "<tr>";
                                            echo "<form method='post' action='modificar.php'>";
                                            echo "<td><input name='nombres' readonly='' value='".$row['nombres']."' style='border:0px;'></td>";
                                            echo "<td>".$row['cargo']."</td>";
                                            echo "<td><button class='btn btn-info btn-circle ml-1' role='button' type='submit' ><i class='fas fa-user-edit text-white'></i></button></td>";
                                            echo "</form>";
                                            echo "</tr>";
                                        } 

                                    ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cerrar</button></div>
                </div>
            </div>
        </div>
 
        <div class="modal fade" role="dialog" tabindex="-1" id="eliminar">
            <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registro de Usuarios</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Eliminar Usuario</h4>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Cargo</th>
                                        <th>Modificar</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                        
                                    <?php
                                        $sql=mysqli_query($conexion,"select nombres, cargo from usuarios order by nombres;");
                                        while($row=mysqli_fetch_array($sql))
                                        {
                                            echo "<tr>";
                                            echo "<form method='post' action='eliminar.php'>";
                                            echo "<td><input name='nombres' readonly='' value='".$row['nombres']."' style='border:0px;'></td>";
                                            echo "<td>".$row['cargo']."</td>";
                                            echo "<td><button class='btn btn-info btn-circle ml-1' role='button' type='submit' ><i class='fas fa-user-edit text-white'></i></button></td>";
                                            echo "</form>";
                                            echo "</tr>";
                                        } 

                                    ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cerrar</button></div>
                </div>
            </div>
        </div>

        <div class="modal fade" role="dialog" tabindex="-1" id="listar">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registro de Usuarios</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <p></p>
                        <div class="p-5">
                            <div class="text-center">
                                <h4 class="text-dark mb-4">Lista de Usuarios</h4>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Carnet</th>
                                        <th>Telefono</th>
                                        <th>Cargo</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                        
                                    <?php
                                        $sql=mysqli_query($conexion,"select nombres, carnet, telefono, cargo from usuarios order by nombres;");
                                        while($row=mysqli_fetch_array($sql))
                                        {
                                            echo "<tr>"; 
                                            echo "<td>".$row['nombres']."</td>";
                                            echo "<td>".$row['carnet']."</td>";
                                            echo "<td>".$row['telefono']."</td>";         
                                            echo "<td>".$row['cargo']."</td>";      
                                            echo "</form>";
                                            echo "</tr>";
                                        } 

                                    ?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal">Cerrar</button></div>
                </div>
            </div>
        </div>

    
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    
    <script>

/*-----------------------------------------------------------------------GRAFICO 1----------------------------------------------------------------------------------------------------*/
var barGraph, phGraph, turGraph, conGraph;

$(document).ready(function () {
    // Inicializar el gráfico de temperatura con datos iniciales
    $.post("temperatura.php", function (data) {
        var temps = [];
        for (var k = 0; k <= 9; k++) {
            temps[k] = data[k].temperatura;
        }
        temps.reverse();
        initializeTemperatureChart(temps);

        // Actualizar los datos del gráfico de temperatura cada 1 segundo
        setInterval(fetchAndUpdateTemperatureChart, 1000);
    });

    // Funciones para inicializar y actualizar el gráfico de temperatura
    function initializeTemperatureChart(temps) {
        var ctx = $("#temperaturas")[0].getContext("2d");

        var gradient = ctx.createLinearGradient(0, 0, 0, 225);
        gradient.addColorStop(0, 'rgba(73, 226, 255, 0.6)');
        gradient.addColorStop(1, 'rgba(12,0,36,255)');

        var chartdata = {
            labels: temps.map((_, index) => `T-${index + 1}`),
            datasets: [{
                label: "TEMPERATURA",
                backgroundColor: gradient,
                borderColor: "#46d5f1",  // Color azul inicial
                hoverBackgroundColor: "#CCCCCC",
                hoverBorderColor: "#666666",
                data: temps,
                fill: true,
                pointStyle: "circle",
                pointRadius: 4,
                pointHoverRadius: 5,
                lineTension: 0.4
            }]
        };

        barGraph = new Chart(ctx, {
            type: 'line',
            data: chartdata,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true,
                            color: 'rgba(255, 255, 255, 0.2)'
                        },
                        ticks: {
                            color: '#ffffff'
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            callback: function (value) {
                                return value + '°C';
                            },
                            color: '#ffffff'
                        },
                        gridLines: {
                            display: true,
                            color: 'rgba(255, 255, 255, 0.2)'
                        }
                    }]
                },
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#ffffff'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return context.dataset.label + ': ' + context.raw + '°C';
                            }
                        }
                    }
                },
              
            }
        });
    }


    function updateTemperatureChart(temps) {
        temps.reverse();
        barGraph.data.labels = temps.map((_, index) => `T-${index + 1}`);
        barGraph.data.datasets[0].data = temps;
        barGraph.update();
    }

    function fetchAndUpdateTemperatureChart() {
        $.post("temperatura.php", function (data) {
            var temps = [];
            for (var k = 0; k <= 9; k++) {
                temps[k] = data[k].temperatura;
            }
            updateTemperatureChart(temps);
        });
    }

    // Función para mostrar los datos principales
    function showGraph() {
        $.post("data.php", function (data) {
            var name = [];
            name.push(data[0].TEMPERATURA);
            name.push(data[0].PH);
            name.push(data[0].TURBIDEZ);
            name.push(data[0].CONDUCTIVIDAD);
            document.getElementById("temp").innerText = name[0];
            document.getElementById("ph").innerText = name[1];
            document.getElementById("turb").innerText = name[2];
            document.getElementById("cond").innerText = name[3];
        });
    }

    // Actualizar los datos superiores cada segundo
    setInterval(showGraph, 1000);
});

    
/*-----------------------------------------------------------------------GRAFICO 2----------------------------------------------------------------------------------------------------*/


var phGraph;

$(document).ready(function () {
    // Inicializar el gráfico con datos iniciales
    $.post("ph.php", function (data) {
        var temps = [];
        for (var k = 0; k <= 9; k++) {
            temps[k] = data[k].ph;
        }
        temps.reverse();  // Invertir los datos para que el último esté a la derecha
        initializeChart(temps);

        // Actualizar los datos del gráfico cada 5 segundos
        setInterval(fetchAndUpdateChart, 1000);

        // Llamar a la función graficos() para manejar otros datos
        graficos();
    });
    
    function graficos() {

        phs();
    }

function phs() {
            // El método de actualización ahora está manejado por `fetchAndUpdateChart`
        }

        function initializeChart(temps) {
            var ctx = $("#phs")[0].getContext("2d");

            // Crear un gradiente
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, 'rgba(73, 226, 255, 0.6)');  // Color superior más opaco
            gradient.addColorStop(1, 'rgba(12,0,36,255)');  // Color inferior más transparente

            var chartdata = {
                labels: temps,  // Las etiquetas para el eje X
                datasets: [
                    {
                        label: "PH",
                        backgroundColor: gradient,  // Usar el gradiente como fondo
                        borderColor: "#46d5f1",
                        hoverBackgroundColor: "#CCCCCC",
                        hoverBorderColor: "#666666",
                        data: temps,
                        fill: true,  // Asegúrese de que esto esté en true
                        pointStyle: "circle",
                        pointRadius: 4,
                        pointHoverRadius: 5,
                        lineTension: 0.4,
                    }
                ]
            };
            

            phGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Para permitir el ajuste del tamaño
                    scales: {
                xAxes: [{
                    gridLines: {
                        display: true, // Mostrar las líneas de cuadrícula en el eje X
                        color: 'rgba(255, 255, 255, 0.2)', // Color de las líneas de cuadrícula
                        lineWidth: 1 // Grosor de las líneas de cuadrícula
                    },
                    ticks: {
                        color: '#ffffff' // Color de los ticks del eje X
                    }
                }],
                yAxes: [{
                    ticks: {
                        /*min: -10,  // Valor mínimo del rango en el eje Y
                        max: 40,   // Valor máximo del rango en el eje Y
                        stepSize: 10,  // Intervalo entre los ticks del eje Y*/
                        callback: function(value) {
                            return value + '°C';  // Añadir unidad a los ticks
                        },
                        color: '#ffffff' // Color de los ticks del eje Y
                    },
                    gridLines: {
                        display: true, // Mostrar las líneas de cuadrícula en el eje Y
                        color: 'rgba(255, 255, 255, 0.2)', // Color de las líneas de cuadrícula
                        lineWidth: 1 // Grosor de las líneas de cuadrícula
                    }
                }]
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#ffffff' // Color del texto de la leyenda (ajústalo según tu tema)
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw + '°C';
                        }
                    }
                }
            }
        }
    });
}
        function updateChart(temps) {
            temps.reverse(); // Invertir los datos también al actualizar
            phGraph.data.labels = temps;
            phGraph.data.datasets[0].data = temps;
            phGraph.update();
        }

        function fetchAndUpdateChart() {
            $.post("ph.php", function (data) {
                var temps = [];
                for (var k = 0; k <= 9; k++) {
                    temps[k] = data[k].ph;
                }
                updateChart(temps);
            });
        }
    
    });
    


/*-----------------------------------------------------------------------GRAFICO 3----------------------------------------------------------------------------------------------------*/


var turGraph;

$(document).ready(function () {
    // Inicializar el gráfico con datos iniciales
    $.post("turbidez.php", function (data) {
        var temps = [];
        for (var k = 0; k <= 9; k++) {
            temps[k] = data[k].turbidez;
        }
        temps.reverse();  // Invertir los datos para que el último esté a la derecha
        initializeChart(temps);

        // Actualizar los datos del gráfico cada 5 segundos
        setInterval(fetchAndUpdateChart, 1000);

        // Llamar a la función graficos() para manejar otros datos
        graficos();
    });
    
    function graficos() {

        turbidezz();
    }

function turbidezz() {
            // El método de actualización ahora está manejado por `fetchAndUpdateChart`
        }

        function initializeChart(temps) {
            var ctx = $("#turbidezz")[0].getContext("2d");

            // Crear un gradiente
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, 'rgba(73, 226, 255, 0.6)');  // Color superior más opaco
            gradient.addColorStop(1, 'rgba(12,0,36,255)');  // Color inferior más transparente

            var chartdata = {
                labels: temps,  // Las etiquetas para el eje X
                datasets: [
                    {
                        label: "TURBIDEZ",
                        backgroundColor: gradient,  // Usar el gradiente como fondo
                        borderColor: "#46d5f1",
                        hoverBackgroundColor: "#CCCCCC",
                        hoverBorderColor: "#666666",
                        data: temps,
                        fill: true,  // Asegúrese de que esto esté en true
                        pointStyle: "circle",
                        pointRadius: 4,
                        pointHoverRadius: 5,
                        lineTension: 0.4,
                    }
                ]
            };
            

            turGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Para permitir el ajuste del tamaño
                    scales: {
                xAxes: [{
                    gridLines: {
                        display: true, // Mostrar las líneas de cuadrícula en el eje X
                        color: 'rgba(255, 255, 255, 0.2)', // Color de las líneas de cuadrícula
                        lineWidth: 1 // Grosor de las líneas de cuadrícula
                    },
                    ticks: {
                        color: '#ffffff' // Color de los ticks del eje X
                    }
                }],
                yAxes: [{
                    ticks: {
                        /*min: -10,  // Valor mínimo del rango en el eje Y
                        max: 40,   // Valor máximo del rango en el eje Y
                        stepSize: 10,  // Intervalo entre los ticks del eje Y*/
                        callback: function(value) {
                            return value + '°C';  // Añadir unidad a los ticks
                        },
                        color: '#ffffff' // Color de los ticks del eje Y
                    },
                    gridLines: {
                        display: true, // Mostrar las líneas de cuadrícula en el eje Y
                        color: 'rgba(255, 255, 255, 0.2)', // Color de las líneas de cuadrícula
                        lineWidth: 1 // Grosor de las líneas de cuadrícula
                    }
                }]
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#ffffff' // Color del texto de la leyenda (ajústalo según tu tema)
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw + '°C';
                        }
                    }
                }
            }
        }
    });
}

        function updateChart(temps) {
            temps.reverse(); // Invertir los datos también al actualizar
            turGraph.data.labels = temps;
            turGraph.data.datasets[0].data = temps;
            turGraph.update();
        }

        function fetchAndUpdateChart() {
            $.post("turbidez.php", function (data) {
                var temps = [];
                for (var k = 0; k <= 9; k++) {
                    temps[k] = data[k].turbidez;
                }
                updateChart(temps);
            });
        }
    
    });
    



    /*-----------------------------------------------------------------------GRAFICO 4----------------------------------------------------------------------------------------------------*/


var conGraph;

$(document).ready(function () {
    // Inicializar el gráfico con datos iniciales
    $.post("conductividad.php", function (data) {
        var temps = [];
        for (var k = 0; k <= 9; k++) {
            temps[k] = data[k].conductividad;
        }
        temps.reverse();  // Invertir los datos para que el último esté a la derecha
        initializeChart(temps);

        // Actualizar los datos del gráfico cada 5 segundos
        setInterval(fetchAndUpdateChart, 1000);

        // Llamar a la función graficos() para manejar otros datos
        graficos();
    });
    
    function graficos() {

        conductividads();
    }

function conductividads() {
            // El método de actualización ahora está manejado por `fetchAndUpdateChart`
        }

        function initializeChart(temps) {
            var ctx = $("#conductividads")[0].getContext("2d");

            // Crear un gradiente
            var gradient = ctx.createLinearGradient(0, 0, 0, 225);
            gradient.addColorStop(0, 'rgba(73, 226, 255, 0.6)');  // Color superior más opaco
            gradient.addColorStop(1, 'rgba(12,0,36,255)');  // Color inferior más transparente

            var chartdata = {
                labels: temps,  // Las etiquetas para el eje X
                datasets: [
                    {
                        label: "CONDUCTIVIDAD",
                        backgroundColor: gradient,  // Usar el gradiente como fondo
                        borderColor: "#46d5f1",
                        hoverBackgroundColor: "#CCCCCC",
                        hoverBorderColor: "#666666",
                        data: temps,
                        fill: true,  // Asegúrese de que esto esté en true
                        pointStyle: "circle",
                        pointRadius: 4,
                        pointHoverRadius: 5,
                        lineTension: 0.4,
                    }
                ]
            };
            

            conGraph = new Chart(ctx, {
                type: 'line',
                data: chartdata,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Para permitir el ajuste del tamaño
                  scales: {
                xAxes: [{
                    gridLines: {
                        display: true, // Mostrar las líneas de cuadrícula en el eje X
                        color: 'rgba(255, 255, 255, 0.2)', // Color de las líneas de cuadrícula
                        lineWidth: 1 // Grosor de las líneas de cuadrícula
                    },
                    ticks: {
                        color: '#ffffff' // Color de los ticks del eje X
                    }
                }],
                yAxes: [{
                    ticks: {
                        /*min: -10,  // Valor mínimo del rango en el eje Y
                        max: 40,   // Valor máximo del rango en el eje Y
                        stepSize: 10,  // Intervalo entre los ticks del eje Y*/
                        callback: function(value) {
                            return value + '°C';  // Añadir unidad a los ticks
                        },
                        color: '#ffffff' // Color de los ticks del eje Y
                    },
                    gridLines: {
                        display: true, // Mostrar las líneas de cuadrícula en el eje Y
                        color: 'rgba(255, 255, 255, 0.2)', // Color de las líneas de cuadrícula
                        lineWidth: 1 // Grosor de las líneas de cuadrícula
                    }
                }]
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        color: '#ffffff' // Color del texto de la leyenda (ajústalo según tu tema)
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ' + context.raw + '°C';
                        }
                    }
                }
            }
        }
    });
}
        function updateChart(temps) {
            temps.reverse(); // Invertir los datos también al actualizar
            conGraph.data.labels = temps;
            conGraph.data.datasets[0].data = temps;
            conGraph.update();
        }

        function fetchAndUpdateChart() {
            $.post("conductividad.php", function (data) {
                var temps = [];
                for (var k = 0; k <= 9; k++) {
                    temps[k] = data[k].conductividad;
                }
                updateChart(temps);
            });
        }
    
    });




function updateLights() {
    // Obtener los valores de los sensores
    var temperatura = parseFloat(document.querySelector('#temp').textContent);
    var ph = parseFloat(document.querySelector('#ph').textContent);
    var turbidez = parseFloat(document.querySelector('#turb').textContent);
    var conductividad = parseFloat(document.querySelector('#cond').textContent);

    // Cambiar luces según los valores
    var tempLight = document.getElementById('temp-light');
    if (temperatura > 25) {
        tempLight.classList.remove('green');
        tempLight.classList.add('red');
    } else if (temperatura < 20) {
        tempLight.classList.remove('red');
        tempLight.classList.add('green');
    }

    var phLight = document.getElementById('ph-light');
    if (ph > 7) {
        phLight.classList.remove('green');
        phLight.classList.add('red');
    } else {
        phLight.classList.remove('red');
        phLight.classList.add('green');
    }

    var turbLight = document.getElementById('turb-light');
    if (turbidez > 10) {
        turbLight.classList.remove('green');
        turbLight.classList.add('red');
    } else {
        turbLight.classList.remove('red');
        turbLight.classList.add('green');
    }

    var condLight = document.getElementById('cond-light');
    if (conductividad > 1500) {
        condLight.classList.remove('green');
        condLight.classList.add('red');
    } else {
        condLight.classList.remove('red');
        condLight.classList.add('green');
    }
}

setInterval(updateLights, 1000); // Actualizar cada segundo


</script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=99c003fa89398340e3d8f90406f57bdc"></script>



    
</body>

</html>