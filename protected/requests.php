<?php

class Requests {
	function  __construct() {}


	function get ($param,$type)
	{

		if ($type == 'int')
		{
			return isset($_GET[$param]) ? (int) abs($_GET[$param]) : null;
		}

		return isset($_GET[$param]) ? trim(htmlspecialchars($_GET[$param])) : null;
	}

	function post ($param,$type,$regulars =  null)
	{
		$regulars =  array()
	}
}