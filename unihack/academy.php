<!DOCTYPE html>
<html>
<head>
	<title>Academy</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		/* Стили для кнопок */
		button {
			display: block;
			margin-bottom: 10px;
			padding: 10px 20px;
			background-color: #2c3e50;
			color: white;
			border: none;
			border-radius: 5px;
			font-size: 14px;
			cursor: pointer;
			transition: background-color 0.3s ease-in-out;
		}

		button:hover {
			background-color: #1a252f;
		}

		/* Стили для блока вывода текста */
		#text {
			padding: 20px;
			border: 1px solid #ddd;
			border-radius: 5px;
			font-size: 20px;
			line-height: 1.5;
			text-align: justify;
			background-color: #f9f9f9;
			height: auto;
			width: auto;
/*			min-height: 400px;*/
			overflow: auto;
		}
		.row {
  display: flex;
}

	</style>
</head>
<body>
	<?php include('navbar.php'); ?>
	<br>
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<!-- Кнопки -->
				<button class = "text-element" onclick="showText(1)">Introduction to Pentesting</button>
				<button class = "text-element" onclick="showText(2)">Reverse engineering</button>
				<button class = "text-element" onclick="showText(3)">Directory Traversal</button>
				<button class = "text-element" onclick="showText(4)">Information Gathering</button>
				<button class = "text-element" onclick="showText(5)">Privilege Elevation</button>
				<button class = "text-element" onclick="showText(6)">SQL Injection</button>
				<button class = "text-element" onclick="showText(7)">PHPBB</button>
				<button class = "text-element" onclick="showText(8)">XSS</button>
				<button class = "text-element" onclick="showText(9)">CSRF</button>
				<button class = "text-element" onclick="showText(10)">SSRF</button>
				<button class = "text-element" onclick="showText(11)">Buffer pollution vulnerability</button>
				<button class = "text-element" onclick="showText(12)">API</button>
				<button class = "text-element" onclick="showText(13)">File upload vulnerabilities</button>
				<button class = "text-element" onclick="showText(14)">RCE</button>
				<button class = "text-element"onclick="showText(15)">Open redirect</button>
			</div>
			<div class="col-md-10"  style="padding-right: -10000px;">
				<!-- Блок вывода текста -->
				<div id="text"></div>
			</div>
		</div>
	</div>


	<!-- Подключаем jQuery и Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@2.9.3/dist/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script>
		// Функция загрузки текста из файла
function loadFile(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                callback(xhr.responseText);
            } else {
                console.log('Error loading file:', xhr.statusText);
            }
        }
    };
    xhr.open('GET', url, true);
    xhr.send();
}

// Функция вывода текста на кнопке

function showText(num) {
    var textDiv = document.getElementById("text");
    loadFile('academyText.txt', function(data) {
        var buttonData = data.split('---');
        if (num <= buttonData.length) {
            textDiv.innerHTML = "<pre>" + buttonData[num-1] + "</pre>";
        } else {
            textDiv.innerHTML = "Error: invalid button number.";
        }
    });
}

// Получаем все элементы с текстом, которые нужно сделать одинакового размера
var textElements = document.querySelectorAll('.text-element');

// Находим максимальную длину текста
var maxLength = 0;
textElements.forEach(function(element) {
    if (element.textContent.length > maxLength) {
        maxLength = element.textContent.length;
    }
});

// Устанавливаем одинаковую ширину для всех элементов с текстом
textElements.forEach(function(element) {
    element.style.width = maxLength;
});



</script>

</body>
</html>