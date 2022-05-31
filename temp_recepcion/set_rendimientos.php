<?php
  session_start();
  include('../conexion.php');
  $acc=$_SESSION["acc"];
  if($acc==99 OR $acc==2  OR $acc==98 OR  $acc==1){}else{
      $_SESSION['msg']="NO TIENE PERMISOS PARA EDITAR O BORRAR DATOS.";
      $_SESSION['msg_color']="alert-danger";
      header('Location: index.php');
    }

$linea=$_GET['l'];
$tipo=$_GET['t'];
//borra de la UI una linea de la tabla
if ($linea) {
    if($tipo==1){
        $cons3="UPDATE articulossur SET activo=0 WHERE linea=$linea";
        $sql2=$conexion->query($cons3) or die("error ! ".mysqli_error($conexion));
        $_SESSION['msg']="REGISTRO BORRADO";
        $_SESSION['msg_color']="alert-success";
        header('Location: index.php');
    }
}
?>