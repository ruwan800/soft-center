<?php


/**
 * Description of pkgService
 *
 * @author Chanaka
 */
class App_Controller_Plugin_Auth
	extends Zend_Controller_Plugin_Abstract
{        
    public function preDispatch (Zend_Controller_Request_Abstract $request)
    {
	if ($request->getModuleName() != 'admin')
	    return;            

	if (Model_Users::isLoggedIn() && Model_Users::isAdmin()) {
            //user is logged in and allowed to access admin functions
            return;
        }

        if ($request->getControllerName() != 'login')
        {
            $request->setModuleName('admin')
                    ->setControllerName('login')
                    ->setDispatched(FALSE);
        }
        else return;
        
    }
    
}