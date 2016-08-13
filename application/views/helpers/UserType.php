<?php

class Zend_View_Helper_UserType extends Zend_View_Helper_Abstract
{

    public function userType()

    {
		$usersNs = new Zend_Session_Namespace('members');
		if ($usersNs->userType){
			return $usersNs->userType;
		}
		else{
			return False;
		}
    }

}
