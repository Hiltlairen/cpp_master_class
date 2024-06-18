<?php
// Datos de conexión a la base de datos MySQL
$servername = "bssnptl9dvpygafwf9fl-mysql.services.clever-cloud.com";
$username = "uuvq2s06nsgfgym0";
$password = "oJEW6OdzxwCywhHpI3eX";
$dbname = "bssnptl9dvpygafwf9fl";

// Crear conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay algún error en la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta SQL para obtener la lista de docentes
$sql = "SELECT id_usuario, nombre, correo FROM Usuarios WHERE rol = 'educador'";
$result = $conn->query($sql);

$teachers = array();

if ($result->num_rows > 0) {
    // Recorrer los resultados y almacenarlos en un array
    while($row = $result->fetch_assoc()) {
        $teachers[] = $row;
    }
}

// Cerrar conexión a la base de datos
$conn->close();

// Devolver los datos en formato JSON
echo json_encode($teachers);
?>
