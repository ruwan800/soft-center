<?php

class SearchController extends Zend_Controller_Action
{

    public function init()
    {
        $this->form  = new Application_Form_Search();
        $this->model = new Application_Model_Search();
		$this->temp	 = new Zend_Session_Namespace('temp');
		echo "EEEEEEEEEEEEE".$this->temp->count."WWWWWWWWWW";########################
    }

    public function indexAction()
    {

    	$this->temp->action     = $this->_getParam('to', Null);
    	$this->temp->controller = $this->_getParam('for', Null);
		if(! isset($this->temp->count)){
		    	$this->temp->count = 1;
		}
		else{	
		    	$this->temp->count ++;
		}
		echo "AAAAQQ";
#		$this->isAllowed();
#		$this->viewForm();
    }

	public function searchAction()
	{
		$this->isAllowed();
    	if ($this->form->isValid($_POST)){
    		$this->temp->text = $this->form->getValue('text',Null);
			$this->result  = $this->getResult($this->temp->text,1);
    		$this->render('result');
    	}
    	else{
			$this->viewForm();
    	}
	}

	public function resultAction()
	{
		$this->isAllowed();
		$page = $this->_getParam('page', 1);
		$this->result  = $this->getResult($this->temp->text,$page);
	}

	public function viewForm()
	{	
		$this->form->setAction("/search/search");
        $this->view->form   = $this->form;
        $this->render('form');
		
	}

	public function getResult($text,$page){

		$result = $this->model->search($this->temp->action,$text);
		if( $result){
			Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
			$paginator = Zend_Paginator::factory($result);
			$paginator->setCurrentPageNumber($page);
			$paginator->setItemCountPerPage(20);
			$this->view->paginator = $paginator;
			$this->view->controller = $this->temp->controller;
			$this->view->action = $this->temp->action;
		}
		else{
			throw new App_Exception("No result found related with '{$text}'.");
		}
	}

	public function isAllowed(){
		echo "EEEEEEEEEEEEE".$this->temp->count."WWWWWWWWWW";########################
		$user = new Application_Model_User();
		$acl = new App_Acl();
		if(!$acl->acl->isAllowed($user->getUserType(),$this->temp->controller,$this->temp->action)){
			#throw new App_Exception("You are not allowed to perform this action.");
		}
	}

}

