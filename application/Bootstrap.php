<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{


/**
 * Setup the Custom Helpers
 */
/*
	protected function _initActionHelpers()
    {
#        Zend_Controller_Action_HelperBroker::addPrefix('helpers');
        Zend_Controller_Action_HelperBroker::addHelper(new App_Acl());
    }
*/
	protected function _initPreDispatcher()
    {
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin(new App_Validate());
    }
/*
	protected function _initPostDispatcher()
    {
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin(new App_Geterror());
		
    }
*/
/*
	protected function _initErrorHandler()
	{
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin(new App_ErrorHandler());
	}
*/
}
