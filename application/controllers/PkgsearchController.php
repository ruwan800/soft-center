<?php

class PkgsearchController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

		Zend_Session::start();
		$tempData = new Zend_Session_Namespace('tempData');
    	$request = $this->getRequest();
    	if ($request->isPost()){
    		$package = $request->getPost('package');
    		if( ! $package){
        		$this->view->error = "No package specified." ;
        	}
        	else{
    			$tempData->pkg = $package;
        	}
    	}
    	else if ($tempData->pkg){
    		$package = $tempData->pkg;
    	}
    	if ($package){
			$search = new Application_Model_Pkgsearch($package);
    		$result = $search->fetchAll();
    		if( ! $result){
    			$this->view->error = "No package found related with '{$package}'.";
    		}
    		else{
    			Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
				$paginator = Zend_Paginator::factory($result);
				$paginator->setCurrentPageNumber($this->_getParam('page', 1));
				$paginator->setItemCountPerPage(20);

				if( ! $paginator){
    				$this->view->error = "No PPPPP." ;
    			}
    			else{
					$this->view->paginator = $paginator;
    			}
    		}
		}
    }

}

