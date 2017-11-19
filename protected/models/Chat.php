<?php

class modelChat
{
    /**
     * @var db
     */
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }


    public function countMessages()
    {
        return $this->db->query("SELECT `id` FROM `chat`", [])->rowCount();
    }

    public function clear()
    {
        return $this->db->noPrepared("TRUNCATE `chat`");
    }
}