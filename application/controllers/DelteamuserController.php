<?php

class DelteamuserController extends Zend_Controller_Action
{

    public function init()
    {
    	$this->form = new Application_Form_Delteamuser();
		$this->team	= new Zend_Session_Namespace('tempData');
		$this->model= new Application_Model_Delteamuser();
		$this->text	= Null;
}

    public function indexAction()
    {

		$page = $this->_getParam('page', False);
		if($page){
			$this->getResult($text,$page);
		}
    	else if ($this->form->isValid($_POST)){
    		$text = $this->form->getValue('searchtxt');
			$this->text  = $text;
    		$this->getResult($this->text,1);
    	}
    	else{
    		$this->view->form = $this->form;
    		$this->render('index');
    	}


		public function deleteAction(){
		
			$package = $this->_getParam('package', False);
			$this->model->delTeamPkg($package);
			$this->view->message = "success";

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

	public function indexAction(){
	
		$this->view->form = $this->form;
	
	}


}

