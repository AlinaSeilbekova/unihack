<?php
// Подключение к базе данных
$host = 'db4free.net';
$db_name = 'unihack';
$db_username = 'unihack';
$db_password = 'iituplatform1';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $db_password);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получение данных из POST-запроса
    $requestData = json_decode(file_get_contents('php://input'), true);
    $labId = $requestData['labId'];
    $title = $requestData['title'];
    $descr = $requestData['descr'];

    // Обновление данных в базе данных
    $query = "UPDATE labs SET title = :title, descr = :descr WHERE id = :labId";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':descr', $descr);
    $stmt->bindParam(':labId', $labId);
    $stmt->execute();

    // Отправка ответа клиенту
    echo "Данные успешно сохранены";
} else {
    echo "Неверный метод запроса";
}

$dbh = null;
?>
