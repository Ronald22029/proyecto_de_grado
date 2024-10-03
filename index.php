<?php
include ("conexion.php");
$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if ($conexion == false) {
    die("Error de conexion" . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>PROYECTO DE GRADO</title>
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
</head>
<body>
    <section>
        <div class="login-container">
            
            <h2>CONTROL DE CALIDAD</h2>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $nombres = $_POST["nombres"];
                    $pass = $_POST["password"];
                    $sql = mysqli_query($conexion, "select cargo from usuarios where nombres = '$nombres' and password = '$pass'; ");
                    if (mysqli_num_rows($sql) > 0) {
                        $row = mysqli_fetch_array($sql);
                        $cargo = $row["cargo"];
                        if ($cargo == 'ADMINISTRADOR') {
                            echo "<div class='alert alert-success' role='alert'>
                                <strong>Datos Correctos</strong>
                            </div>";
                            echo "<script>var delay = 2000; setTimeout(function(){ window.location = 'principal.php'; }, delay);</script>";
                        }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>
                            <strong>Datos Incorrectos</strong>
                        </div>";
                        echo "<script>var delay = 2000; setTimeout(function(){ window.location = 'index.php'; }, delay);</script>";
                    }
                }
            ?>
            <form class="user" method="post" action="index.php">
                <div class="form-group">
                    <input class="form-control form-control-user" type="text" placeholder="Nombre Completo" name="nombres" onkeyup='this.value=this.value.toUpperCase();'> 
                </div>
                <div class="form-group">
                    <input class="form-control form-control-user" type="password" placeholder="Contraseña" name="password">
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox small"></div>
                </div>
                <button class="btn btn-primary btn-block text-white btn-user" type="submit" style="background: rgb(21,76,121);"><i class="fa fa-user"></i> Iniciar Sesión</button>
                <hr>
            </form>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
</body>
</html>
