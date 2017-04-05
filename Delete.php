<?php
require "../Parcial/DB/database.php";
$id = 0;
if(!empty($_GET['ID']))
    $id = $_REQUEST['ID'];
if(!empty($_POST)) {
    $id = $_POST['ID'];
    $conn = Database::connect();
    $sql = "DELETE FROM Compras WHERE IDProducto = :IDProducto";
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":IDProducto",$id);
    $stmt->execute();
    Database::disconnect();
    header("Location:http://localhost/U/Parcial/new.php");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-md-offset-2">
                <h3>Eliminar cliente</h3>
            </div>
        </div>
        <form class="form-horizontal" action="http://localhost/U/Parcial/Delete.php" method="post">
            <input type="hidden" name="ID" value="<?php echo $id ?>">
            <div class="form-group">
                <div class="alert alert-danger">
                    ¿Está seguro de eliminar el Producto?
                </div>
            </div>
            <div class="form-group">
                <button tyep="submit" class="btn btn-danger">Sí</button>
                <a href="http://localhost/U/Parcial/new.php" class="btn btn-default">No</a>
            </div>
        </form>
    </div>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
