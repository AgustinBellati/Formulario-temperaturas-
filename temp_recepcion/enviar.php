<?php
 session_start();
  include('../conexion.php');
    //recojo las variables
    $codigo=$_REQUEST['codigo'];
    $descripcion=$_REQUEST['descripcion'];
    $id_proveedor=$_REQUEST['proveedor'];
    $temperatura=$_REQUEST['temperatura'];
    $resultado=$_REQUEST['resultado'];
    $notificar=0;

    $usuario=$_SESSION["nbr"];

    //Evaluando el resultado
    //Vamos a evaluar el driver de temperaturas [crear un crud para drv_temperaturas]

   
    if($temperatura>=3){
      //El resultado fue no conforma
     echo"<script>alert('Welcome to Geeks for Geeks')</script>;";
      $resultado=1;
      $notificar=1;
    }

    //Obtener los datos del proveedor.
    $proveedor;
    $cons3="SELECT proveedor, id_proveedor  FROM proveedores_grl WHERE id_proveedor='$id_proveedor'" ;
    $sql2=$conexion->query($cons3) or die("error ! ".mysqli_error($conexion));
    if($row=$sql2->fetch_assoc()){
      $proveedor=$row['proveedor'];
    }


    //Cargo en varibles fecha y hora
    date_default_timezone_set('America/Montevideo'); 
    $time = time(); 
    $hoy = date("Y-m-d", $time); 
    $ahora = date("Y-m-d H:i:s", $time);

  

    $_SESSION['msg']="Error al insertar los datos.";
    $_SESSION['msg_color']="alert-primary";
    var_dump($_REQUEST);

if($_POST['linea']){
$linea=$_POST['linea'];
$cons1="UPDATE `temperatura_recep` SET `codigo`='$codigo', `descripcion`='$descripcion', `proveedor`='$proveedor', `temperatura`='$temperatura', `resultado`='$resultado' WHERE linea=$linea";

$sql=$conexion->query($cons1) or die("Error al realizar la insercion en la db ".mysqli_error($conexion));
$_SESSION['msg']=($notificar==1)?"PRODUCTO FUERA DE RANGO, NO RECIBIR":"PRODUCTO DENTRO DEL RANGO";
$_SESSION['msg_color']=($notificar==1)?"alert-danger":"alert-success";
$_SESSION['msg_urgente']=($notificar==1)?"1":"0";
header("location:index.php");

}else{
  if (  isset($_POST["codigo"],
        $_POST["descripcion"],
        $_POST["proveedor"])
        and $_POST["temperatura"])
      {
    
        $cons3="SELECT proveedor, id_proveedor  FROM temperatura_recep WHERE proveedor='$proveedor'" ;
        $sql2=$conexion->query($cons3) or die("error ! ".mysqli_error($conexion));
        if ($row1=$sql2->fetch_assoc()) {
          $proveedor=$row1['proveedor'];
        }

        //Preparamos la orden SQL  
        $cons1="INSERT INTO tisolici_tinglesa_auditoria.temperatura_recep (codigo, descripcion, id_proveedor, proveedor, temperatura, resultado, fecha, usuario, notificar, ej, estado) VALUES ($codigo, '$descripcion', '$id_proveedor', '$proveedor', $temperatura, '$resultado', '$hoy', '$usuario', '$notificar', '$ahora', 1);";
        
        //meter los datos en la tabla
        $sql=$conexion->query($cons1) or die("Error al realizar la insercion en la db ".mysqli_error($conexion));
      
      
      
     

        $_SESSION['msg']=($notificar==1)?"PRODUCTO FUERA DE RANGO, NO RECIBIR":"PRODUCTO DENTRO DEL RANGO";
        $_SESSION['msg_color']=($notificar==1)?"alert-danger":"alert-success";
        $_SESSION['msg_urgente']=($notificar==1)?"1":"0";
        header("location:index.php");
      
  
      }
      elseif($_POST['codigo']){
        session_start();
        $_SESSION['msg']="CARGANDO DATOS";
        $_SESSION['msg_color']="alert-primary";
        header("location:index.php?codigo=".$_POST['codigo']."&proveedor=".$_POST['proveedor']);
      }

    
    
  else{
        $_SESSION['msg']="Faltan datos!";
        $_SESSION['msg_color']="alert-danger";
        header("location:index.php");
      }
  }
