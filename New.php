<?php
/**
 * Created by PhpStorm.
 * User: zeros
 * Date: 21/3/2017
 * Time: 07:07
 */
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Proyect gamersz</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<script type="text/javascript">
</script>
<body>
<div class="container">
    <div class="row">
        <h3>Proyecto Gamerzs</h3>
    </div>
    <div class="row">
        <p>
            <a href="http://localhost/U/Parcial/Agregar.php" class="btn btn-success">Crear</a>
            <a href="http://localhost/U/Parcial/index.php" class="btn btn-success">Inicio</a>
        </p>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>IDProducto</th>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Valor</th>
                <th>Iva</th>
                <th>Descuento</th>
                <th>Total</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $Iva = null;
            $Descuento = null;
            $Valor = null;

            require "../Parcial/DB/database.php";
            $pdo = Database::connect();
            $sql = "SELECT * FROM Compras";
            $reault = $pdo->query($sql,PDO::FETCH_ASSOC);
            foreach ($reault as $row) {
                echo '<td>'.$row['IDProducto'].'</td>';
                echo '<td>'.$row['Producto'].'</td>';
                echo '<td>'.$row['Cantidad'].'</td>';
                echo '<td>'.$row['Valor'].'</td>';
                if($row['Valor']<300000){
                    $Valor = $row['Cantidad'] * $row['Valor'];
                    $Iva = $row['Valor']*0.19; //iva
                    //$Descuento = $Valor * 0.15;
                    $Total = $Valor+$Iva;


                }
                else{
                    $Valor = $row['Cantidad'] * $row['Valor']; //Valor Total
                    $Iva = $row['Valor']*0.19; //iva
                    $Descuento = $row['Valor'] * 0.15;
                    $Total = $Valor + $Iva;
                    $Total = $Total - $Descuento;
                }
                echo '<td>'.$Iva.'</td>';
                echo '<td>'.$Descuento.'</td>';
                echo '<td>'.$Total.'</td>';
                echo '<td width=250><a class="btn btn-primary btn-sm" href="http://localhost/U/Parcial/Leer.php?ID='.$row['IDProducto'].'">Leer</a>';
                echo '  <a class="btn btn-success btn-sm" href="http://localhost/U/Parcial/update.php?ID='.$row['IDProducto'].'">Actualizar</a>';
                echo '  <a class="btn btn-danger btn-sm" href="http://localhost/U/Parcial/Delete.php?ID='.$row['IDProducto'].'">Eliminar</a>';  echo '</td>';
                echo '</tr>';
            }
            Database::disconnect();
            ?>
</tbody>
</table>
</div>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>