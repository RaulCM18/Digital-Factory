<?php
// login.php
session_start();
$host = 'localhost'; // Cambia esto si tu base de datos está en otro servidor
$db = 'tu_base_de_datos'; // Nombre de tu base de datos
$user = 'tu_usuario'; // Tu usuario de base de datos
$pass = 'tu_contraseña'; // Tu contraseña de base de datos

// Conexión a la base de datos
$conn = new mysqli($host, $user, $pass, $db);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['loginEmail'];
    $password = $_POST['loginPassword'];

    // Consulta para obtener el hash de la contraseña del usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashedPassword = $user['password'];

        // Verificar la contraseña
        if (password_verify($password, $hashedPassword)) {
            // La contraseña es correcta, inicia sesión
            $_SESSION['user_id'] = $user['id'];
            header("Location: PaginaSg.html"); // Redirigir a la página de éxito
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "No estás registrado. <a href='register.html'>Crea una cuenta</a>";
    }
}
$conn->close();
?>