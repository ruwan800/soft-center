<?php

class AddteampkgController extends Zend_Controller_Action
{

    public function init()
    {
		$this->addTeamPkgForm = new Application_Form_Addteampkg();
		$this->AddTeamPkg = new Application_Model_Addteampkg();
		$this->searchtxt  = Null;
    }

    public function formAction(){

		$page = $this->_getParam('page', False);
		if($page){
			$this->getResult($this->searchtxt,$page);
		}
    	else if ($this->addTeamPkgForm->isValid($_POST)){
    		$searchtxt = $this->addTeamPkgForm->getValue('searchtxt');
    		$tempData->txt = $searchtxt;
			$this->searchtxt  = $searchtxt;
    		$this->getResult($searchtxt,1);
    	}
    	else{
    		$this->view->form = $this->addTeamPkgForm;
    		$this->render('index');
    	}
	}

	public function addAction(){
	
		$package = $this->_getParam('package', False);
		$this->AddTeamPkg->addTeamPkg($package);
		$this->view->message = "Package '{$package}' successfully added to the team.";

	}

	public function getResult($searchtxt,$page){

		$result = $this->AddTeamPkg->searchPackage($searchtxt);
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

	public function indexAction(){
	
        $this->view->form = $this->addTeamPkgForm;

	}

}

