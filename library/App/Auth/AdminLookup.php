<?php

class App_Auth_AdminLookup {
	private static $users = array(
		"admin"	=> "qwerty",
	);
	
	
	public static function findByUsername($username)
	{
		if (array_key_exists($username, self::$users))
		{
			$account = new stdClass();
			$account->role	   = App_Acl_Roles::ADMIN;
			$account->username = $username;
			$account->password = self::$users[$username];
			$account->description = "Administrator Account";
			return $account;
		}
		return false;
	}
}
