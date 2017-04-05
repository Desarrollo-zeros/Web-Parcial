<?php
require "../Parcial/DB/database.php";
$id = null;
if(!empty($_GET['ID']))
    $id = $_REQUEST['ID'];
if($id==null)
    header("Location:http://localhost/U/Parcial/new.php");
if(!empty($_POST)) {
    $ProductoError = null;
    $CantidadError = null;
    $ValorError = null;

    $Producto = $_POST['Producto'];
    $Cantidad = $_POST['Cantidad'];
    $Valor = $_POST['Valor'];

    $valid = true;
    if(empty($Producto)) {
        $ProductoError = "Por favor ingrese el Producto Valido";
        $valid = false;
    }
    if(empty($Cantidad)) {
        $CantidadError = "Por favor ingrese La Cantidad Validad";
        $valid = false;
    }

    if(empty($Valor)) {
        $CantidadError = "Por favor ingrese El Valor Valido";
        $valid = false;
    }


    if($valid) {
        try {
            $conn = Database::connect();
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("UPDATE Compras SET Producto= :Producto, Cantidad= :Cantidad, Valor= :Valor WHERE IDProducto= :IDProducto");
            $stmt->execute(array(":Producto"=>$Producto,":Cantidad"=>$Cantidad,":Valor"=>$Valor,":IDProducto"=>$id));
            Database::disconnect();
            header("Location:http://localhost/U/Parcial/new.php");
        } catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }
}else{
    $conn = Database::connect();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM Compras";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array($id));
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    $Producto = $data['Producto'];
    $Cantidad = $data['Cantidad'];
    $Valor = $data['Valor'];
    Database::disconnect();
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
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="col-md-offset-2">
            <h3>Actualizar Producto</h3>
        </div>
        <form class="form-horizontal" action="http://localhost/U/Parcial/Update.php?ID=<?php echo $id ?>" method="post">
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
            </div>
            <div class="col-md-offset-5">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a class="btn" href="http://localhost/U/Parcial/Update.php">Inicio</a>
            </div>
        </form>
    </div>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>