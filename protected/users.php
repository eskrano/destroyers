<?php

/**
* Общий класс юзеров
* @author Alex Priadko
* @package Mrush Fan
*/

class  Users 
{
	public $db;

	/**
	* Включаем БД
	* @return db connection
	*/

	function __construct ($db)
	{
		$this->db = $db;
	}

	/**
	* Генерируем сессион кей
	* @param string
	* @return string
	*/

	function actionGenerate($login,$password)
	{
		$sql = "SELECT * FROM `users` WHERE `login`=? and `password`=?";
		$placeholders = array ($login,$password);

		$rows = $this->db->rows($sql,$placeholders);
		if ($rows == 0)
		{
			return false;
		}
		$returned =  implode('ELFI',$this->db->fetch($sql,$placeholders));
		return $this->cryptable($returned);
	}

	/**
	* Криптим сессион кей
	* @param string
	* @return md5hash
	*/

	function cryptable($var)
	{
		if (!empty($var))
		{
			return md5(md5(md5($var)));
		}
		return false;
	}

	function actionUpdateToken($var)
	{
		return $_SESSION['token'] = $var;
	}

	function actionCheckSession ($hash)
	{
		$sql = "SELECT * FROM `users` WHERE `auth`=?";
		$placeholders = array($hash);

		if ($rows = $this->db->rows($sql,$placeholders) == 0)
		{
			return $_SESSION['token']  = null;
		}
	}
}