<?php
session_start();

// Проверяем, существует ли активная сессия пользователя
if (isset($_SESSION['username']) && isset($_SESSION['roleID'])) {
    $username = $_SESSION['username'];
    $roleID = $_SESSION['roleID'];
} else {
    // Если активной сессии пользователя нет, выводим сообщение об ошибке или перенаправляем на страницу входа
    echo "Активная сессия не найдена";
}


function getUsersData() {
    // Параметры подключения к базе данных
    $host = 'db4free.net';
    $db_name = 'unihack';
    $db_username = 'unihack';
    $db_password = 'iituplatform1';

    try {
        // Установка соединения с базой данных
        $dbh = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $db_password);
        
        // Выборка всех пользователей из таблицы "users"
        $query = "SELECT * FROM users";
        $stmt = $dbh->prepare($query);
        $stmt->execute();
        
        // Получение результатов выборки
        $usersData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Закрытие соединения с базой данных
        $dbh = null;
        
        // Возвращаем полученные данные
        return $usersData;
    } catch (PDOException $e) {
        // Обработка ошибок подключения к базе данных
        echo "Ошибка подключения к базе данных: " . $e->getMessage();
        return null;
    }
}

// Пример использования функции
$users = getUsersData();

if ($users) {
    foreach ($users as $user) {
        $name = $user['name'];
        $surname = $user['surname'];
        $username = $user['username'];
        $passHash = $user['passHash'];
        $email = $user['email'];
        $roleID = $user['roleID'];

        
    }
}

?>



<!DOCTYPE html>
<html>
<head>
  <title>Profile</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
  .card{
    text-align: center;
  }

  .card-header,
    .btn-primary,
    .btn-success,
    .btn-secondary {
      background-color: #2c3e50;
      border-color: #2c3e50;
    }
</style>
<body>
  <?php include('navbar.php');?>
  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header bg-info text-white" style="background-color: #2c3e50;">
            <h4 class="mb-0">Profile Information</h4>
          </div>
          <div class="card-body">
            <form id="update-form" method="post" action="changeCred.php">
              <div class="form-group">
                <label for="firstname">Имя:</label>
                <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $name?>" readonly>
              </div>
              <div class="form-group">
                <label for="lastname">Фамилия:</label>
                <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $surname?>" readonly>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $email?>" readonly>
              </div>
              <div class="form-group">
                <label for="password">Пароль:</label>
                <input type="password" class="form-control" id="password" name="password" value="*********" readonly>
              </div>
              <button type="button" class="btn btn-primary" id="edit-btn">Редактировать</button>
              <button type="submit" class="btn btn-success d-none" id="save-btn">Сохранить</button>
              <button type="button" class="btn btn-secondary d-none" id="cancel-btn">Отмена</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <script>
    $(function() {
      $('#edit-btn').click(function() {
        $('#email, #password').prop('readonly', false);
        $('#edit-btn').addClass('d-none');
        $('#save-btn, #cancel-btn').removeClass('d-none');
      });
      
      $('#cancel-btn').click(function() {
        $('#email, #password').prop('readonly', true);
        $('#edit-btn').removeClass('d-none');
        $('#save-btn, #cancel-btn').addClass('d-none');
      });
      
      $('#update-form').submit(function(e) {
        e.preventDefault();
        
        // код для сохранения изменений в базу данных
        
        $('#email, #password').prop('readonly', true);
        $('#edit-btn').removeClass('d-none');
        $('#save-btn, #cancel-btn').addClass('d-none');
      });
    });
  </script>
</body>
</html>
``
