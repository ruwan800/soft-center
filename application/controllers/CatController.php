<?php

class CatController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	Zend_Session::start();
		$tempData = new Zend_Session_Namespace('tempData');
		$category = $this->_getParam('id', False);
		$page = $this->_getParam('page', False);
    	if ($category){
    		$tempData->cat = $category;
    		$this->getCategories($category,1);
    	}
    	else if ($page){
    		$category = $tempData->cat;
    		$this->getCategories($category,$page);
    	}
    	else{
    		$this->view->error = "No category found related with '{$category}'.";
    	}
    }

	public function getCategories($category,$page){
	
		$catSearch = new Application_Model_Catsearch($category);
		$result = $catSearch->getResult();
		if( ! $result){
			$this->view->error = "No result found related with '{$category}'.";
		}
		else{
			Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
			$paginator = Zend_Paginator::factory($result);
			$paginator->setCurrentPageNumber($page);
			$paginator->setItemCountPerPage(20);
			$this->view->paginator = $paginator;
		}
	
	}
	

}

