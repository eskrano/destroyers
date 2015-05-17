<?php

class  db
{
	function __construct ($db)
	{
		$this->db = $db;
	}

	function query($query,$args)
	{
		$statement = $this->db->prepare($query);
		$statement->execute($args);
		return $statement;
	}

	function rows($query,$args)
	{
		return $this->query($query,$args)->rowCount();
	}

	function fetch ($query,$args)
	{
		$stmt = $this->query($query,$args);
		return $data = $stmt->fetch(PDO::FETCH_ASSOC);
	}

	function fetchAll ($query,$args)
	{
		$stmt =  $this->query($query,$args);
		return $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	function noPrepared ($query)
	{
		$stmt = $this->db->query($query);
	}

	function quote ($var)
	{
		return $var = $this->db->quote($var);
	}

	function last()
	{
		return $this->db->lastInsertId();
	}


	function offEmulate ()
	{
		$this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	}

	function Emulate ($param) {
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, $param);
	}
	

}