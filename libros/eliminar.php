<?php

require_once("../conexion.php");

$id = $_GET['id'];

$query  = "DELETE FROM libros WHERE id = $id";
$result = mysqli_query($con, $query) or die(mysqli_error($con));

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php if ($result) { ?>
            <p>Registro Eliminado</p>
        <?php } else { ?>
            <p>Registro no Eliminado</p>
        <?php } ?>

        <a href="../index.php">REGRESAR</a>
    
</body>
</html>