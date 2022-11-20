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
    <div class="container">
        <div>
            <div>
                <h3>Ingrese los datos actualizados del libro...</h3>
                <form action="guardar.php" method="post" autocomplete="off">
                    <input type="hidden" name="id" value="<?= $persona['id']; ?>">
                    <div class="mb-3">
                        <label for="titulo" >Título</label>
                        <input type="text"  id="titulo" name="titulo" value="<?= $persona['titulo']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" >Autor</label>
                        <select id="id_autor" name="id_autor"  required>
                            <?php foreach ($autores as $autor) : ?>
                                <option value="<?= $autor['id'] ?>" <?= $autor['id'] == $libro['id_autor'] ? 'selected' : '' ?>><?= $autor['autor'] ?></option>";
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div >
                        <label >¿Se encuentra disponible?</label>
                        <select class="form-select" id="disponible" name="disponible" aria-label="Selector de estado del libro" required>
                            <option value="1" <?= $persona['disponible'] == 1 ? 'selected' : ''; ?>>Si</option>
                            <option value="0" <?= $persona['disponible'] == 0 ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                    <input  type="submit" value="Guardar">
                    <a href="../index.php">Regresar</a>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>