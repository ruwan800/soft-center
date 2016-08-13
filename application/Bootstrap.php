<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
/*    public function _initDoctrine()
    {
        $this->getApplication()->getAutoloader()
            ->pushAutoloader(array('Doctrine', 'autoload'));
        spl_autoload_register(array('Doctrine', 'modelsAutoload'));
        
        $manager = Doctrine_Manager::getInstance();
        $manager->setAttribute(Doctrine::ATTR_AUTO_ACCESSOR_OVERRIDE, true);
        $manager->setAttribute(
          Doctrine::ATTR_MODEL_LOADING,
          DOctrine::MODEL_LOADING_CONSERVATIVE
        );
        $manager->setAttribute(Doctrine::ATTR_AUTOLOAD_TABLE_CLASSES, true);

        $doctrineConfig = $this->getOption('doctrine');

        Doctrine::loadModels($doctrineConfig['models_path']);
       
        $conn = Doctrine_Manager::connection($doctrineConfig['dsn'],'doctrine');
        $conn->setAttribute(Doctrine::ATTR_USE_NATIVE_ENUM, true);
        return $conn;
    }
*/
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
        $view->doctype(Zend_View_Helper_Doctype::HTML5);
    }

    protected function _initViewHelpers()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->addHelperPath('App/View/Helper','App_View_Helper');
        $view->addHelperPath('ZendX/JQuery/View/Helper','ZendX_JQuery_View_Helper');
    }   

    /**
     * used for handling top-level navigation
     * @return Zend_Navigation
     */
    protected function _initNavigation()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $config = new Zend_Config_Xml(APPLICATION_PATH . '/configs/navigation.xml', 'nav');

        $container = new Zend_Navigation($config);
        $view->navigation($container);

    }

}

