<?php

class PkgdetailsController extends Zend_Controller_Action
{

    public function indexAction()
    {
    
		$package = $this->_getParam('package', "None");
		$search = new Application_Model_Pkgstatus();
        $pkgStatus = $search->isAllowed($package);
        $detail = new Application_Model_Pkgdetails();
    	$result = $detail->getDetail($package);
    	$this->view->result = $result;
    	
    	$this->view->status = $pkgStatus;
    }


}

