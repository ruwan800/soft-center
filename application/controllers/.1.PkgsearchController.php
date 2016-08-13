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
#        			Zend_View_Helper_PaginationControl::setDefaultViewPartial('controls.phtml');
					$paginator = Zend_Paginator::factory($result);
#					$page = $request->getPost('page');
#					echo "PPPPPP";##############################################
#					echo $page ;##############################
#					echo "QQQQQQ";##############################################
#					if ($page){
#						$paginator->setCurrentPageNumber($this->_getParam('page', $page));
#					}
#					else{
					$paginator->setCurrentPageNumber($this->_getParam('page', 1));
#					}
					$paginator->setItemCountPerPage(20);
					/*
					echo "PPPPPP";##############################################
					echo $paginator ;##############################
					echo "QQQQQQ";##############################################
					*/
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

}

