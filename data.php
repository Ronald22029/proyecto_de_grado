<?php
    header('Content-Type: application/json');
    include ("conexion.php");
    $conexion=mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
    if($conexion==false)
    {
        die("Error connecting to database ".mysqli_connect_error());
    }
    
    $sql= "select * from lecturas order by id desc limit 1;";
    $result = mysqli_query($conexion,$sql);
    $data = array();
    foreach ($result as $row) {
        $data[] = $row;
    }
    mysqli_close($conexion);
    echo json_encode($data);

?>