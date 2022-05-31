<?php

    //recojo las variables
    $codigo=$_REQUEST['codigo'];
    $descripcion=$_REQUEST['descripcion'];
    $proveedor=$_REQUEST['proveedor'];
    $temperatura=$_REQUEST['temperatura'];
    $resultado=$_REQUEST['resultado'];
  
    

    $cons2="SELECT * FROM temperatura_recep where estado=1 order by linea desc";
    $sql=$conexion->query($cons2) or die("error ! ".mysqli_error($conexion));
    
?>