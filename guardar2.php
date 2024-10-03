<?php
    include ("conexion.php");
    $conexion= mysqli_connect($dbhost, $dbuser, $dbpass, $dbname,);
    if($conexion==false)
    {
        die("Error de conexion".mysqli_connect_error());
    }
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
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" style="background: rgb(78, 115, 223);">
            <div class="container-fluid d-flex flex-column p-0"><a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="far fa-user"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>monitoreo</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item"><a class="nav-link" href="principal.php"><i class="fas fa-tachometer-alt"></i><span>Principal</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="index.php"><i class="far fa-user-circle"></i><span>Cerrar Seción</span></a></li>
                   
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-1">Registro de Usuarios</h3>
                </div>
                <?php
                    if($_SERVER["REQUEST_METHOD"]=="POST")
                    {
                        $usuario=$_POST["usuario"];
                        $nombres=$_POST["nombres"];
                        $password=$_POST["password"];
                        $carnet=$_POST["carnet"];
                        $telefono=$_POST["telefono"];
                        $cargo=$_POST["cargo"];
                        $sql="update usuarios set nombres='$nombres',password='$password',carnet='$carnet',telefono='$telefono',cargo='$cargo'where nombres='$usuario';";
;
                        if(mysqli_query($conexion,$sql))
                        {
                            echo "<div class='alert alert-success' role='alert'>
                            <strong>Usuario Modificado</strong>
                            </div>" ;
                            
                        }
                        else
                        {
                            echo "<div class='alert alert-danger' role='alert'>
                            <strong>Error al Modificar Usuario</strong>
                            </div>" ;
                        }   

                    }
                  
                ?>
                  <div class="form-group row" style="margin-right: 6px;margin-left: 6px;">
                  <input class="form-control form-control-user" type="text" value="<?php echo $nombres; ?>" readonly="">
                  </div>
                  <div class="form-group row" style="margin-right: 6px;margin-left: 6px;">
                  <input class="form-control form-control-user" type="password" value="<?php echo $password; ?>" readonly="">
                  </div>
                  <div class="form-group row" style="margin-right: 6px;margin-left: 6px;">
                  <input class="form-control form-control-user" type="carnet" value="<?php echo $carnet; ?>" readonly="">
                  </div>
                  <div class="form-group row" style="margin-right: 6px;margin-left: 6px;">
                  <input class="form-control form-control-user" type="telefono" value="<?php echo $telefono; ?>" readonly="">
                  </div>
                  <div class="form-group row" style="margin-right: 6px;margin-left: 6px;">
                  <input class="form-control form-control-user" type="cargo" value="<?php echo $cargo; ?>" readonly="">
                  </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © PROYECTO DE GRADO 2024</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js?h=99c003fa89398340e3d8f90406f57bdc"></script>
</body>

</html>