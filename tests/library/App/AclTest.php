<?php

class AclTest extends ControllerTestCase 
{
	/**
	 * Our ACL being tested
	 *
	 * @var App_Acl
	 */
	protected $acl;
	
	/**
	 * Authenticator
	 *
	 * @var App_Auth_Authenticator
	 */
	protected $auth;
	
	public function setUp()
	{
		parent::setUp();
		$this->acl = new App_Acl_Acl();
		$this->auth = new App_Auth_Authenticator();
	}
	public function testAdminUserAccountAccess()
	{
		$admin = $this->auth->getCredentials('admin','qwerty');		
		$this->assertTrue($this->acl->isAllowed($admin->role, App_Acl_Resources::ADMIN_SECTION));
		$this->assertTrue($this->acl->isAllowed($admin->role, App_Acl_Resources::EMPLOYEE_PAGE));
		$this->assertFalse($this->acl->isAllowed($admin->role, App_Acl_Resources::REQUESTS_SECTION));
		$this->assertTrue($this->acl->isAllowed($admin->role, App_Acl_Resources::PUBLIC_PAGE));
	}
	public function testGuestUserAccountAccess()
	{
		$user = $this->auth->getCredentials('john', 'pa$$');
		$this->assertFalse($this->acl->isAllowed($user->role, App_Acl_Resources::ADMIN_SECTION));
		$this->assertTrue($this->acl->isAllowed($user->role, App_Acl_Resources::EMPLOYEE_PAGE));
		$this->assertFalse($this->acl->isAllowed($user->role, App_Acl_Resources::REQUESTS_SECTION));
		$this->assertTrue($this->acl->isAllowed($user->role, App_Acl_Resources::PUBLIC_PAGE));
		
	}
	
	public function testAdminAccess()
	{
                $admin = App_Acl_Roles::ADMIN;
		$this->assertTrue($this->acl->isAllowed($admin, App_Acl_Resources::ADMIN_SECTION));
		$this->assertTrue($this->acl->isAllowed($admin, App_Acl_Resources::EMPLOYEE_PAGE));
		$this->assertFalse($this->acl->isAllowed($admin, App_Acl_Resources::REQUESTS_SECTION));
		$this->assertTrue($this->acl->isAllowed($admin, App_Acl_Resources::PUBLIC_PAGE));
	}
	public function testGuestAccess()
	{
		$guest = App_Acl_Roles::GUEST;
		$this->assertFalse($this->acl->isAllowed($guest , App_Acl_Resources::ADMIN_SECTION));
		$this->assertFalse($this->acl->isAllowed($guest , App_Acl_Resources::REQUESTS_SECTION));
		$this->assertFalse($this->acl->isAllowed($guest , App_Acl_Resources::EMPLOYEE_PAGE));
		$this->assertTrue($this->acl->isAllowed($guest , App_Acl_Resources::PUBLIC_PAGE));
		
	}
        public function testEmployeeAccess()
	{
		$useracc = App_Acl_Roles::EMPLOYEE;
		$this->assertFalse($this->acl->isAllowed($useracc , App_Acl_Resources::ADMIN_SECTION));
		$this->assertFalse($this->acl->isAllowed($useracc , App_Acl_Resources::REQUESTS_SECTION));
		$this->assertTrue($this->acl->isAllowed($useracc , App_Acl_Resources::EMPLOYEE_PAGE));
		$this->assertTrue($this->acl->isAllowed($useracc , App_Acl_Resources::PUBLIC_PAGE));

	}
	public function testManagerAccess()
	{
		$manager = App_Acl_Roles::MANAGER;
		$this->assertTrue($this->acl->isAllowed($manager , App_Acl_Resources::ADMIN_SECTION));
		$this->assertTrue($this->acl->isAllowed($manager , App_Acl_Resources::REQUESTS_SECTION));
		$this->assertTrue($this->acl->isAllowed($manager , App_Acl_Resources::EMPLOYEE_PAGE));
		$this->assertTrue($this->acl->isAllowed($manager , App_Acl_Resources::PUBLIC_PAGE));
		
	}
	
	
}

?>