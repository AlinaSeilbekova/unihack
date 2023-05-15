<!DOCTYPE html>
<html>
<head>
	<title>Labs</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.lab {
			width: 100%;
			border: 1px solid #ccc;
			border-radius: 5px;
			padding: 10px;
			margin-bottom: 10px;
			background-color: #f9f9f9;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
		}

		.lab h3 {
			margin-top: 0;
		}

		.lab a {
			color: #337ab7;
			text-decoration: none;
		}

		.lab a:hover {
			text-decoration: underline;
		}

		.lab-details {
			display: none;
			margin-top: 10px;
			padding: 10px;
			border: 1px solid #ccc;
			border-radius: 5px;
			background-color: #ffffff;
		}

		.lab-details p {
			margin: 0;
		}

		.lab-details input[type="text"] {
			width: 100%;
			margin-top: 10px;
			padding: 5px;
		}
	</style>
</head>
<body>
	<?php
	include('navbar.php');
// Подключение к базе данных и получение названий лабораторных работ
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

function getAllLabs()
{
    global $dbh;
    $query = "SELECT * FROM labs";
    $stmt = $dbh->prepare($query);
    $stmt->execute();

    $labsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $labsData;
}

function getLabFilePath($labId)
{
    // Здесь вы можете определить логику формирования пути к файлу на основе labId
    $base_path = "labs/l";
    $lab_filename = "lab" . $labId;
    $file_path = $base_path . $labId . "/" . $lab_filename . ".php";
    return $file_path;
}

function updateLabDetails($labId, $title, $descr)
{
    global $dbh;
    $query = "UPDATE labs SET title = :title, descr = :descr WHERE id = :labId";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':descr', $descr);
    $stmt->bindParam(':labId', $labId);
    $stmt->execute();
}

$labs = getAllLabs();

if ($labs) {
    foreach ($labs as $lab) {
        $id = $lab['id'];
        $title = $lab['title'];
        $descr = $lab['descr'];
        $checkPass = $lab['checkPass'];
        $file_path = getLabFilePath($id);



if(isset($_GET['show_popup'])) {
    // Проверяем, был ли передан параметр 'show_popup'
    // Если параметр существует, выводим JavaScript-код для отображения всплывающего окна
    echo '<script type="text/javascript">
                window.onload = function() {
                    var popup = document.createElement("div");
                    popup.style.width = "400px";
                    popup.style.height = "400px";
                    popup.style.background = "white";
                    popup.style.position = "fixed";
                    popup.style.top = "50%";
                    popup.style.left = "50%";
                    popup.style.transform = "translate(-50%, -50%)";
                    popup.style.boxShadow = "0px 0px 20px rgba(0, 0, 0, 0.5)";
                    popup.style.padding = "20px";
                    popup.innerHTML = "<h1>Добавить новую лабораторную</h1>";
                    popup.innerHTML += "<form action=\"process.php\" method=\"post\">";
                    popup.innerHTML += "<label for=\"name\">Название:</label>";
                    popup.innerHTML += "<input type=\"text\" name=\"name\" id=\"name\"><br>";
                    popup.innerHTML += "<label for=\"description\">Описание:</label>";
                    popup.innerHTML += "<input type=\"text\" name=\"description\" id=\"description\"><br>";
                    popup.innerHTML += "<input type=\"submit\" value=\"Отправить\">";
                    popup.innerHTML += "<button type=\"button\" onclick=\"closePopup()\">Отмена</button>";
                    popup.innerHTML += "</form>";

                    document.body.appendChild(popup);
                    
                    function closePopup() {
                        document.body.removeChild(popup);
                    }
                }
            </script>';
}
?>

	<h1>All Labs</h1>

	<br>
<a href="?show_popup=true">Добавить новую лабораторную</a>
        <div class="lab">
            <h3>
                <input type="text" id="title_<?php echo $id; ?>" name="title" value="<?php echo $title; ?>">
            </h3>
            <a href="#" class="toggle-details">Подробнее</a>
            <div class="lab-details">
                <p>
                    <textarea id="descr_<?php echo $id; ?>" name="descr"><?php echo $descr; ?></textarea>
                </p>
                <a href="<?php echo $file_path; ?>">Ссылка на лабораторную работу</a>
                <br>
                <input type="text" name="checkPass" value="<?php echo $checkPass; ?>">
                <br>
                <button onclick="saveLabDetails(<?php echo $id; ?>)">Сохранить</button>
            </div>
        </div>
<?php
    }
} else {
    echo "Нет доступных лабораторий.";
}

$dbh = null;
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.toggle-details').click(function(e) {
            e.preventDefault();
			var labDetails = $(this).siblings('.lab-details');
			labDetails.toggle();
		});	
        	$('textarea').on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
});

function saveLabDetails(labId) {
    var title = $('#title_' + labId).val();
    var descr = $('#descr_' + labId).val();

    var data = {
        labId: labId,
        title: title,
        descr: descr
    };

    $.ajax({
        type: 'POST',
        url: 'changeLabs.php',
        data: JSON.stringify(data),
        contentType: 'application/json',
        success: function(response) {
            alert(response);
        },
        error: function(xhr, status, error) {
            console.log(xhr.responseText);
        }
    });
}

</script>
</body>
</html>