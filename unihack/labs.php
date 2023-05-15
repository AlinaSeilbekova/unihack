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
	<?php include('navbar.php'); ?>
	<h1>All Labs</h1>

	<?php
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

	function getAllLabs(){
		global $dbh;
		$query = "SELECT * FROM labs";
		$stmt = $dbh->prepare($query);
		$stmt->execute();

		$labsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $labsData;
	}

	function getLabFilePath($labId) {
		// Здесь вы можете определить логику формирования пути к файлу на основе labId
		$base_path = "labs/l";
		$lab_filename = "lab" . $labId;
		$file_path = $base_path . $labId . "/" . $lab_filename . ".php";
		return $file_path;
	}

	$labs = getAllLabs();

	if($labs) {
		foreach ($labs as $lab) {
			$id = $lab['id'];
			$title = $lab['title'];
			$descr = $lab['descr'];
			$file_path = getLabFilePath($id);
	?>
			<div class="lab">
			<h3><?php echo $title; ?></h3>
			<a href="#" class="toggle-details">Подробнее</a>
			<div class="lab-details">
				<p><?php echo $descr?></p>
				<a href="<?php echo $file_path; ?>">Link to the lab</a>
				<br>
				<input type="text" name="checkPass" placeholder="Введите пароль для подтверждения">
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
				var labDetails = $(this).next('.lab-details');
				labDetails.slideToggle();
				$(this).toggle();
				labDetails.find('.toggle-hide').toggle();
			});
		});
	</script>

</body>
</html>