<?php
include_once('../conexion.php');
$query = "SELECT p.id, CONCAT(IFNULL(primer_nombre,''),' ',IFNULL(segundo_nombre,''),' ',IFNULL(primer_apellido,''),' ',IFNULL(segundo_apellido,'')) AS nombre_completo, r.nombre AS rol, p.estado FROM personas AS p JOIN roles AS r ON r.id = p.id_rol WHERE p.estado = 1";
$personas = mysqli_query($con, $query) or die(mysqli_error($con));


$query = "SELECT id, nombre FROM roles WHERE estado = 1";
$roles = mysqli_query($con, $query) or die(mysqli_error($con));
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../estilos/style.css">
    <title>Document</title>
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
            <br><br>
            <div class="boton">
                <button type="submit">Guardar</button>
            </div>
        </form>
    </div>
    <section id="tab">
        <h4>Personas</h4>
        <table>
            <thead>
                <tr class="text-center">
                    <td>#</td>
                    <td>Nombre</td>
                    <td>Rol</td>
                    <td>Estado</td>
                    <td colspan="2">Opciones</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($personas) > 0) {
                    $pos = 1;

                    while ($persona = mysqli_fetch_assoc($personas)) {
                ?>
                        <tr>
                            <td><?php echo $pos; ?></td>
                            <td><?php echo $persona['nombre_completo']; ?></td>
                            <td><?php echo $persona['rol']; ?></td>
                            <td><?php echo $persona['estado'] ? 'ACTIVO' : 'INACTIVO'; ?></td>
                            
                            <td><a href="editar.php?id=<?php echo $persona['id']; ?>" >Editar</a></td>
                            <td><a href="eliminar.php?id=<?php echo $persona['id']; ?>" value="">Eliminar</a></td>
                        </tr>
                    <?php $pos++;
                    }
                } else { ?>
                    <tr>
                        <td colspan="6">No hay datos</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </section>

</body>

</html>