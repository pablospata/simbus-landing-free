<?php

// Función para conectar a la base de datos
function conectarDB() {
    $host = 'localhost';
    $db   = 'u717999773_contactos';
    $user = 'u717999773_pablo';
    $pass = 'I2dP|6N5l0@s';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    
    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}

// Función para guardar contacto de forma segura
function guardarContacto($telefono, $email) {
    $pdo = conectarDB();
    $stmt = $pdo->prepare("INSERT INTO contactos (telefono, email) VALUES (:telefono, :email)");
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':email', $email);
    $stmt->execute();
}

// Función para validar y sanear entrada
function validarEntrada($data) {
    $data = trim($data);             // Elimina espacios en blanco al inicio y al final
    $data = stripslashes($data);    // Elimina barras invertidas
    $data = htmlspecialchars($data); // Convierte caracteres especiales en entidades HTML
    return $data;
}

// Lógica principal del script

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $telefono = validarEntrada($_POST['phone']);
    $email = validarEntrada($_POST['email']);

    try {
        guardarContacto($telefono, $email);
        
        // Redireccionar a index.html después de guardar
        header("Location: gracias.html");
        exit; // Es importante llamar a exit después de header para detener la ejecución del script
        
    } catch (\PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
