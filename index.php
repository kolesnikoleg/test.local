<?php
require_once 'inc/autoload.php';

if (isset($_GET['user']) AND $_GET['user'] == 'logout') {

	$user = new User ();
	$user->logoutUser ();

	header( "Location: /" );
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>Тестовое задание</title>
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
		<article class="enter">
			<div class="top_wrapper">
				<div class="top_descr">
					<div class="top_centered">
						<div class="top_text">
							<p class="head">ТЕСТОВОЕ ЗАДАНИЕ</p>
							<button type="button" class="btn btn-primary auth">Вход</button>
							<button type="button" class="btn btn-primary reg">Регистрация</button>
						</div>
					</div>
				</div>
			</div>
		</article>
	</section>

	<div class="hidden"></div>

	<div id="reg-popup" class="white-popup mfp-hide">
		<p class="head">РЕГИСТРАЦИЯ</p>
		<div class="content">
			<div class="form-group">
				<label>Логин</label>
				<input type="text" name="login" class="form-control" placeholder="Введите Ваш логин">
			</div>
			<div class="form-group">
				<label>Пароль</label>
				<input type="password "name="password" class="form-control" placeholder="Придумайте сложный пароль">
			</div>
			<p class="error">Введите корректный Email</p>
			<button type="button" class="btn btn-primary">Регистрация</button>
		</div>
	</div>

	<div id="auth-popup" class="white-popup mfp-hide">
		<p class="head">ВХОД</p>
		<div class="content">
			<div class="form-group">
				<label>Логин</label>
				<input type="text" name="login" class="form-control" placeholder="Введите Ваш логин">
			</div>
			<div class="form-group">
				<label>Пароль</label>
				<input type="password" name="password" class="form-control" placeholder="Введите Ваш пароль">
			</div>
			<p class="error">Введите корректный Email</p>
			<button type="button" class="btn btn-primary">Войти</button>
		</div>
	</div>
	<!--[if lt IE 9]>
	<script src="libs/html5shiv/es5-shim.min.js"></script>
	<script src="libs/html5shiv/html5shiv.min.js"></script>
	<script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
	<script src="libs/respond/respond.min.js"></script>
<![endif]-->

<script src="libs/bootstrap/bootstrap.min.js"></script>
<script src="libs/magnific-popup/jquery.magnific-popup.min.js"></script>
<script src="js/common.js"></script>

<script>
	$('#reg-popup button').on("click", function() {
		var login = $('#reg-popup input[name="login"]').val();
		var password = $('#reg-popup input[name="password"]').val();
		var action = 'reg';

		var reg_errors = [];

		function isValidEmailAddress(emailAddress) {
			var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
			return pattern.test(emailAddress);
		}

		if (!isValidEmailAddress( login)) {
			reg_errors.push('Введите корректный Email-адрес!');
		}

		if (login == '') {
			reg_errors.push('Заполните поле Логин!');
		}

		if (password == '') {
			reg_errors.push('Заполните поле Пароль!');
		}

		if (reg_errors.length < 1) {
			$.ajax({
				url: "/inc/handlers.php",
				type: 'post',
				data: {action: action, login: login, password: password},
				success: function(data){
					if (data[0])
					{
						$('#reg-popup input').val('');
						$('#reg-popup .error').css('color', '#00C90B');
						$('#reg-popup .error').text('Вы успешно зарегистрированы!');
						$('#reg-popup .error').css('display', 'block');
					} else {
						$('#reg-popup .error').css('color', '#f00');
						$('#reg-popup .error').text(data[1]);
						$('#reg-popup .error').css('display', 'block');
					}	
				},
				error: function(error) {
					alert('Ошибка AJAX: ' + error);
				},
				dataType: 'json'
			});
		} else {
			$('#reg-popup .error').css('color', '#f00');
			$('#reg-popup .error').text(reg_errors[reg_errors.length - 1]);
			$('#reg-popup .error').css('display', 'block');
		}
	});

	$('#auth-popup button').on("click", function() {
		var login = $('#auth-popup input[name="login"]').val();
		var password = $('#auth-popup input[name="password"]').val();
		var action = 'auth';

		var auth_errors = [];

		if (login == '') {
			auth_errors.push('Заполните поле Логин!');
		}

		if (password == '') {
			auth_errors.push('Заполните поле Пароль!');
		}

		if (auth_errors.length < 1) {
			$.ajax({
				url: "/inc/handlers.php",
				type: 'post',
				data: {action: action, login: login, password: password},
				success: function(data) {
					if (data[0])
					{
						document.location.href = '/account.php';
					} else {
						$('#auth-popup .error').css('color', '#f00');
						$('#auth-popup .error').text(data[1]);
						$('#auth-popup .error').css('display', 'block');
					}	
				},
				error: function(error) {
					alert('Ошибка AJAX: ' + error);
				},
				dataType: 'json'
			});
		} else {
			$('#auth-popup .error').css('color', '#f00');
			$('#auth-popup .error').text(auth_errors[auth_errors.length - 1]);
			$('#auth-popup .error').css('display', 'block');
		}
	});
</script>

</body>
</html>