<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        $this->form  	= new Application_Form_Search();
        $this->model 	= new Application_Model_Search();
		$this->nssearch	= new Zend_Session_Namespace('search');
    }

    public function indexAction()
    {
		if( ! $this->isAllowed()){
			return;
		}
		$this->viewForm();
    }

	public function searchAction()
	{
		if( ! $this->isAllowed()){
			return;
		}
    	if ($this->form->isValid($_POST)){
    		$this->nssearch->text = $this->form->getValue('text',Null);
			$this->result  = $this->getResult(1);
    		$this->render('result');
    	}
    	else{
			$this->viewForm();
    	}
	}

	public function errorAction()
	{	
	}

	public function resultAction()
	{
		if( ! $this->isAllowed()){
			return;
		}
		$page = $this->_getParam('page', 1);
		$this->result  = $this->getResult($page);
	}

	public function returnAction()
	{
		$this->nssearch->value = $this->_getParam('value', Null);
		$this->_forward($this->nssearch->action, $this->nssearch->controller);
	}


	public function viewForm()
	{	
		$this->form->setAction("/search/search");
        $this->view->form   = $this->form;
        $this->render('form');
	}

	public function getResult($page)
	{
		$result = $this->model->search();
		if( $result){
			Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
			$paginator = Zend_Paginator::factory($result);
			$paginator->setCurrentPageNumber($page);
			$paginator->setItemCountPerPage(20);
			$this->view->paginator = $paginator;
		}
		else{
			throw new App_Exception("No result found related with '{$this->nssearch->text}'.");
		}
	}

	public function isAllowed()
	{
		$user	= new Application_Model_User();
		$acl	= new App_Acl();
		if(!$acl->acl->isAllowed($user->getUserType(), $this->nssearch->controller, $this->nssearch->action)){
			$this->_forward('error');
			return False;
			#throw new App_Exception("Please select your task again.");
			#throw new App_Exception(":ER:".$user->getUserType().":ER:".$this->nssearch->controller.":ER:".$this->nssearch->action.":ER:");
		}
		return True;
	}

}

