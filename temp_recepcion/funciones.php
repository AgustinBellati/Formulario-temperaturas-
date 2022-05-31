<?php
    if(!$conexion){require("../conexion.php");}

    function  getUsuario($num){
        $conn=conectarse();
        $usuario_db=null;
        $error="USUARIO NO IDENTIFICADO";
        if ($num<>0) {
            $sql=$conn->query("SELECT * FROM usuarios WHERE numero=$num");
            if($row=$sql->fetch_assoc())
            {
                $usuario_db= strtoupper($row['numero']." ".$row['nombre']);
                return $usuario_db;

            }
        }
        return $error;
    }

?>