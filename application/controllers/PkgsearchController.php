<?php

class PkgsearchController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$request = $this->getRequest();
    	if ( ! $request->isPost()){
			$this->view->paginator = $paginator;
    		
#    		$this->view->error = "No package specified." ;
    	}
    	else{
    		$package = $request->getPost('package');
    		if( ! $package){
        		$this->view->error = "No package specified." ;
        	}
        	else{
    			$search = new Application_Model_Pkgsearch($package);
        		$result = $search->fetchAll();
        		if( ! $result){
        			$this->view->error = "No package found related with '{$package}'.";
        		}
        		else{
					$paginator = Zend_Paginator::factory($result);
					$paginator->setCurrentPageNumber(1);
					echo "PPPPPP";##############################################
					echo $this->_getParam('page') ;##############################
					echo "QQQQQQ";##############################################
					$this->view->paginator = $paginator;
        		}
        	}
    	}
    }

}

