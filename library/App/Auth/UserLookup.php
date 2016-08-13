<?php

class App_Auth_UserLookup 
{
	private static $users = array(
		"john"	=> "pa$$",
		"emily"	=> "pa$$",
		"robert"=> "pa$$",
		"eric"	=> "pa$$"
	);
	
	public static function findByUsername($username)
	{
		if (array_key_exists($username, self::$users))
		{
			$account = new stdClass();
			$account->role	   = App_Acl_Roles::EMPLOYEE;
			$account->username = $username;
			$account->password = self::$users[$username];
			$account->description = "employee account";
			return $account;
		}
		return false;
	}
	
}
