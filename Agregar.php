<?php
/**
 * Created by PhpStorm.
 * User: zeros
 * Date: 21/3/2017
 * Time: 06:25
 */
require "../Parcial/DB/database.php";
if(!empty($_POST)) {
    $ProductoError = null;
    $CantidadError = null;
    $ValorError = null;

    $Producto = $_POST['Producto'];
    $Cantidad = $_POST['Cantidad'];
    $Valor = $_POST['Valor'];


    $valid = true;
    if(empty($Producto)) {
        $usuarioError = "Por favor ingrese el nombre del producto correcto";
        $valid = false;
    }

    if (empty($Cantidad)){
        $CantidadError = "Ingrese una cantidad validad";
        $valid = false;
    }
    if (empty($Valor)){
        $Valor = "Ingrese un valor Valido";
    }

    if($valid) {
        try {
            $conn = Database::connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("INSERT INTO Compras (Producto, Cantidad,Valor) VALUES (:Producto, :Cantidad, :Valor)");
            $stmt->bindParam(":Producto", $Producto);
            $stmt->bindParam(":Cantidad", $Cantidad);
            $stmt->bindParam(":Valor", $Valor);
            $stmt->execute();
            Database::disconnect();
            echo "Pruducto Creado";
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<body background="../img/bg2.jpg">
<div class="alert alert-success">Parcial by: Carlos Andres Castilla Garcia</div>
<div class="container text-center">
    <div class="col-md-6 col-md-offset-2">
        <div class="col-md-offset-2">
            <h3>Crear Producto</h3>
        </div>
        <form class="form-horizontal" action="Agregar.php" method="post">

            <div class="form-group">
                <label class="control-label col-md-5" for="Producto">Producto</label>
                <div class="col-md-6">
                    <input class="form-control" id="Producto" name="Producto" type="txt" placeholder="Nombre del producto"
                           value="<?php echo !empty($Producto)?$Producto:'' ?>">
                    <?php if(!empty($ProductoError)): ?>
                        <div class="alert alert-danger"><?php echo $ProductoError; ?></div>
                    <?php endif;?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-5" for="Cantidad">Cantidad</label>
                <div class="col-md-7">
                    <input class="form-control" id="Cantidad" name="Cantidad" type="txt"
                           placeholder="Cantidad De producto"
                           value="<?php echo  !empty($Cantidad)?$Cantidad:'' ?>">
                    <?php if(!empty($CantidadError)): ?>
                        <div class="alert alert-danger"><?php echo $CantidadError; ?></div>
                    <?php endif;?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-5" for="Valor">Valor</label>
                <div class="col-md-7">
                    <input class="form-control" id="Valor" name="Valor" type="txt"
                           placeholder="Valor Del Producto"
                           value="<?php echo  !empty($Valor)?$Valor:'' ?>">
                    <?php if(!empty($ValorError)): ?>
                        <div class="alert alert-danger"><?php echo $ValorError; ?></div>
                    <?php endif;?>
                </div>
            </div>
                <button type="submit" class="text-center btn btn-success">Agregar Producto</button>
                <a href="http://localhost/U/Parcial/index.php"  <button type="submit" class="text-center  btn btn-success">Pagina Principal </button> </a>

        </form>
    </div>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="Parcial/js/bootstrap.min.js"></script>
</body>
</html>