<?php


/**
 * Description of pkgService
 *
 * @author Chanaka
 */
class App_Controller_Plugin_Acl
	extends Zend_Controller_Plugin_Abstract
{
    private $_acl = null;
    
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
	if ($request->getModuleName() != 'admin')
	    return;

	$session = new Zend_Session_Namespace('auth');

        if(!$session->authenticatedAsAdmin) {
	    $request->setControllerName('auth');	    
	    return;
        }
        
    }

/*
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $this->_acl = new App_Acl_Acl();
        
        if ('admin' == $request->getModuleName())
            $role = (Zend_Auth::getInstance()->hasIdentity()) ? 'admin' : 'guest';
        else
            $role = (Zend_Auth::getInstance()->hasIdentity()) ? 'user' : 'guest';

        $resource = App_Acl_Resources::REQUESTS_SECTION;
        //If the user has no access we send him elsewhere by changing the request
        if(!$this->_acl->isAllowed($role, $resource)) {
            $request->setControllerName('auth')
                  ->setActionName('index');
            return;
        }

        $module = $request->getModuleName();
        $controller = $request->getControllerName();
        $action = $request->getActionName();    
    }
*/
    
}