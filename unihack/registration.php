<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Регистрация</title>
</head>
<body>
<?php
// Установка параметров подключения к БД
function connectDB() {
    // Задаем учетные данные для подключения к базе данных
    $host = 'db4free.net';
    $db_name = 'unihack';
    $db_username = 'unihack';
    $password = 'iituplatform1';

    try {
        // Создаем новое подключение к базе данных с помощью объекта PDO
        $conn = new PDO("mysql:host=$host;dbname=$db_name", $db_username, $password);

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

// Подключаемся к базе данных
$conn = connectDB();

// Выполнение запроса и сохранение результата в $result
$result = $conn->query("SELECT groupName FROM `groups`");

// Создание массива из имен групп
$groups = array();
if ($result->rowCount() > 0) {
  foreach($result as $row) {
    array_push($groups, $row["groupName"]);
  }
}




if($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем значения из формы
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Проверяем идентичность паролей
    if ($password !== $confirm_password) {
    $errors[] = "Пароли не совпадают";
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("password").style.borderColor = "#C41E3A";
            document.getElementById("confirm_password").style.borderColor = "#C41E3A";
            document.getElementById("password").style.backgroundColor  = "#C41E3A";
            document.getElementById("confirm_password").style.backgroundColor  = "#C41E3A";
        });
    </script>
    <?php
}


    if(empty($errors)) {
        // Подключаемся к базе данных
      $conn = connectDB();



        // Генерируем bcrypt-хэш пароля
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // Подготавливаем SQL-запрос с использованием подготовленных выражений для защиты от SQL-инъекций
        $stmt = $conn->prepare("INSERT INTO users (name, surname, username, email, passHash, roleID) VALUES (:name, :surname, :username, :email, :passHash, :roleID)");

        // Привязываем значения к параметрам
        $stmt->bindParam(':name', $first_name);
        $stmt->bindParam(':surname', $last_name);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindValue(':passHash', $hashedPassword);
        $stmt->bindValue(':roleID', '3');

        // Выполняем запрос
        if ($stmt->execute()) {
            // Запись успешно добавлена
          header('Location: login.php');
        } else {
            // Возникла ошибка при добавлении записи
            echo "Ошибка при добавлении записи в базу данных.";
        }

        // Закрываем соединение с БД
        $conn = null;
    }
}

?>

    <?php include('navbar.php'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header">
                        <h4>Регистрация</h4>
                    </div>
                    <div class="card-body">
                        <form method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="first_name">Имя</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="last_name">Фамилия</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="username">Имя пользователя</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="password">Пароль</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="confirm_password">Подтверждение пароля</label>
                                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                </div>
                            </div>

                            <div class="form-group col-md-6 d-flex flex-column mx-auto">
                              <label for="group">Group:</label>
                              <select id="group" name="group">
                                <?php foreach($groups as $group) { ?>
                                  <option value="<?php echo $group; ?>"><?php echo $group; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary" style="background-color: #2c3e50; color: white;">Зарегистрироваться</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper-base.min.js"
        integrity="sha256-TBhV7lTqTj0yo7/NWWoZITwBZrQKjic7Shr9GdbX1l8=" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
