<?php

class DelteampkgController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	Zend_Session::start();
    	$delTeamPkgForm = new Application_Form_Delteampkg();
		$tempData = new Zend_Session_Namespace('tempData');
		$page = $this->_getParam('page', False);
		$package = $this->_getParam('package', False);
		$team = $tempData->team;
    	if ($delTeamPkgForm->isValid($_POST)){
    		$searchtxt = $delTeamPkgForm->getValue('searchtxt');
    		$tempData->txt = $searchtxt;
    		$this->getResult($searchtxt,1);
    	}
    	else if ($package){
			$Delteampkg = new Application_Model_Delteampkg($package,$team);
			$Delteampkg->Delteampkg();
			$this->view->message = "success";
    	}
    	else if ($page){
    		$searchtxt = $tempData->txt;
    		$this->getResult($searchtxt,$page);
    	}
    	else{
        	$this->view->form = $delTeamPkgForm;
    	}
	}

	public function getResult($searchtxt,$page){

		$pkgSearch = new Application_Model_Delteampkg($searchtxt);
		$result = $pkgSearch->searchPackage();
		if( ! $result){
			$this->view->error = "No result found related with '{$searchtxt}'.";
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

