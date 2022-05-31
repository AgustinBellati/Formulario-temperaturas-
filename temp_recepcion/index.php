<?php
session_start();
$acc = $_SESSION["acc"];
if ($acc == 99 or $acc == 2  or $acc == 98 or  $acc == 1 or $acc == 4 or $acc == 5 or $acc == 6 or $acc == 7 or $acc == 9 or $acc == 8 or $acc == 10 or $acc == 11 or $acc == 12) {
} else {
    header('Location:../index.php');
}

include('../conexion.php');
include('consulta.php');
require("funciones.php");


//Cargo en varibles fecha y hora
date_default_timezone_set('America/Montevideo'); 
$time = time(); 
$hoy = date("Y-m-d", $time); 
$ahora = date("Y-m-d H:i:s", $time);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>control de temperatura</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>

<body>
   
    <div class="container-fluid">
        <br>
        <div class="row">

            <div class="col-md-3">

                <div class="card">
                    <div class="card-header">
                        INGRESO DE TEMPERATURA
                        <!-- vector icono -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-snowflake" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#00abfb" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M10 4l2 1l2 -1m-2 -2v6.5l3 1.72" />
                            <path d="M10 4l2 1l2 -1m-2 -2v6.5l3 1.72" transform="rotate(60 12 12)" />
                            <path d="M10 4l2 1l2 -1m-2 -2v6.5l3 1.72" transform="rotate(120 12 12)" />
                            <path d="M10 4l2 1l2 -1m-2 -2v6.5l3 1.72" transform="rotate(180 12 12)" />
                            <path d="M10 4l2 1l2 -1m-2 -2v6.5l3 1.72" transform="rotate(240 12 12)" />
                            <path d="M10 4l2 1l2 -1m-2 -2v6.5l3 1.72" transform="rotate(300 12 12)" />
                        </svg>
                    </div>
                    <div class="card-body">
                        <form action="enviar.php" method="POST" enctype="multipart/form-data">
                            <?php
                            session_start();
                            if ($_SESSION['msg']) {
                                $msg = $_SESSION['msg'];
                                $color = $_SESSION['msg_color'];
                                echo "<div class='alert $color' role='alert'>" . strtoupper($msg) . "</div>";
                                $_SESSION['msg'] = null;
                                $_SESSION['msg_color'] = null;
                            }


                            $visible = ($proveedor) ? '' : 'd-none';


                            ?>


                            <fieldset <?php echo $bloqueo; ?>>

                                <!-- codigo -->
                                <div class="mb-3 row">
                                    <!-- <label for="codigo" class="col-sm-12 col-form-label">Codigo</label> -->
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control" name="codigo" id="codigo" placeholder="Ingrese codigo" value="<?php echo $codigo; ?>" <? $focus = ($proveedor) ? '' : 'autofocus';
                                                                                                                                                                        echo $focus; ?> required>
                                    </div>
                                </div>

                                <!-- proovedor -->
                                <div class="mb-3 row">
                                    <label for="proveedor" class="col-sm-12 col-form-label">Proveedor</label>
                                    <div class="col-sm-12 form-floating">
                                        <select name="proveedor" class="form-control" id="proveedor" placeholder="Ingrese la proveedor" required>
                                            <?php
                                            if ($proveedor && $id_proveedor) {
                                                echo "<option value='$id_proveedor' selected>$proveedor</option>";
                                            }
                                            include('proveedores.php');
                                            while ($row2 = $sql2->fetch_assoc()) {
                                                $id_proveedor = $row2['id_proveedor'];
                                                $proveedores = $row2['proveedor'];
                                                echo "<option name='option' value='$id_proveedor'>$proveedores</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <!-- descripcion -->
                                <div class="mb-3 row">
                                    <label for="descrpcion" class="col-sm-12 col-form-label pr <?php echo $visible; ?>">Descripción</label>
                                    <div class="col-sm-12">

                                        <input type="text" class="form-control <?php echo $visible; ?>" name="descripcion" id="descripcion" placeholder="Ingrese la descripción" value="<?php echo $descripcion; ?>">
                                    </div>
                                </div>




                                <!-- temperatura -->
                                <div class="mb-3 row">
                                    <label for="Temperatura" class="col-sm-12 col-form-label <?php echo $visible; ?>">Temperatura</label>
                                    <div class="col-sm-12">
                                        <input type="number" class="form-control <?php echo $visible; ?>" step="0.01" name="temperatura" id="temperatura" placeholder="Ingrese temperatura" value="<?php echo $temperatura; ?>" autofocus>
                                    </div>
                                    

                                    <!-- botones -->

                                    <div class="mb-12 row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <a href="../../index.php" class="btn btn-primary">INICIO</a>
                                            <a href="index.php" class="btn btn-danger">BORRAR</a>
                                            <button type='submit' class='btn btn-success'>
                                                <?php
                                                $boton = ($codigo) ? 'GUARDAR' : 'BUSCAR';
                                                echo $boton;
                                                ?>

                                            </button>

                                        </div>
                                    </div>


                            </fieldset>

                            <?php
                            if ($linea) {
                                echo "<input type='hidden' name='linea' value='$linea'";
                            }

                            ?>
                        </form>
                    </div>
                </div>
            </div>

<br><br><br>
            <div class="col-md-9">
                <br>
                <p>
                    <a class="btn btn-secondary" data-bs-toggle="collapse" href="#tabla" role="button" aria-expanded="false" aria-controls="tabla">
                        DATOS RECOPILADOS
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-download" width="40" height="40" viewBox="0 0 24 24" stroke-width="2" stroke="#00b341" fill="none" stroke-linecap="round" stroke-linejoin="round">
  <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
  <path d="M14 3v4a1 1 0 0 0 1 1h4" />
  <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
  <line x1="12" y1="11" x2="12" y2="17" />
  <polyline points="9 14 12 17 15 14" />
</svg>
                    </a>
                </p>
                <div class="collapse" id="tabla">
                    <div class="card card-body">
                        <?php include("tabla.php"); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
   
    <script src="js/run.js"></script>
</body>

</html>