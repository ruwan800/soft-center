<?php

/**
 * Description of Packages
 *
 * @author CS
 */
class App_Action_Helper_Packages 
    extends Zend_Controller_Action_Helper_Abstract
{
    /**
    * @var App_pkgService
    */
    protected $_pkgService;

   /**
    * @var Zend_Session_Namespace
    */
    protected $_session;
    /*
     * @var Zend_View
     */
    protected $_view;

    public function preDispatch()
    {
        $this->_pkgService = new App_Service_pkgService;
    }

    protected function _getView()
    {
        if (null !== $this->_view)
        {
            return $this->_view;
        }
        $controller = $this->getActionController();
        $this->_view = $controller->view;
        return $this->_view;
    }

    public function getList($category)
    {
        if (strlen($category) > 0)
        {
            $adapter = new Zend_Paginator_Adapter_Iterator($this->_pkgService->getPkgsInCategory($category));
            $paginator = new Zend_Paginator($adapter);

            // Setup pagination control view script.
            //Zend_View_Helper_PaginationControl::setDefaultViewPartial('partials/pagecontrols.phtml');

            // Read the current page number from the request. Default to 1 if no explicit page number is provided.
            $paginator->setCurrentPageNumber($this->getRequest()->getParam('page',1));

            // set the no of items on a page
            $paginator->setItemCountPerPage(20);

            // get current view
            $view = $this->_getView();
            $view->category = $category;
            $view->paginator = $paginator;
        }
        else
            return false;
    }

    public function getInfo($pkgId)
    {
        if(strlen($pkgId) > 0)
        {            
            $row = $this->_pkgService->getPkg($pkgId);
            
            // get current view
            $view = $this->_getView();
            $view->selpackage = $pkgId;
            $view->packageRow = $row;
        }
    }

    public function getSearchResults($searchTerm)
    {
        if (strlen($searchTerm) > 0)
        {
            $adapter = new Zend_Paginator_Adapter_array($this->_pkgService->ftSearch($searchTerm));
            $paginator = new Zend_Paginator($adapter);

            // Setup pagination control view script.
            //Zend_View_Helper_PaginationControl::setDefaultViewPartial('partials/pagecontrols.phtml');

            // Read the current page number from the request. Default to 1 if no explicit page number is provided.
            $paginator->setCurrentPageNumber($this->getRequest()->getParam('page',1));

            // set the no of items on a page
            $paginator->setItemCountPerPage(20);

            // get current view
            $view = $this->_getView();
            $view->searchTerm = $searchTerm;
            $view->paginator = $paginator;
        }
        else
            return false;
    }
}

