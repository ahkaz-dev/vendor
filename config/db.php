<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Проверяем, существует ли уже объект подключения
if (!isset($GLOBALS['pdo'])) {
    // Данные для подключения
    $host = 'localhost';
    $dbname = 'vendordb';
    $username = 'rootVendor';
    $password = 'bz8VHldnUp/_oAZK';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Сохраняем объект в глобальной переменной
        $GLOBALS['pdo'] = $pdo;
    } catch (PDOException $e) {
        echo "Ошибка подключения: " . $e->getMessage();
        die();
    }
} else {
    // Если объект уже существует, используем его
    $pdo = $GLOBALS['pdo'];
}
