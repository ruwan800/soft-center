<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAppAutoload()
    {
        $moduleLoad = new Zend_Application_Module_Autoloader(array(
           'namespace' => '',
           'basePath'   => APPLICATION_PATH
        ));
    }
    protected function _initAutoload()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace(array('App_'));
    }
    
    protected function _initDoctype()
    {
        $this->bootstrap('view');

        $view = $this->getResource('view');
        //$view->docType('XHTML1_STRICT');
        $view->doctype(Zend_View_Helper_Doctype::HTML5);
    }

    protected function _initViewHelpers()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        //$view->addHelperPath('App/View/Helper','App_View_Helper');
        //$view->addHelperPath('ZendX/JQuery/View/Helper','ZendX_JQuery_View_Helper');
    }   

    /**
     * used for handling top-level navigation
     * @return Zend_Navigation
     */
    protected function _initNavigation()
    {        
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');

        $container = new Zend_Navigation($config);
        $view->navigation($container);

    }
            
}

