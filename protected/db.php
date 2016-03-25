<?php

class  db
{
    
	public function __construct ($db)
	{
		$this->db = $db;
	}

	public function query($query,$args)
	{
		$statement = $this->db->prepare($query);
		$statement->execute($args);
		return $statement;
	}

	public function rows($query,$args)
	{
		return $this->query($query,$args)->rowCount();
	}

	public function fetch ($query,$args)
	{
		$stmt = $this->query($query,$args);
		return $data = $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function fetchAll ($query,$args)
	{
		$stmt =  $this->query($query,$args);
		return $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function noPrepared ($query)
	{
		$stmt = $this->db->query($query);
	}

	public function quote ($var)
	{
		return $var = $this->db->quote($var);
	}

	public function last()
	{
		return $this->db->lastInsertId();
	}


	public function offEmulate ()
	{
		$this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	}

	public function Emulate ($param) {
		$this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, $param);
	}
	

}