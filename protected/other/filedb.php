<?php

class filedb
{
    /**
     * @var
     */
    private $path;

    /**
     * @param $path
     * @return $this
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function open($name)
    {
        $contents = file_get_contents(sprintf("%s/%s.json", $this->path, $name));

        return json_decode($contents, true);
    }

    /**
     * @param $name
     * @param $data
     * @return bool|int
     */
    public function save($name, $data)
    {
        return file_put_contents(
            sprintf("%s/%s.json", $this->path, $name),
            json_encode($data)
        );
    }
}