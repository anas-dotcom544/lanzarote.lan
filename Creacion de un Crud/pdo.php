<?php
// Conexión a MySQL utilizando PDO.
// PDO permite trabajar con diferentes sistemas de bases de datos.

$dsn = "mysql:host=localhost;dbname=gestion_usuarios";
$usuario = "root";
$contraseña = "";

// Utilizamos try-catch para controlar errores de conexión.
try {

    $conexion = new PDO($dsn, $usuario, $contraseña);

    // Configuramos PDO para lanzar excepciones en caso de error.
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {

    die("Error en la conexión: " . $e->getMessage());
}

$mensaje = "";

// Comprobamos si se ha enviado un formulario.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $accion = $_POST["accion"];

    try {

        // INSERTAR USUARIO
        if ($accion == "insertar") {

            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $edad = $_POST["edad"] === "" ? null : (int) $_POST["edad"];

            // Consulta preparada con parámetros.
            $sql = "INSERT INTO usuarios (nombre, email, edad)
                    VALUES (:nombre, :email, :edad)";

            $stmt = $conexion->prepare($sql);

            // bindValue asigna los valores a los parámetros.
            $stmt->bindValue(":nombre", $nombre);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(
                ":edad",
                $edad,
                $edad === null ? PDO::PARAM_NULL : PDO::PARAM_INT
            );

            $stmt->execute();

            $mensaje = "Usuario registrado correctamente";
        }

        // ACTUALIZAR USUARIO
        if ($accion == "actualizar") {

            $id = (int) $_POST["id"];
            $nombre = $_POST["nombre"];
            $email = $_POST["email"];
            $edad = $_POST["edad"] === "" ? null : (int) $_POST["edad"];

            $sql = "UPDATE usuarios
                    SET nombre = :nombre, email = :email, edad = :edad
                    WHERE id = :id";

            $stmt = $conexion->prepare($sql);

            $stmt->bindValue(":nombre", $nombre);
            $stmt->bindValue(":email", $email);
            $stmt->bindValue(
                ":edad",
                $edad,
                $edad === null ? PDO::PARAM_NULL : PDO::PARAM_INT
            );
            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            $mensaje = "Usuario actualizado correctamente";
        }

        // ELIMINAR USUARIO
        if ($accion == "eliminar") {

            $id = (int) $_POST["id"];

            $sql = "DELETE FROM usuarios WHERE id = :id";

            $stmt = $conexion->prepare($sql);

            $stmt->bindValue(":id", $id, PDO::PARAM_INT);

            $stmt->execute();

            $mensaje = "Usuario eliminado correctamente";
        }

    } catch (PDOException $e) {

        // Capturamos los errores de las consultas.
        $mensaje = "Error en la operación: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Usuarios - PDO</title>
</head>
<body>

<h1>Gestión de usuarios - PDO</h1>

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
// Utilizamos query() para listar los usuarios.
// Si ocurre un error, PDO lanzará una excepción.
try {

    $sql = "SELECT * FROM usuarios";
    $resultado = $conexion->query($sql);

    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th></tr>";

    foreach ($resultado as $fila) {

        echo "<tr>";
        echo "<td>" . $fila["id"] . "</td>";
        echo "<td>" . htmlspecialchars($fila["nombre"]) . "</td>";
        echo "<td>" . htmlspecialchars($fila["email"]) . "</td>";
        echo "<td>" . htmlspecialchars((string) $fila["edad"]) . "</td>";
        echo "</tr>";
    }

    echo "</table>";

} catch (PDOException $e) {

    echo "Error en la consulta: " . htmlspecialchars($e->getMessage());
}

// Cerramos la conexión asignando null.
$conexion = null;
?>

</body>
</html>