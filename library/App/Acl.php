<?php

class App_Acl
{
	public function __construct()
	{

		$this->acl = new Zend_Acl();
	

		#setting-up roles
		$this->acl->addRole(new Zend_Acl_Role('guest'));
		$this->acl->addRole(new Zend_Acl_Role('default'),'guest');
		$this->acl->addRole(new Zend_Acl_Role('admin'),'guest');
		$this->acl->addRole(new Zend_Acl_Role('defaultTO'),'default');
		$this->acl->addRole(new Zend_Acl_Role('adminTO'),'admin');

		
		#setting-up resources
		$this->acl->add(new Zend_Acl_Resource('mpackage'));
		$this->acl->add(new Zend_Acl_Resource('mteam'));
		$this->acl->add(new Zend_Acl_Resource('muser'));
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

		$this->acl->add(new Zend_Acl_Resource('team'));
		$this->acl->add(new Zend_Acl_Resource('search'));
		$this->acl->add(new Zend_Acl_Resource('teamtasks'));
		$this->acl->add(new Zend_Acl_Resource('addteampkg'));
		$this->acl->add(new Zend_Acl_Resource('addteamuser'));
		$this->acl->add(new Zend_Acl_Resource('delteamuser'));
		$this->acl->add(new Zend_Acl_Resource('delteampkg'));
		$this->acl->add(new Zend_Acl_Resource('acceptrequest'));


		$this->acl->add(new Zend_Acl_Resource('adduser'));
		$this->acl->add(new Zend_Acl_Resource('deluser'));
		$this->acl->add(new Zend_Acl_Resource('createteam'));
		$this->acl->add(new Zend_Acl_Resource('delteam'));
		$this->acl->add(new Zend_Acl_Resource('softreport'));
		$this->acl->add(new Zend_Acl_Resource('request'));
		$this->acl->add(new Zend_Acl_Resource('addttpkgs'));
		$this->acl->add(new Zend_Acl_Resource('addutpkgs'));
		$this->acl->add(new Zend_Acl_Resource('delttpkgs'));
		$this->acl->add(new Zend_Acl_Resource('delutpkgs'));
		$this->acl->add(new Zend_Acl_Resource('managepkgs'));


		#setting-up privilages
		$this->acl->allow(	'guest',
							array('index','error','auth','logout','voserror','pkgsearch','cat','pkgdetails','search'));

		$this->acl->allow(	array('default','admin'),
							array('pkginstall','pkgrequest'));

		$this->acl->allow(	'admin',
							array('adduser','deluser','createteam','delteam','softreport',
								  'addttpkgs','addutpkgs','delttpkgs','delttpkgs','managepkgs'));

		$this->acl->allow(	array('defaultTO','adminTO'),
							array('team','teamtasks','addteampkg','addteamuser','delteamuser','delteampkg',
								  'acceptrequest','mpackage','mteam','muser','request'));



		#setting-up acl
		#Zend_Registry::set('acl',$this->acl);


	}
}
