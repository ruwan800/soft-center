<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


/**
 * Setup the Custom Helpers
 */
	protected function _initActionHelpers()
    {
#        Zend_Controller_Action_HelperBroker::addPrefix('helpers');
        Zend_Controller_Action_HelperBroker::addHelper(new App_Acl_Acl());
    }

	protected function _initPreDispatcher()
    {
		$front = Zend_Controller_Front::getInstance();
		$front->setControllerDirectory('App/Acl')
			  ->setRouter(new Zend_Controller_Router_Rewrite())
			  ->registerPlugin(new App_Acl_Validate());
		$front->dispatch();
    }

}

