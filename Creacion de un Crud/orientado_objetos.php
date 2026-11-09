<?php
// Conexión a MySQL utilizando mysqli orientado a objetos.
// Desactivamos las excepciones automáticas de mysqli
// para comprobar los errores mediante sus propiedades.
mysqli_report(MYSQLI_REPORT_OFF);

$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "gestion_usuarios";

$conexion = new mysqli($servidor, $usuario, $contraseña, $base_datos);

// Comprobamos si existe algún error de conexión.
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

$mensaje = "";

// Comprobamos si se ha enviado un formulario.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $accion = $_POST["accion"];

    // INSERTAR USUARIO
    if ($accion == "insertar") {

        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $edad = $_POST["edad"] === "" ? null : (int) $_POST["edad"];

        // Utilizamos una consulta preparada por seguridad.
        $sql = "INSERT INTO usuarios (nombre, email, edad)
                VALUES (?, ?, ?)";

        $stmt = $conexion->prepare($sql);

        if ($stmt) {

            $stmt->bind_param("ssi", $nombre, $email, $edad);

            if ($stmt->execute()) {
                $mensaje = "Usuario registrado correctamente";
            } else {
                $mensaje = "Error: " . $stmt->error;
            }

            $stmt->close();

        } else {
            $mensaje = "Error: " . $conexion->error;
        }
    }

    // ACTUALIZAR USUARIO
    if ($accion == "actualizar") {

        $id = (int) $_POST["id"];
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        $edad = $_POST["edad"] === "" ? null : (int) $_POST["edad"];

        $sql = "UPDATE usuarios SET nombre = ?, email = ?, edad = ?
                WHERE id = ?";

        $stmt = $conexion->prepare($sql);

        if ($stmt) {

            $stmt->bind_param("ssii", $nombre, $email, $edad, $id);

            if ($stmt->execute()) {
                $mensaje = "Usuario actualizado correctamente";
            } else {
                $mensaje = "Error: " . $stmt->error;
            }

            $stmt->close();

        } else {
            $mensaje = "Error: " . $conexion->error;
        }
    }

    // ELIMINAR USUARIO
    if ($accion == "eliminar") {

        $id = (int) $_POST["id"];

        $sql = "DELETE FROM usuarios WHERE id = ?";

        $stmt = $conexion->prepare($sql);

        if ($stmt) {

            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                $mensaje = "Usuario eliminado correctamente";
            } else {
                $mensaje = "Error: " . $stmt->error;
            }

            $stmt->close();

        } else {
            $mensaje = "Error: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios - mysqli Orientado a Objetos</title>
</head>
<body>

<h1>Gestión de usuarios - mysqli Orientado a Objetos</h1>

<p><?php echo htmlspecialchars($mensaje); ?></p>

<!-- Formulario para registrar usuarios -->
<h2>Registrar usuario</h2>

<form method="POST">
    <input type="hidden" name="accion" value="insertar">

    Nombre:
    <input type="text" name="nombre" required>

    Email:
    <input type="email" name="email" required>

    Edad:
    <input type="number" name="edad">

    <button type="submit">Registrar</button>
</form>

<!-- Formulario para actualizar usuarios -->
<h2>Actualizar usuario</h2>

<form method="POST">
    <input type="hidden" name="accion" value="actualizar">

    ID:
    <input type="number" name="id" required>

    Nombre:
    <input type="text" name="nombre" required>

    Email:
    <input type="email" name="email" required>

    Edad:
    <input type="number" name="edad">

    <button type="submit">Actualizar</button>
</form>

<!-- Formulario para eliminar usuarios -->
<h2>Eliminar usuario</h2>

<form method="POST">
    <input type="hidden" name="accion" value="eliminar">

    ID:
    <input type="number" name="id" required>

    <button type="submit">Eliminar</button>
</form>

<!-- LISTAR USUARIOS -->
<h2>Lista de usuarios</h2>

<?php
// Realizamos la consulta utilizando el método query().
$sql = "SELECT * FROM usuarios";
$resultado = $conexion->query($sql);

if ($resultado) {

    if ($resultado->num_rows > 0) {

        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th></tr>";

        while ($fila = $resultado->fetch_assoc()) {

            echo "<tr>";
            echo "<td>" . $fila["id"] . "</td>";
            echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
            echo "<td>" . htmlspecialchars($fila["email"]) . "</td>";
            echo "<td>" . htmlspecialchars((string) $fila["edad"]) . "</td>";
            echo "</tr>";
        }

        echo "</table>";

    } else {
        echo "No se encontraron resultados";
    }

} else {
    echo "Error en la consulta: " . htmlspecialchars($conexion->error);
}

// Cerramos la conexión.
$conexion->close();
?>

</body>
</html>