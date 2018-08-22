<?php
require_once 'config_class.php';
require_once 'database_class.php';
$db = new DataBase ();
$config = new Config ();

if (isset($_POST['action']))
{
	if ($_POST['action'] === 'reg') 
	{
		if ( $_POST['login'] == '' ) {
			echo json_encode( array( false, 'Заполните поле Логин!' ) );
	        exit();
		}

		if ( $_POST['password'] == '' ) {
			echo json_encode( array( false, 'Заполните поле Пароль!' ) );
	        exit();
		}

		$login = htmlspecialchars( addslashes( $_POST['login'] ) );
		$password = md5( $_POST['password'].$config->secret );

		if ( $db->isNoExistUser($login) ) {
			if ( $db->regNewUser( $login, $password ) ) {
				echo json_encode( array( true ) );
	        	exit();
			} else {
				echo json_encode( array( false, 'Произошла ошибка! Попробуйте позже.' ) );
	        	exit();
			}
		} else {
			echo json_encode( array( false, 'Пользователь с таком Логином уже существует!' ) );
	        exit();
		}
	}
}

?>