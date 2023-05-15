<?php
session_start(); // Начинаем или возобновляем сессию

// Проверяем, существует ли сессия
if (isset($_SESSION["username"])) {
    // Удаляем все переменные сессии
    session_unset();

    // Уничтожаем сессию
    session_destroy();

    // Перенаправляем на страницу после выхода
    header("Location: home.php");
    exit();
}
