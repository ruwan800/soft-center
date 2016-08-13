<?php

class Application_Model_Pkgrequest
{
	

	public function newRequest($request)
	{
		$db = Zend_Db_Table::getDefaultAdapter();
		$db->insert('request_management', $request);
	}

}

