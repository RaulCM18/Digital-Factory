<?php
include '../conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad_disponible = $_POST['cantidad_disponible'];
    $imagen = $_POST['imagen'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO Productos (nombre, precio, cantidad_disponible, imagen, descripcion)
            VALUES ('$nombre', $precio, $cantidad_disponible, '$imagen', '$descripcion')";

    if ($conn->query($sql) === TRUE) {
        echo "Producto agregado exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>