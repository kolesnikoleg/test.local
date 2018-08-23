<?php
require_once 'inc/autoload.php';

$user = new User ();
if (!$user->isAuth()) {
	header( "Location: /" );
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Аккаунт</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="shortcut icon" href="favicon.png" />
	<link rel="stylesheet" href="libs/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="libs/magnific-popup/magnific-popup.css">
	<link rel="stylesheet" href="css/main.css" />
	<link rel="stylesheet" href="css/media.css" />
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
</head>
<body>
	
	<section>
		<article class="account">
			<p class="head">Приветствуем, <?= $_SESSION['user'] ?>. <a href="/index.php?user=logout">Выход</a></p>

			<div class="main">
				<p><a class="btn" href="add.php">Создать задание</a></p>

				<table>
					<tr class="header">
						<td>ID</td>
						<td>Заголовок</td>
						<td>Содержание</td>
						<td>Статус</td>
						<td>Дата</td>
					</tr>
				</table>
			</div>
		</article>
	</section>

	<div class="hidden"></div>

	
	<!--[if lt IE 9]>
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
<![endif]-->

<script src="libs/bootstrap/bootstrap.min.js"></script>
<script src="libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="js/common.js"></script>

</body>
</html>