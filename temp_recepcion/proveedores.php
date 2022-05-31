<?php
    
    $proveedores=$_REQUEST['option'];

    $cons3="SELECT proveedor, id_proveedor  FROM proveedores_grl" ;
    $sql2=$conexion->query($cons3) or die("error ! ".mysqli_error($conexion));

?>