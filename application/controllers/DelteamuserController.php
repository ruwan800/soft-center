<?php

class DelteamuserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	Zend_Session::start();
    	$delTeamUserForm = new Application_Form_Delteamuser();
		$tempData = new Zend_Session_Namespace('tempData');
		$page = $this->_getParam('page', False);
		$user = $this->_getParam('user', False);
		$team = $tempData->team;
    	if ($delTeamUserForm->isValid($_POST)){
    		$searchtxt = $delTeamUserForm->getValue('searchtxt');
    		$tempData->txt = $searchtxt;
    		$this->getResult($searchtxt,1);
    	}
    	else if ($user){
			$Delteamuser = new Application_Model_Delteamuser($user,$team);
			$Delteamuser->Delteamuser();
			$this->view->message = "success";
    	}
    	else if ($page){
    		$searchtxt = $tempData->txt;
    		$this->getResult($searchtxt,$page);
    	}
    	else{
        	$this->view->form = $delTeamUserForm;
    	}
	}

	public function getResult($searchtxt,$page){

		$pkgSearch = new Application_Model_Delteamuser($searchtxt);
		$result = $pkgSearch->searchUser();
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

