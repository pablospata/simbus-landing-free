<?php
$host = 'localhost'; // o tu host de la base de datos
$db   = 'u717999773_contactos';
$user = 'u717999773_pablo';
$pass = 'I2dP|6N5l0@s';
$charset = 'utf8mb4'; // charset, este es el más común

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

// Verifica si la contraseña es correcta
$contraseñaUsuario = $_POST['password'];
$contraseñaCorrecta = 'tu_contraseña'; // Cambia 'tu_contraseña' por la contraseña que quieras

$emails = []; // Array donde almacenaremos los emails

if ($contraseñaUsuario === $contraseñaCorrecta) {
    $stmt = $pdo->prepare('SELECT email FROM contactos WHERE fecha = :fecha');
    $stmt->execute(['fecha' => $fechaSeleccionada]);

    while ($row = $stmt->fetch()) {
        $emails[] = $row['email']; // Añade cada email al array
    }

    // Muestra el array
    echo "<pre>";
    print_r($emails);
    echo "</pre>";
} else {
    echo "Contraseña incorrecta.";
}
?>
