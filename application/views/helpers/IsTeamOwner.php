<?php

class Zend_View_Helper_IsTeamOwner extends Zend_View_Helper_Abstract
{

    public function isTeamOwner()

    {
		$usersNs = new Zend_Session_Namespace('members');
		if ($usersNs->userType == 'adminTO' or $usersNs->userType == 'defaultTO'){
			return True;
		}
		else{
			return False;
		}
    }

}
