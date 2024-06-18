<?php
// Iniciar sesión (puedes ajustar esto según tus necesidades)
session_start();

// Verificar si se han enviado datos por POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Datos de conexión a la base de datos MySQL
    $servername = "localhost";  // Nombre del servidor MySQL
    $username = "id22324152_admincpp";   // Usuario de MySQL
    $password = "admin_23CPP"; // Contraseña de MySQL
    $dbname = "id22324152_cppmasterclass"; // Nombre de la base de datos
    
    // Crear conexión a la base de datos
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Verificar si hay algún error en la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }
    
    // Limpiar y escapar los datos del formulario para prevenir inyección SQL
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    
    // Consulta SQL para verificar las credenciales
    $sql = "SELECT id_usuario, nombre, correo, rol FROM Usuarios WHERE correo = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    
    // Verificar si se encontró algún resultado
    if ($result->num_rows > 0) {
        // Iniciar sesión y almacenar datos del usuario en variables de sesión
        $row = $result->fetch_assoc();
        $_SESSION['id_usuario'] = $row['id_usuario'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['correo'] = $row['correo'];
        $_SESSION['rol'] = $row['rol'];
        
        // Redireccionar al usuario a la página correspondiente según su rol
        switch ($_SESSION['rol']) {
            case 'administrador':
                header("Location: ../page/admin.html"); // Ruta a la página de administrador
                break;
            case 'educador':
                header("Location: educador/index.html"); // Ruta a la página de educador
                break;
            case 'estudiante':
                header("Location: estudiante/index.html"); // Ruta a la página de estudiante
                break;
            default:
                header("Location: page/home.html"); // Página por defecto si el rol no coincide
        }
    } else {
        echo "Correo electrónico o contraseña incorrectos.";
    }
    
    // Cerrar conexión a la base de datos
    $conn->close();
}
?>
