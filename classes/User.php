<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/autoload.php';

class User extends Database
{
	public function isNoExistUser($login)
	{
		$result = $this->select('users', 'id', "login = '" . $login . "'");

		if ($result === false) {
			return true;
		} else {
			return false;
		}
	}

	public function loginPasswordCompare($login, $password)
	{
		$arr = ['login', 'password'];
		$result = $this->select( 'users', $arr, "login = '" . $login . "'" );

		if ($result !== false) {
			if ($result[0]['password'] == $password) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function regNewUser($login, $password)
	{
		$arr = [
			'login' => $login,
			'password' => $password,
		];
		$result = $this->insert('users', $arr);

		if (!$result) {
			return false;
		} else {
			return true;
		}
	}

	public function loginUser($login)
	{
		$_SESSION['user'] = $login;
	}

	public function logoutUser()
	{
		unset( $_SESSION['user'] );
	}

	public function isAuth()
	{
		if (!isset($_SESSION['user'])) {
			return false;
		} else {
			return true;
		}
	}
}