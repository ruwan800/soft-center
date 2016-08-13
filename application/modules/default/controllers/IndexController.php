<?php

/**
 * class for controlling and displaying 
 * packages based on their sections 
 * 
 */

class IndexController extends Zend_Controller_Action
{
   /**
    * @var App_pkgService 
    */
    protected $_pkgService;
    
   /**
    * @var Zend_Session_Namespace
    */
    protected $_session;
    
   /**
    * Stores Zend_Db_Table_Row objects
    * 
    * @var array
    */
    protected $_sectsRowset;

    public function init()
    {
        $this->_helper->ajaxContext->addActionContext('index', 'html')
                                   ->initContext();
    }
   /**
    * actions for initialization 
    */
    public function preDispatch() 
    {   
        $this->_session = new Zend_Session_Namespace('Default');
         
        if (!isset($this->_session->selcomponent))
        {
            $this->_session->selcomponent = "main";            
        }
        else
        {               
            if($this->getRequest()->isPost())
                $this->_session->selcomponent = $this->getRequest()->getParam('component');          
        }
        
        if (!isset($this->_session->selsection))
            $this->_session->selsection = "admin";                    
        else
        {
            if($this->getRequest()->getParam('sectid'))
                $this->_session->selsection = $this->getRequest()->getParam('sectid');          
        }
                
        $this->_pkgService = new App_Service_pkgService;        
    }
    
   /**
    * Displays the list of sections for a selected component
    */
    public function indexAction()
    {   
        if($this->getRequest()->isPost())
        {
            // get selected component name
            $selcomponent = $this->getRequest()->getParam('component');               

            // save selected component name to session
            $this->_session->selcomponent = $selcomponent;

            $paginator = new Zend_Paginator($this->_pkgService->getSectsInComponent($selcomponent));                                                                  
        }
        else
        {
            $selcomponent = $this->_session->selcomponent;
            $paginator = new Zend_Paginator($this->_pkgService->getSectsInComponent($selcomponent));

            // Read the current page number from the request. Default to 1 if no explicit page number is provided.
            $paginator->setCurrentPageNumber($this->_getParam('page', 1));
        }         
  
        // Setup pagination control view script.
        //Zend_View_Helper_PaginationControl::setDefaultViewPartial('partials/pagecontrols.phtml');

        // set the no of items on a page
        $paginator->setItemCountPerPage(10);

        // Assign the Paginator object to the view
        $this->view->paginator = $paginator;

        // assign variables to view
        $this->view->components = array('main', 'multiverse', 'universe', 'restricted');            
        $this->view->selcomponent = $this->_session->selcomponent;                                         
    }

   /**
    * Lists the packages for a selected section
    */
    public function listAction()
    {        
        if ($this->getRequest()->getParam('sectid'))
        {            
            $selsection = $this->getRequest()->getParam('sectid');

            $paginator = new Zend_Paginator($this->_pkgService->getPkgsInSection($selsection));

            // Setup pagination control view script.
            //Zend_View_Helper_PaginationControl::setDefaultViewPartial('partials/pagecontrols.phtml');

            // Read the current page number from the request. Default to 1 if no explicit page number is provided.
            $paginator->setCurrentPageNumber($this->_getParam('page', 1));

            // set the no of items on a page
            $paginator->setItemCountPerPage(20);

            // assign variables to view
            $this->view->selsection = $selsection;
            $this->view->paginator = $paginator;
        }
    }
    
   /**
    * Displays the info about a package
    */    
    public function infoAction()
    {        
        if ($this->getRequest()->getParam('pkgid'))
        {   
            $selpackage = $this->getRequest()->getParam('pkgid');            
            // cache this
            $row = $this->_pkgService->getPkg($selpackage);            
            // assign variables to view
            $this->view->selpackage = $selpackage;
            $this->view->packageRow = $row;			
        }     
    }


}



