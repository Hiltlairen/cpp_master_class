<?php
// Datos de conexión a la base de datos MySQL
$servername = "localhost";
$username = "id22324152_admincpp";
$password = "admin_23CPP";
$dbname = "id22324152_cppmasterclass";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay algún error en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del POST
$id_usuario = $_POST['id_usuario'];
$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$password = $_POST['password'];

// Encriptar la contraseña
$password_hash = password_hash($password, PASSWORD_BCRYPT);

// Consulta SQL para actualizar los datos del docente
$sql = "UPDATE Usuarios SET nombre=?, correo=?, password=? WHERE id_usuario=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $nombre, $correo, $password_hash, $id_usuario);

if ($stmt->execute()) {
    echo json_encode(array("status" => "success"));
} else {
    echo json_encode(array("status" => "error", "message" => $stmt->error));
}

// Cerrar conexión a la base de datos
$conn->close();
?>
