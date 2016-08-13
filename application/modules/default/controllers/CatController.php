<?php

/**
 * Description of IndexController
 *
 * @author CS
 */
class CatController extends Zend_Controller_Action
{
    /**
    * @var App_pkgService
    */
    protected $_pkgService;

   /**
    * @var Zend_Session_Namespace
    */
    protected $_session;

    public function init()
    {
        $this->_helper->ajaxContext->addActionContext('index', 'html')
                                   ->initContext();
        $this->_pkgService = new App_Service_pkgService;
    }

    public function indexAction()
    {
        if ($this->getRequest()->getParam('id'))
        {
            $category = $this->getRequest()->getParam('id');

            $paginator = new Zend_Paginator($this->_pkgService->getPkgsInCategory($category));

            // Setup pagination control view script.
            //Zend_View_Helper_PaginationControl::setDefaultViewPartial('partials/pagecontrols.phtml');

            // Read the current page number from the request. Default to 1 if no explicit page number is provided.
            $paginator->setCurrentPageNumber($this->_getParam('page', 1));

            // set the no of items on a page
            $paginator->setItemCountPerPage(20);

            // assign variables to view
            $this->view->category = $category;
            $this->view->paginator = $paginator;
        }
    }

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

