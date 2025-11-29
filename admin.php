<?php
include("conexion.php");
session_start();

// Verificar rol admin
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    header("Location: secion.html");
    exit();
}

// -------------------- PROCESOS --------------------
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // BORRAR USUARIO
    if (isset($_POST['borrar'])) {
        $correo = $conn->real_escape_string($_POST['correo']);
        $conn->query("DELETE FROM usuarios WHERE correo='$correo'");
        echo "<script>alert('Usuario eliminado');</script>";
    }

    // CREAR RUTINA
    if (isset($_POST['crear_rutina'])) {

        $id_usuario = (int)$_POST['id_usuario'];

        $res = $conn->query("SELECT id_rutina FROM rutinas WHERE id_usuario='$id_usuario'");

        if ($res->num_rows == 0) {
            $conn->query("INSERT INTO rutinas (id_usuario) VALUES('$id_usuario')");
            echo "<script>alert('Rutina creada');</script>";
        } else {
            echo "<script>alert('Este usuario YA tiene rutina');</script>";
        }
    }

    // AÑADIR CATEGORÍA A RUTINA
    if (isset($_POST['add_categoria'])) {

        $id_rutina = (int)$_POST['id_rutina'];
        $id_categoria = (int)$_POST['id_categoria'];

        $conn->query("INSERT INTO rutinas_categoria (id_rutina, id_categoria)
                      VALUES('$id_rutina', '$id_categoria')");

        echo "<script>alert('Categoría añadida');</script>";
    }

    // AÑADIR EJERCICIO A UNA CATEGORIA
    if (isset($_POST['add_ejercicio'])) {

        $id_rutina_categoria = (int)$_POST['id_rutina_categoria'];
        $ejercicio = $conn->real_escape_string($_POST['ejercicio']);

        $conn->query("INSERT INTO rutinas_ejercicios (id_rutina_categoria, ejercicio_texto)
                      VALUES('$id_rutina_categoria', '$ejercicio')");

        echo "<script>alert('Ejercicio añadido');</script>";
    }

    // VER RUTINA COMPLETA
    if (isset($_POST['ver_rutina'])) {

        $id_usuario = (int)$_POST['id_usuario'];

        $sql = "
            SELECT c.nombre_categoria, e.ejercicio_texto
            FROM rutinas r
            JOIN rutinas_categoria rc ON r.id_rutina = rc.id_rutina
            JOIN categorias c ON rc.id_categoria = c.id_categoria
            LEFT JOIN rutinas_ejercicios e ON rc.id_rutina_categoria = e.id_rutina_categoria
            WHERE r.id_usuario='$id_usuario'
            ORDER BY c.nombre_categoria
        ";

        $res = $conn->query($sql);

        if ($res && $res->num_rows > 0) {
            $texto = "RUTINA:\n\n";
            while ($f = $res->fetch_assoc()) {
                $texto .= "Categoría: ".$f['nombre_categoria']."\n";
                $texto .= " → ".($f['ejercicio_texto'] ?: "Sin ejercicios")."\n\n";
            }
            echo "<script>alert(".json_encode($texto).");</script>";
        } else {
            echo "<script>alert('Este usuario no tiene rutina');</script>";
        }
    }
}

// Obtener usuarios
$sql = "SELECT id_usuario, nombre_usuario, correo, foto FROM usuarios";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

<h1>Usuarios Registrados</h1>

<?php
if ($result && $result->num_rows > 0) {

    while ($row = $result->fetch_assoc()) {

        $id_usuario = $row["id_usuario"];

        // Ver si ya tiene rutina
        $rutinaRes = $conn->query("SELECT id_rutina FROM rutinas WHERE id_usuario='$id_usuario'");
        $id_rutina = ($rutinaRes->num_rows > 0) ? $rutinaRes->fetch_assoc()["id_rutina"] : null;

        echo '<div class="usuario">';

        echo "<img src='{$row["foto"]}' alt='Foto'><br>";
        echo "<strong>{$row["nombre_usuario"]}</strong><br>";
        echo "{$row["correo"]}<br><br>";

        // BORRAR
        echo '
        <form method="POST" style="display:inline-block;">
            <input type="hidden" name="correo" value="'.$row["correo"].'">
            <button class="btn-red" name="borrar">Borrar</button>
        </form>';

        // CREAR RUTINA
        if (!$id_rutina) {
            echo '
            <form method="POST" style="display:inline-block;">
                <input type="hidden" name="id_usuario" value="'.$id_usuario.'">
                <button class="btn-blue" name="crear_rutina">Crear Rutina</button>
            </form>';
        }

        // SI YA TIENE RUTINA
        if ($id_rutina) {

            echo "<p>Rutina ID: $id_rutina</p>";

            // CATEGORÍAS YA ASIGNADAS
            $catsAsignadas = $conn->query("
                SELECT rc.id_rutina_categoria, c.nombre_categoria 
                FROM rutinas_categoria rc
                JOIN categorias c ON rc.id_categoria = c.id_categoria
                WHERE rc.id_rutina='$id_rutina'
            ");

            // ----------------------------- AÑADIR CATEGORIA -----------------------------
            echo '<form method="POST" style="display:inline-block;margin-right:12px;">
                    <input type="hidden" name="id_rutina" value="'.$id_rutina.'">
                    <select name="id_categoria">';

            // Cargar categorías desde DB **cada vez**
            $cats = $conn->query("SELECT id_categoria, nombre_categoria FROM categorias");

            while ($c = $cats->fetch_assoc()) {
                echo '<option value="'.$c["id_categoria"].'">'.$c["nombre_categoria"].'</option>';
            }

            echo '  </select>
                    <button class="btn-blue" name="add_categoria">Añadir Categoría</button>
                  </form>';

            // ----------------------------- AÑADIR EJERCICIO -----------------------------
            echo '<form method="POST" style="display:inline-block;margin-right:12px;">
                    <select name="id_rutina_categoria" required>';

            if ($catsAsignadas->num_rows > 0) {
                while ($ca = $catsAsignadas->fetch_assoc()) {
                    echo '<option value="'.$ca["id_rutina_categoria"].'">'.$ca["nombre_categoria"].'</option>';
                }
            } else {
                echo '<option value="">No tiene categorías</option>';
            }

            echo '  </select>

                    <input type="text" name="ejercicio" placeholder="Ejercicio..." required>
                    <button class="btn-green" name="add_ejercicio">Añadir Ejercicio</button>
                  </form>';
        }

        // VER RUTINA
        echo '
        <form method="POST" style="display:inline-block;">
            <input type="hidden" name="id_usuario" value="'.$id_usuario.'">
            <button class="btn-purple" name="ver_rutina">Ver Rutina</button>
        </form>';

        echo "</div><hr>";
    }

} else {
    echo "<p>No hay usuarios registrados.</p>";
}
?>

</body>
</html>
