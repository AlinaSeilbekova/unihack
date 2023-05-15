<?php
session_start(); // начинаем сессию
if(isset($_SESSION['username'])) { // проверяем, залогинился ли пользователь
    header('Location: profile.php'); // если залогинился, перенаправляем на profile.php
} else {
    header('Location: login.php'); // если не залогинился, перенаправляем на login.php
}
exit; // завершаем выполнение скрипта
?>
