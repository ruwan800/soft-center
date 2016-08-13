<?php

class App_Acl_Acl extends Zend_Controller_Action_Helper_Abstract
{
	public function __construct()
	{

		$this->acl = new Zend_Acl();
	

		#setting-up roles
		$this->acl->addRole(new Zend_Acl_Role('guest'));
		$this->acl->addRole(new Zend_Acl_Role('default'),'guest');
		$this->acl->addRole(new Zend_Acl_Role('admin'),'guest');
		$this->acl->addRole(new Zend_Acl_Role('defaultTL'),'default');
		$this->acl->addRole(new Zend_Acl_Role('adminTL'),'admin');

		
		#setting-up resources
		$this->acl->add(new Zend_Acl_Resource('index'));
		$this->acl->add(new Zend_Acl_Resource('error'));
		$this->acl->add(new Zend_Acl_Resource('cat'));
		$this->acl->add(new Zend_Acl_Resource('pkgdetails'));
		$this->acl->add(new Zend_Acl_Resource('auth'));
		$this->acl->add(new Zend_Acl_Resource('logout'));
		$this->acl->add(new Zend_Acl_Resource('pkgsearch'));
		$this->acl->add(new Zend_Acl_Resource('voserror'));

		$this->acl->add(new Zend_Acl_Resource('pkginstall'));
		$this->acl->add(new Zend_Acl_Resource('pkgrequest'));

		$this->acl->add(new Zend_Acl_Resource('myteams'));
		$this->acl->add(new Zend_Acl_Resource('teamtasks'));
		$this->acl->add(new Zend_Acl_Resource('addteampkg'));
		$this->acl->add(new Zend_Acl_Resource('addteamuser'));
		$this->acl->add(new Zend_Acl_Resource('delteamuser'));
		$this->acl->add(new Zend_Acl_Resource('delteampkg'));


		$this->acl->add(new Zend_Acl_Resource('adduser'));
		$this->acl->add(new Zend_Acl_Resource('createteam'));
		$this->acl->add(new Zend_Acl_Resource('delteam'));
		$this->acl->add(new Zend_Acl_Resource('softreport'));
		$this->acl->add(new Zend_Acl_Resource('requestlog'));


		#setting-up privilages
		$this->acl->allow(	'guest',
							array('index','error','auth','logout','voserror','pkgsearch','cat','pkgdetails'));

		$this->acl->allow(	array('default','admin'),
							array('pkginstall','pkgrequest'));

		$this->acl->allow(	'admin',
							array('adduser','createteam','delteam','softreport','requestlog'));

		$this->acl->allow(	array('defaultTL','adminTL'),
							array('myteams','teamtasks','addteampkg','addteamuser','delteamuser','delteampkg',));



		#setting-up acl
		Zend_Registry::set('acl',$this->acl);


	}
}
