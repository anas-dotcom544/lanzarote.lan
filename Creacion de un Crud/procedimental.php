<?php
// Conexión a MySQL utilizando mysqli procedimental.
// Desactivamos las excepciones automáticas de mysqli
// para manejar los errores con las funciones mysqli.
mysqli_report(MYSQLI_REPORT_OFF);

$servidor = "localhost";
$usuario = "root";
$contraseña = "";
$base_datos = "gestion_usuarios";

$conexion = mysqli_connect($servidor, $usuario, $contraseña, $base_datos);

// Comprobamos si la conexión se ha realizado correctamente.
if (!$conexion) {
    die("Conexión fallida: " . mysqli_connect_error());
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

        // Consulta preparada para evitar inyecciones SQL.
        $sql = "INSERT INTO usuarios (nombre, email, edad)
                VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssi", $nombre, $email, $edad);

            if (mysqli_stmt_execute($stmt)) {
                $mensaje = "Usuario registrado correctamente";
            } else {
                $mensaje = "Error: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);

        } else {
            $mensaje = "Error: " . mysqli_error($conexion);
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

        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "ssii", $nombre, $email, $edad, $id);

            if (mysqli_stmt_execute($stmt)) {
                $mensaje = "Usuario actualizado correctamente";
            } else {
                $mensaje = "Error: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);

        } else {
            $mensaje = "Error: " . mysqli_error($conexion);
        }
    }

    // ELIMINAR USUARIO
    if ($accion == "eliminar") {

        $id = (int) $_POST["id"];

        $sql = "DELETE FROM usuarios WHERE id = ?";

        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {

            mysqli_stmt_bind_param($stmt, "i", $id);

            if (mysqli_stmt_execute($stmt)) {
                $mensaje = "Usuario eliminado correctamente";
            } else {
                $mensaje = "Error: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);

        } else {
            $mensaje = "Error: " . mysqli_error($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios - mysqli Procedimental</title>
</head>
<body>

<h1>Gestión de usuarios - mysqli Procedimental</h1>

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
// Consulta para mostrar todos los usuarios.
$sql = "SELECT * FROM usuarios";
$resultado = mysqli_query($conexion, $sql);

if ($resultado) {

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th></tr>";

    while ($fila = mysqli_fetch_assoc($resultado)) {

        echo "<tr>";
        echo "<td>" . $fila["id"] . "</td>";
        echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["email"]) . "</td>";
        echo "<td>" . htmlspecialchars((string) $fila["edad"]) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} else {
    echo "Error en la consulta: " . htmlspecialchars(mysqli_error($conexion));
}

// Cerramos la conexión.
mysqli_close($conexion);
?>

</body>
</html>