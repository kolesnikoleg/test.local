<?php
require_once 'autoload.php';

if (isset($_POST['action']))
{
	if ($_POST['action'] === 'reg') {
		if ($_POST['login'] == '') {
			Validate::ajaxResult(false, 'Заполните поле Логин!');
		}

		if ($_POST['password'] == '') {
			Validate::ajaxResult(false, 'Заполните поле Пароль!');
		}

		$login = Validate::secure($_POST['login']);
		$password = Validate::pass_hash($_POST['password']);

		$user = new User ();

		if ($user->isNoExistUser($login)) {
			if ($user->regNewUser($login, $password)) {
				Validate::ajaxResult(true);
			} else {
				Validate::ajaxResult(false, 'Произошла ошибка! Попробуйте позже.');
			}
		} else {
			Validate::ajaxResult(false, 'Пользователь с таком Логином уже существует!');
		}
	}

	if ($_POST['action'] === 'auth') {
		if ($_POST['login'] == '') {
			Validate::ajaxResult(false, 'Заполните поле Логин!');
		}

		if ($_POST['password'] == '') {
			Validate::ajaxResult(false, 'Заполните поле Пароль!');
		}

		$login = Validate::secure($_POST['login']);
		$password = Validate::pass_hash($_POST['password']);

		$user = new User ();

		if (!$user->isNoExistUser($login)) {
			if ( $user->loginPasswordCompare($login, $password)) {
				$user->loginUser($login);
				Validate::ajaxResult(true);
			} else {
				Validate::ajaxResult(false, 'Вы ввели неправильный пароль!');
			}

		} else {
			Validate::ajaxResult(false, 'Пользователя с таком Логином не существует!');
		}
	}
}

?>