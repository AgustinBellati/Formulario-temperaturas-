<?php

use Sabberworm\CSS\Property\Charset;

//Declaro las variables
$codigo;
$descripcion;
$proveedor;
$linea;



//Comprobamos que exista la variable GET codigo.
if(isset($_GET['codigo'])){
    //Comprobamos que lleguen las variables GET codigo y proveedor con datos
    if ($_REQUEST['codigo'] && $_REQUEST['proveedor']){
        
        $codigo=$_REQUEST['codigo'];
        $id_proveedor=$_REQUEST['proveedor'];

        //Consulto la DB
        $cons_llenado="SELECT * FROM articulossur WHERE codigo='$codigo' AND titular='$id_proveedor'";
        $sql_llenado=$conexion->query($cons_llenado) or die(mysqli_error($conexion));
        if($row=$sql_llenado->fetch_assoc()){

           
            $descripcion=$row['descripcion'];
            $proveedor=$row['proveedor'];
              
        
        }
        else{
            $msg="EL ARTICULO NO EXISTE PARA ESTE PROVEEDOR";
        }

    }
    else{
        $msg="FALTAN DATOS PARA REALIZAR LA CONSULTA";
    }

    //Cargo los mensajes en variables de session.
    session_start();
    $_SESSION['msg']=$msg;
    $_SESSION['msg_color']="alert-danger";

}

?>