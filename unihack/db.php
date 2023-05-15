<?php
function connectDB() {
    // Задаем учетные данные для подключения к базе данных
    $host = 'db4free.net';
    $db_name = 'unihack';
    $username = 'unihack';
    $password = 'iituplatform1';

    try {
        // Создаем новое подключение к базе данных с помощью объекта PDO
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);

        // Устанавливаем режим отображения ошибок для PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Возвращаем объект соединения
        return $conn;
    } catch(PDOException $e) {
        // Обрабатываем ошибку, если подключение к базе данных не удалось
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}
