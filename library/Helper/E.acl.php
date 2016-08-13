
<?php
class Helpers_SAcl extends Zend_Controller_Action_Helper_Abstract
{

	
	public function setAcl(){

		$this->acl = new Zend_Acl();
	

		#setting-up roles
		$this->acl->addRole(new Zend_Acl_Role(‘guest’));
		$this->acl->addRole(new Zend_Acl_Role(‘editor’));
		$this->acl->addRole(new Zend_Acl_Role(‘admin’));

		
		#setting-up resources
		$this->acl->add(new Zend_Acl_Resource(‘view’));
		$this->acl->add(new Zend_Acl_Resource(‘edit’));
		$this->acl->add(new Zend_Acl_Resource(‘delete’));


		#setting-up privilages
		$this->acl->allow(‘guest’,null,’view’);
		$this->acl->allow(‘editor’,array(‘view’,’edit’));
		$this->acl->allow(‘admin’);


		#setting-up acl
		Zend_Registry::set(‘acl’,$this->acl);

	}

}
