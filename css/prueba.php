<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfico</title>
    <style>
        .chart-container {
            background-color: #161B22; /* Color azul marino */
            padding: 20px; /* Ajusta el padding según sea necesario */
            border-radius: 10px; /* Ajusta el borde redondeado según sea necesario */
        }

        /* Asegúrate de que el canvas ocupe todo el contenedor */
        #temperaturas {
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-lg-7 col-xl-8">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Earnings Overview</h6>
                    <div class="dropdown no-arrow">
                        <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button">
                            <i class="fas fa-ellipsis-v text-gray-400"></i>
                        </button>
                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                            <p class="text-center dropdown-header">dropdown header:</p>
                            <a class="dropdown-item" href="#">&nbsp;Action</a>
                            <a class="dropdown-item" href="#">&nbsp;Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">&nbsp;Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="temperaturas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5 col-xl-4">
            <div class="card shadow mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="text-primary font-weight-bold m-0">Revenue Sources</h6>
                    <div class="dropdown no-arrow">
                        <button class="btn btn-link btn-sm dropdown-toggle" aria-expanded="false" data-toggle="dropdown" type="button">
                            <i class="fas fa-ellipsis-v text-gray-400"></i>
                        </button>
                        <div class="dropdown-menu shadow dropdown-menu-right animated--fade-in">
                            <p class="text-center dropdown-header">dropdown header:</p>
                            <a class="dropdown-item" href="#">&nbsp;Action</a>
                            <a class="dropdown-item" href="#">&nbsp;Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">&nbsp;Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas data-bss-chart="{&quot;type&quot;:&quot;doughnut&quot;,&quot;data&quot;:{&quot;labels&quot;:[&quot;Direct&quot;,&quot;Social&quot;,&quot;Referral&quot;],&quot;datasets&quot;:[{&quot;label&quot;:&quot;&quot;,&quot;backgroundColor&quot;:[&quot;#4e73df&quot;,&quot;#1cc88a&quot;,&quot;#36b9cc&quot;],&quot;borderColor&quot;:[&quot;#ffffff&quot;,&quot;#ffffff&quot;,&quot;#ffffff&quot;],&quot;data&quot;:[&quot;50&quot;,&quot;30&quot;,&quot;15&quot;]}]},&quot;options&quot;:{&quot;maintainAspectRatio&quot;:false,&quot;legend&quot;:{&quot;display&quot;:false},&quot;title&quot;:{}}}"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var barGraph;

        $(document).ready(function () {
            // Inicializar el gráfico con datos iniciales
            $.post("temperatura.php", function (data) {
                var temps = [];
                for (var k = 0; k <= 9; k++) {
                    temps[k] = data[k].temperatura;
                }
                temps.reverse();  // Invertir los datos para que el último esté a la derecha
                initializeChart(temps);

                // Actualizar los datos del gráfico cada 5 segundos
                setInterval(fetchAndUpdateChart, 5000);

                // Llamar a la función graficos() para manejar otros datos
                graficos();
            });

            function graficos() {
                showGraph();
                temperaturas();
            }

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

            function temperaturas() {
                // El método de actualización ahora está manejado por `fetchAndUpdateChart`
            }

            function initializeChart(temps) {
                var ctx = $("#temperaturas")[0].getContext("2d");

                // Crear un gradiente
                var gradient = ctx.createLinearGradient(0, 0, 0, 400);
                gradient.addColorStop(0, 'rgba(73, 226, 255, 0.6)');  // Color superior más opaco
                gradient.addColorStop(1, 'rgba(73, 226, 255, 0.1)');  // Color inferior más transparente

                var chartdata = {
                    labels: temps,  // Las etiquetas para el eje X
                    datasets: [
                        {
                            label: "TEMPERATURA",
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

                barGraph = new Chart(ctx, {
                    type: 'line',
                    data: chartdata,
                    options: {
                        responsive: true,
                        maintainAspectRatio: false, // Para permitir el ajuste del tamaño
                        scales: {
                            x: {
                                beginAtZero: false,
                                reverse: false // Asegúrate de que esto esté en false
                            },
                            y: {
                                beginAtZero: false
                            }
                        },
                        plugins: {
                            backgroundColor: '#161B22'  // Color azul marino para el fondo del gráfico
                        }
                    }
                });
            }

            function updateChart(temps) {
                temps.reverse(); // Invertir los datos también al actualizar
                barGraph.data.labels = temps;
                barGraph.data.datasets[0].data = temps;
                barGraph.update();
            }

            function fetchAndUpdateChart() {
                $.post("temperatura.php", function (data) {
                    var temps = [];
                    for (var k = 0; k <= 9; k++) {
                        temps[k] = data[k].temperatura;
                    }
                    updateChart(temps);
                });
            }
        });
    </script>
</body>
</html>
