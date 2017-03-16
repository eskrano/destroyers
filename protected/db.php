<?php

/**
 * Class db
 * Simple pdo wrapper
 */

class  db
{
    
	public function __construct ($db)
	{
		$this->db = $db;
	}

    /**
     * @param $query
     * @param $args
     * @return mixed
     */
	public function query($query,$args)
	{
		$statement = $this->db->prepare($query);
		$statement->execute($args);
		return $statement;
	}

    /**
     * @param $query
     * @param $args
     * @return mixed
     */
	public function rows($query,$args)
	{
		return $this->query($query,$args)->rowCount();
	}

    /**
     * @param $query
     * @param $args
     * @return mixed
     */
	public function fetch ($query,$args)
	{
		$stmt = $this->query($query,$args);
		return $data = $stmt->fetch(PDO::FETCH_ASSOC);
	}

    /**
     * @param $query
     * @param $args
     * @return mixed
     */
	public function fetchAll ($query,$args)
	{
		$stmt =  $this->query($query,$args);
		return $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

    /**
     * @param $query
     * @return mixed
     */
	public function noPrepared ($query)
	{
		return $this->db->query($query);
	}

    /**
     * @param $var
     * @return mixed
     */
	public function quote ($var)
	{
		return $var = $this->db->quote($var);
	}

    /**
     * @return mixed
     */
	public function last()
	{
		return $this->db->lastInsertId();
	}

    /**
     * off emulating
     * @return void
     */
	public function offEmulate ()
	{
		$this->db->setAttribute( PDO::ATTR_EMULATE_PREPARES, false );
	}

    /**
     * @deprecated
     * @param $param
     */
	public function Emulate ($param) {
		return $this->onEmulate($param);
	}

    /**
     * @param $param
     */
	public function onEmulate($param)
    {
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, $param);
    }
	

}