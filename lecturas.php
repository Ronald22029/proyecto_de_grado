<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto_de_grado";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos de la solicitud POST
$temperatura = $_POST['T'];
$ph = $_POST['PH'];
$turbidez = $_POST['TURBIDEZ'];
$conductividad = $_POST['CONDUCTIVIDAD'];

// Preparar y ejecutar la consulta SQL
$sql = "INSERT INTO lecturas (TEMPERATURA, PH, TURBIDEZ, CONDUCTIVIDAD, FECHA, HORA) VALUES (?, ?, ?, ?, CURDATE(), CURTIME())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("dddd", $temperatura, $ph, $turbidez, $conductividad);

if ($stmt->execute()) {
    echo "Nuevo registro creado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Cerrar conexión
$stmt->close();
$conn->close();
?>
