<?php
// Подключение к базе данных и другие настройки
$host = 'db4free.net';
$db_name = 'unihack';
$db_username = 'unihack';
$db_password = 'iituplatform1';

// Установка соединения с базой данных
try {
    $dbh = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $db_password);
} catch (PDOException $e) {
    echo "Ошибка подключения к базе данных: " . $e->getMessage();
    exit();
}

// Начало или восстановление сессии
session_start();

// Проверяем, существует ли активная сессия пользователя
if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['roleID'])) {
    $username = $_SESSION['username'];
    $roleID = $_SESSION['roleID'];
    $userID =$_SESSION['id'];
} else {
    // Если активной сессии пользователя нет, выводим сообщение об ошибке или перенаправляем на страницу входа
    echo "Активная сессия не найдена";
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newEmail = $_POST["email"];
    $newPassword = $_POST["password"];

    // Perform any necessary validation or sanitization of the input data
    // ...

    // Update the database with the new data
    // Assuming you have a table called 'users' with columns 'email' and 'password'

    // Replace 'your_db_connection' with your actual database connection variable
    $query = "UPDATE users SET email = '$newEmail', password = '$newPassword' WHERE id = $userId";

    // Execute the query
    // Replace 'your_db_connection' with your actual database connection variable
    $result = mysqli_query(dbh, $query);

    if ($result) {
        // Data updated successfully
        echo "Data updated successfully!";
    } else {
        // Error occurred while updating data
        echo "Error: " . mysqli_error(dbh);
    }
}
?>
