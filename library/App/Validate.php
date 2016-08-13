<?php

class App_Validate extends Zend_Controller_Plugin_Abstract
{

	public function preDispatch(Zend_Controller_Request_Abstract $request){

		$acl = new App_Acl();
		#$acl = Zend_Registry::get('acl');
		$usersNs = new Zend_Session_Namespace('members');
		If( ! $usersNs->userType){
			$roleName='guest';
		}
		else {
			$roleName=$usersNs->userType;
		}
		$privilageName=$request->getActionName();
		$taskName=$request->getControllerName();
		if(!$acl->acl->isAllowed($roleName,$taskName,$privilageName)){
			$request->setControllerName('Voserror');
			$request->setActionName('baduser');
		}
	}
}
