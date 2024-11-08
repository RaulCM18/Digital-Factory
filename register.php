<?php
// register.php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $host = 'localhost';
    $db = 'tu_base_de_datos';
    $user = 'tu_usuario';
    $pass = 'tu_contraseña';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $email = $_POST['registerEmail'];
    $password = $_POST['registerPassword'];

    // Hash de la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar el nuevo usuario
    $stmt = $conn->prepare("INSERT INTO usuarios (email, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $email, $hashedPassword);

    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>