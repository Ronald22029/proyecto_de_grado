<?php
header('Content-Type: application/json');

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

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);

$conn->close();
?>
