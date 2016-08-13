<?php

class AddteamuserController extends Zend_Controller_Action
{

    public function init()
    {
		$this->AddTeamUserForm = new Application_Form_Addteamuser();
		$this->AddTeamUser = new Application_Model_Addteamuser();
		$this->searchtxt  = Null;	
    }

    public function indexAction(){

		#$this->view->form = $this->AddTeamUserForm;
		$page = $this->_getParam('page', False);
		if($page){
			$this->getResult($this->searchtxt,$page);
		}
    	else if ( ! $this->AddTeamUserForm->isValid($_POST)){
    		$this->view->form = $this->AddTeamUserForm;
    		$this->render('form');
    	}
    	else{
    		$searchtxt = $this->AddTeamUserForm->getValue('searchtxt');
    		$tempData->txt = $searchtxt;
			$this->searchtxt  = $searchtxt;
    		$this->getResult($searchtxt,1);
    	}
	}

	public function addAction(){
	
		$user = $this->_getParam('name', False);
		$this->AddTeamUser->AddTeamUser($user);
		$this->view->message = "User '{$user}' successfully added to the team.";

	}

	public function getResult($searchtxt,$page){

		$result = $this->AddTeamUser->searchuser($searchtxt);
		if( $result){
			Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
			$paginator = Zend_Paginator::factory($result);
			$paginator->setCurrentPageNumber($page);
			$paginator->setItemCountPerPage(20);
			$this->view->paginator = $paginator;
		}
		else{
			throw new App_Exception("No user found related with '{$searchtxt}'.");
		}
	}


}

