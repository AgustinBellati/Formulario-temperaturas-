<?php 
    require("get_table.php");
?>
               
<table class="table table-light table-striped table-sm table-hover">
    <thead>
    
    <th scope="col">Fecha</th>
    <th scope="col">Codigo</th>
    <th scope="col">Proveedor</th>
    <th scope="col">Descripcion</th>
    <th scope="col">Temperatura</th>
    <th scope="col">Resultado</th>
    <th scope="col">Usuario</th>
    <th></th>
</tr>
    </thead>

    <tbody>
     
          <?php 
              while($row=$sql->fetch_assoc()) {
                 
                $codigo=$row['codigo'];
                $id_proveedor=$row['id_proveedor'];
                $descripcion=$row['descripcion'];
                $temperatura=$row['temperatura'];
                $proveedor=$row['proveedor'];              
                $resultado=($row['resultado']==1)?"NO CONFORMA":"DENTRO DEL RANGO";              
                $fecha_db = date("d-m-Y H:i", strtotime($row['ej']));
                $usuario=$row['usuario']; 
                //$usuario= getUsuario($usuario);             

              echo "<tr>";
                echo "<td>$fecha_db</td>";
                echo "<td>$codigo</td>";
                echo "<td>$proveedor</td>";
                echo "<td>$descripcion</td>";
                echo "<td>$temperatura</td>";
                echo "<td>$resultado</td>";
                echo "<td>$usuario</td>";
              echo "</tr>";
           } 
           ?>
    
    
    </tbody>
</table>