<?php
session_start();

// Проверяем, была ли отправлена форма логина
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  // Получаем введенное имя пользователя и пароль из формы
  $username = $_POST["username"];
  $password = $_POST["password"];
  
  // Подключаемся к базе данных, замените здесь значения хоста, имени пользователя, пароля и имени базы данных на свои
  $mysqli = new mysqli("db4free.net", "unihack", "iituplatform1", "unihack");
  
  // Проверяем, удалось ли подключиться к базе данных
  if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
  }
  
  // Запрашиваем из базы данных запись, соответствующую введенному имени пользователя
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = $mysqli->query($query);
  
  // Проверяем, есть ли запись с введенным именем пользователя в базе данных
  if ($result->num_rows == 1) {
    // Если есть, получаем запись
    $row = $result->fetch_assoc();
    
    // Сравниваем введенный пароль с хэшем пароля из базы данных
    if (password_verify($password, $row["passHash"])) {
      // Если хэшированные пароли совпадают, значит пользователь ввел правильные учетные данные
      // Устанавливаем значения сессии
      $_SESSION["username"] = $username;
      $_SESSION["roleID"] = $row["roleID"];
      
      if ($_SESSION["roleID"] == 2) {
        header("Location: labsTeacher.php");
        exit();
      } elseif ($_SESSION["roleID"] == 3) {
          header("Location: labs.php");
          exit();
      } elseif ($_SESSION["roleID"] == 1) {
          header("Location: admin.php");
          exit();
      exit();
    }} else {
      // Если хэшированные пароли не совпадают, значит пользователь ввел неправильный пароль
      // Выводим сообщение над формой
      echo "<div class='response' style='color: red;'>Неправильный логин или пароль!</div>";
    }
  } else {
    // Если нет записи с введенным именем пользователя в базе данных, значит пользователь ввел неправильное имя пользователя
    // Выводим сообщение над формой
    echo "<div class='response' style='color: red;'>Неправильный логин или пароль!</div>";
  }
  
  // Закрываем соединение с базой данных
  $mysqli->close();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  </head>
  <style type="text/css">
    .response {
    font-size: 24px; /* Изменение размера шрифта */
    text-align: center; /* Выравнивание текста по центру */
    margin-top: 20px;
  </style>
  <body>
    <?php include('navbar.php');?>
    <div class="container mt-5">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="card">
            <div class="card-header">
              <h4>Login Form</h4>
            </div>
            <div class="card-body">
              <form action="login.php" method="POST">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-block" style="background-color: #2c3e50; color: white;">Login</button>
                <button onclick="window.location.href = 'registration.php';"class="btn btn-block" style="background-color: #2c3e50; color: white;">Registration</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.3/dist/umd/popper.min.js"
            integrity="sha384-3aazKjTH08v1xUxLLaUZp8Kz+SbU6C2DyXmJk/Haxwy5Bc7hNSQZ5lV7JcYyccKL"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"
            integrity="sha384-p9ImH7aSvi3+JbcNpPs4kPPNw3j+JbsgIdtVyrvcRfge9NFjN/8+t+n5MKJgLfwj"
            crossorigin="anonymous"></script>
  </body>
</html>
