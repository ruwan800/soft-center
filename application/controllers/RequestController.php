<?php

class RequestController extends Zend_Controller_Action
{

    public function init()
    {
        $this->model	= new Application_Model_Request();
    }

    public function indexAction()
    {
        $this->view->result = $this->model->getAll();
    }

	public function acceptAcction()
	{
		$request = $this->_getParam('request', Null);
		$action  = $this->_getParam('action', Null);
		switch ($action){
			case 'allow':
				$this->model->allow($request);
				break;
			case 'allowall':
				$this->model->allowAll($request);
				break;
			case 'deny':
				$this->model->deny($request);
				break;
		}
		$this->_forward('index');
	}

}

