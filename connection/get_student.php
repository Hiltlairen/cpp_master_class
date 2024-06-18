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

// Consulta SQL para obtener la lista de estudiantes
$sql = "SELECT id_usuario, nombre, correo FROM Usuarios WHERE rol = 'estudiante'";
$result = $conn->query($sql);

$students = array();

if ($result->num_rows > 0) {
    // Recorrer los resultados y almacenarlos en un array
    while($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Cerrar conexión a la base de datos
$conn->close();

// Devolver los datos en formato JSON
echo json_encode($students);
?>
