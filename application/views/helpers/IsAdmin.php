<?php

class Zend_View_Helper_IsAdmin extends Zend_View_Helper_Abstract
{

    public function isAdmin()

    {
		$usersNs = new Zend_Session_Namespace('members');
		if ($usersNs->userType == 'admin' or $usersNs->userType == 'adminTO'){
			return True;
		}
		else{
			return False;
		}
    }

}
