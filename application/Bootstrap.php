<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
/**
 * Setup the Custom Helpers
 */

#Zend_Controller_Action_HelperBroker::addPrefix('Dc_Helper');


	protected function _initActionHelpers()
    {
        Zend_Controller_Action_HelperBroker::addPrefix('helpers');
    }


}

