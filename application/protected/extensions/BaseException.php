<?php


class BaseException extends Exception
{
	private $_data = null;

	public function setData($key, $obj, $throwExceptionOnOverwrite = false)
	{
		$this->addData($key, $obj, $throwExceptionOnOverwrite);
	}
	
	public function getData($key = null)
	{
		return isset($key) ? $this->_data[$key] : $this->_data;
	}
    
    public function addData($key, $obj, $throwExceptionOnOverwrite = false)
    {
        if (isset($this->_data[$key]) && $throwExceptionOnOverwrite) {
			throw new Exception('key: ' . $key . ' already exists.');	
		}
        
        $this->_data[$key] = $obj;
    }
 
}
