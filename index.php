<?php
include_once('conexion.php');
$query = "SELECT id, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS autor FROM personas WHERE estado = 1";
$autores = mysqli_query($con, $query) or die(mysqli_error($con));

$query = "SELECT l.id AS id, l.titulo, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS autor, l.disponible 
FROM libros AS l
JOIN personas AS p ON l.id_autor = p.id
WHERE l.estado = 1";
$libros = mysqli_query($con, $query) or die(mysqli_error($con));

var_dump($libros);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./estilos/style.css">
    <title>LIBROS</title>
</head>

<body>
    <div class="link">
        <a href="./personas/index.php">Personas</a>
    </div>
    <div class="contenedor">
        <h3>Ingresar datos</h3>
        <form action="libros/recibir.php" method="post" autocomplete="off">
            <label for="">Ecribe el titulo del libro</label>
            <input type="text" id="titulo" name="titulo" placeholder="ingrese el titulo" required>
            <br><br>
            <label for="autor">autor</label>
            <select id="id_autor" name="id_autor" required>
                <option selected>Seleccione una Opcion...</option>
                <?php foreach ($autores as $autor) : ?>
                    <option value="<?= $autor['id'] ?>"><?= $autor['autor']  ?></option>";
                <?php endforeach ?>
            </select>
            <br><br>
            <label for="disponible">Disponible</label>
            <select name="disponible" id="disponible" required>
                <option selected>Seleccione una Opcion...</option>
                <option value="1">disponible</option>
                <option value="2">no disponible</option>
            </select>
            <br><br>
            <button type="submit">enviar</button>
        </form>
    </div>

    <section class="tabla">
        <h3>Registro de libros</h3>
        <table>
            <thead>
                <tr>
                    <td>#</td>
                    <td>libro</td>
                    <td>autor</td>
                    <td>disponible</td>
                    <td colspan="2">Opciones</td>
                </tr>
            </thead>

            <tbody>
                <?php

                if (mysqli_num_rows($libros) > 0) {

                    $pos = 1;

                    while ($libro = mysqli_fetch_assoc($libros)) {

                        //  $libros = [$data['titulo'], $data['autor'], $data['disponible']];



                ?>
                        <tr>
                            <td><?php echo $pos; ?></td>
                            <td><?php echo $libro['titulo']; ?></td>
                            <td><?php echo $libro['autor']; ?></td>
                            <td><?php echo $libro['disponible'] ? 'SI' : 'NO'; ?></td>


                            <td><a href="libros/editar.php?id=<?php echo $libro['id']; ?>">editar</a></td>
                            <td><a href="libros/eliminar.php?id=<?php echo $libro['id']; ?>" value="">eliminar</a></td>
                        </tr>
                    <?php $pos++;
                    }
                } else { ?>
                    <tr>
                        <td colspan="9">no hay datos</td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>
</body>

</html>