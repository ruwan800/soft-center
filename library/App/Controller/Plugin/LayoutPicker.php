<?php
/**
 * Description of pkgService
 *
 * @author Chanaka
 */
class App_Controller_Plugin_LayoutPicker
	extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $controllerName = $request->getControllerName();
        if('auth' == $controllerName)
            Zend_Layout::getMvcInstance()->setLayout('auth');
        else if('error' == $controllerName)
            Zend_Layout::getMvcInstance()->setLayout('error');       
        else
            Zend_Layout::getMvcInstance()->setLayout($request->getModuleName());
    }
    
}


