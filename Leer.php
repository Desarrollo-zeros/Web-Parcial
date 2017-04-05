<?php
/**
 * Created by PhpStorm.
 * User: zeros
 * Date: 21/3/2017
 * Time: 07:03
 */
    require "../Parcial/DB/database.php";
	$id = null;
    $Total = null;
    $Iva = "0.19";
	if(!empty($_GET['ID']))
        $id = $_REQUEST['ID'];
	if($id==null)
        header("Location: http://localhost/U/Parcial/index.php");
    else {
        $conn = Database::connect();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM Compras WHERE IDProducto = :IDProducto");

        $stmt->bindParam(":IDProducto", $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="col-md-offset-2">
            <h2>Leer Producto</h2>
        </div>
        <div class="form-horizontal">
            <!--  Nombre -->
            <div class="form-group">
                <label class="control-label col-md-5" for="Producto">Producto</label>
                <div class="col-md-7">
                    <input type="text" id="Producto" value="<?php echo $data['Producto'] ?>" readonly>
                </div>
            </div>
            <!-- Correo -->
            <div class="form-group">
                <label class="control-label col-md-5" for="Cantidad">Cantidad</label>
                <div class="col-md-7">
                    <input type="text" id="Producto" value="<?php echo $data['Producto'] ?>" readonly>
                </div>
            </div>
            <!-- celular -->
            <div class="form-group">
                <label class="control-label col-md-5" for="Valor">Valor</label>
                <div class="col-md-7">
                    <input type="text" id="Valor" value="<?php echo $data['Valor'] ?>" readonly>
                </div>
            </div>

            <!-- celular -->
            <div class="form-group">
                <label class="control-label col-md-5" for="Total">Total A Pagar</label>
                <div class="col-md-7">
                    <input type="text" id="Total" value="<?php echo $Total ?>" readonly>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-offset-5">
                    <a href="http://localhost/U/Parcial/index.php"> <button  class="btn btn-info">Aceptar</button> </a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>