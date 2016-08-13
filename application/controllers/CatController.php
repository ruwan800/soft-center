<?php

class CatController extends Zend_Controller_Action
{

    public function indexAction()
    {
		$category = $this->_getParam('id', False);
		$page = $this->_getParam('page', 1);
		$catSearch = new Application_Model_Catsearch();
		$result = $catSearch->getResult($category);
		if($result){
			Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
			$paginator = Zend_Paginator::factory($result);
			$paginator->setCurrentPageNumber($page);
			$paginator->setItemCountPerPage(20);
			$this->view->paginator = $paginator;
		}
		else{
			throw new App_Exception("No result found related with '{$category}'.");
		}

    }
}
