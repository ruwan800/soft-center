<?php

class App_Acl_Validate extends Zend_Controller_Plugin_Abstract
{

	public function preDispatch(Zend_Controller_Request_Abstract $request){


		$acl = Zend_Registry::get('acl');
		$usersNs = new Zend_Session_Namespace('members');
		If( ! $usersNs->userType){
			$roleName='guest';
		}
		else {
			$roleName=$usersNs->userType;
		}
		$privilageName=$request->getActionName();
		$taskName=$request->getControllerName();
		if(!$acl->isAllowed($roleName,$taskName,$privilageName)){
			$request->setControllerName('Voserror');
			$request->setActionName('baduser');
		}
	}
}
