<?php

include_once('../conexion.php');
$id = $_GET['id'];

$query = "SELECT id, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS autor FROM personas WHERE id_rol = 1 AND estado = 1";
$autores = mysqli_query($con, $query) or die(mysqli_error($con));

$query  = "SELECT * FROM libros WHERE id = $id";
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

    <title>Biblioteca - Editar Libro</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <h3>Ingrese los datos actualizados del libro...</h3>
                <form action="recibir.php" method="post" autocomplete="off">
                    <input type="hidden" name="id" value="<?= $libro['id']; ?>">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" class="form-control" id="titulo" name="titulo" value="<?= $libro['titulo']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <select class="form-select" id="id_autor" name="id_autor" aria-label="selector de autores" required>
                            <?php foreach ($autores as $autor) : ?>
                                <option value="<?= $autor['id'] ?>" <?= $autor['id'] == $libro['id_autor'] ? 'selected' : '' ?>><?= $autor['autor'] ?></option>";
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="disponible" class="form-label">¿Se encuentra disponible?</label>
                        <select class="form-select" id="disponible" name="disponible" aria-label="Selector de estado del libro" required>
                            <option value="1" <?= $libro['disponible'] == 1 ? 'selected' : ''; ?>>Si</option>
                            <option value="0" <?= $libro['disponible'] == 0 ? 'selected' : ''; ?>>No</option>
                        </select>
                    </div>
                    <input class="btn btn-sm btn-outline-primary" type="submit" value="Guardar">
                    <a class="btn btn-sm btn-outline-success" href="../index.php">Regresar</a>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>