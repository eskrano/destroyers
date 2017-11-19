<?php

class Requests 
{
    public function input($key = null)
    {
        return $this->commonRequestLogic('POST',$key);
    }
    
    public function get($key)
    {
        return $this->commonRequestLogic('GET',$key);    
    }
    
    protected function commonRequestLogic($type,$key = null)
    {
        if (null == $key) {
            return $this->getRequestType($type);
        }
        return $this->getRequestType($type)[$key];
    }
    
    protected function getRequestType($type)
    {
        switch ($type) {
            case 'POST':
                return $_POST;
                break;
            case 'GET':
                return $_GET;
                break;
        }
    }
}