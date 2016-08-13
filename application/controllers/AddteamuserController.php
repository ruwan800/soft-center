<?php

class AddteamuserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	Zend_Session::start();
    	$addTeamUserForm = new Application_Form_Addteamuser();
		$tempData = new Zend_Session_Namespace('tempData');
		$page = $this->_getParam('page', False);
		$user = $this->_getParam('user', False);
		$team = $tempData->team;
    	if ($addTeamUserForm->isValid($_POST)){
    		$searchtxt = $addTeamUserForm->getValue('searchtxt');
    		$tempData->txt = $searchtxt;
    		$this->getResult($searchtxt,1);
    	}
    	else if ($user){
			$Addteamuser = new Application_Model_Addteamuser($user,$team);
			$Addteamuser->Addteamuser();
			$this->view->message = "success";
    	}
    	else if ($page){
    		$searchtxt = $tempData->txt;
    		$this->getResult($searchtxt,$page);
    	}
    	else{
        	$this->view->form = $addTeamUserForm;
    	}
	}

	public function getResult($searchtxt,$page){

		$pkgSearch = new Application_Model_Addteamuser($searchtxt);
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

