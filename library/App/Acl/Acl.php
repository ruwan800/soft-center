<?php

class App_Acl_Acl extends Zend_Acl
{
	public function __construct()
	{
		// resources		
		$this->add(new Zend_Acl_Resource(App_Acl_Resources::ADMIN_SECTION));
		$this->add(new Zend_Acl_Resource(App_Acl_Resources::EMPLOYEE_PAGE));
                $this->add(new Zend_Acl_Resource(App_Acl_Resources::PUBLIC_PAGE));
                $this->add(new Zend_Acl_Resource(App_Acl_Resources::REQUESTS_SECTION));

		// roles and inheritance
                $this->addRole(new Zend_Acl_Role(App_Acl_Roles::GUEST));
		$this->addRole(new Zend_Acl_Role(App_Acl_Roles::EMPLOYEE),App_Acl_Roles::GUEST);
		$this->addRole(new Zend_Acl_Role(App_Acl_Roles::ADMIN),App_Acl_Roles::EMPLOYEE);
		$this->addRole(new Zend_Acl_Role(App_Acl_Roles::MANAGER),App_Acl_Roles::ADMIN);

                // privileges
		$this->allow(App_Acl_Roles::GUEST , App_Acl_Resources::PUBLIC_PAGE);
		$this->allow(App_Acl_Roles::ADMIN , App_Acl_Resources::ADMIN_SECTION);
		$this->allow(App_Acl_Roles::EMPLOYEE , App_Acl_Resources::EMPLOYEE_PAGE);
                $this->allow(App_Acl_Roles::MANAGER , App_Acl_Resources::REQUESTS_SECTION);
		
	}
}
