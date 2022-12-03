<?php

include_once('../conexion.php');
$id = $_GET['id'];

$query = "SELECT id, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS autor FROM personas WHERE id_rol = 1 AND estado = 1";
$autores = mysqli_query($con, $query) or die(mysqli_error($con));

$query  = "SELECT * FROM personas WHERE id = $id";
$result = mysqli_query($con, $query) or die(mysqli_error($con));
$libro  = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <title>Biblioteca - Editar Libro</title>
</head>

<body>
    <div class="link">
        <a href="../index.php">Inicio</a>
    </div>
    <div class="contenedor2">
        <form action="guardar.php" method="post" autocomplete="off">
            <label for="primer_nombre">Primer nombre</label>
            <input type="text" id="primer_nombre" name="primer_nombre" required>
            <br><br>
            <label for="segundo_nombre">Segundo nombre</label>
            <input type="text" id="segundo_nombre" name="segundo_nombre">
            <br><br>
            <label for="primer_apellido">Primer apellido</label>
            <input type="text" id="primer_apellido" name="primer_apellido" required>
            <br><br>
            <label for="segundo_apellido">segundo apellido</label>
            <input type="text" id="segundo_apellido" name="segundo_apellido">
            <br><br>
            <label for="email">Correo electronico</label>
            <input type="mail" name="email" id="email" required>
            <br><br>
            <label for="rol" class="form-label">Rol</label>
            <select id="id_rol" name="id_rol" required>
                <option selected>Seleccione una Opcion...</option>
                <?php foreach ($roles as $rol) : ?>
                    <option value="<?= $rol['id'] ?>"><?= $rol['nombre']  ?></option>";
                <?php endforeach ?>
            </select>
            <input type="submit" value="Guardar">
            <a href="../index.php">Regresar</a>
        </form>
    </div>
    </div>
    </div>
    </div>
</body>

</html>