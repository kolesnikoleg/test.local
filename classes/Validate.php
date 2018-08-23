<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/autoload.php';

class Validate
{
	public static function secure($string)
	{
		return htmlspecialchars(addslashes($string));
	}

	public static function pass_hash($pass)
	{	
		$config = new Config ();
		return md5($_POST['password'] . $config->secret);
	}

	public static function ajaxResult($result, $message = '')
	{
		echo json_encode(array($result, $message));
	    exit();
	}
}