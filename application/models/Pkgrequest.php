<?php

class Application_Model_Pkgrequest
{
	protected $_request;
	
	public function __construct($request)
	{
		$this->_request = $request;
	}

	public function newRequest()
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->insert('request_log', $this->_request);
	}

}

