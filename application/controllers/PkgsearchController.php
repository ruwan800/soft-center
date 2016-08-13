<?php

class PkgsearchController extends Zend_Controller_Action
{

    public function init()
    {
		$this->search	= new Application_Model_Pkgsearch();
		$this->tempns	= new Zend_Session_Namespace('tempData');

    }

    public function indexAction()
    {

    	$request = $this->getRequest();
		$page = $this->_getParam('page', 1);
    	$text = $request->getPost('package',Null);
    	if($text){
    		$this->tempns->text = $text;
    	}
    	$this->getResult($this->tempns->text,$page);
    }
    
	public function getResult($searchtxt,$page){

		$result = $this->search->getResult($searchtxt);
		if( $result){
			Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
			$paginator = Zend_Paginator::factory($result);
			$paginator->setCurrentPageNumber($page);
			$paginator->setItemCountPerPage(20);
			$this->view->paginator = $paginator;
		}
		else{
			throw new App_Exception("No result found related with '{$searchtxt}'.");
		}
	}

}

