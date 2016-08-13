<?php

class App_Auth_Authenticator {
	
	protected $errorMessage;	
	
	const ERR_NOT_FOUND 	= "User is not found";
	const ERR_BAD_PASSWORD 	= "password is invalid"; 
	
	public function getCredentials($username, $password)
	{
		$freeUser = $this->validateUser($username, $password, 'App_Auth_UserLookup');
		if ($freeUser)
			return $freeUser;
		
		$adminUser = $this->validateUser($username, $password, 'App_Auth_AdminLookup');
		if ($adminUser)
			return $adminUser;
		
		if (isset($this->errorMessage))
			return false;
			
		$this->errorMessage = self::ERR_NOT_FOUND;
		return false;		
		
	}
	private function validateUser($username, $password, $lookup)
	{
		$refClass  = new ReflectionClass($lookup);
		$refMethod = $refClass->getMethod('findByUsername');
		$user = $refMethod->invoke(null, $username);
		
		if ($user)
		{
			if ($user->password != $password)
			{
				$this->errorMessage = self::ERR_BAD_PASSWORD;
				return false;
			}
			return $user;			
		}
		return false;	
	}
	
	public function getErrorMessage()
	{
		return $this->errorMessage;
	}
	
}
