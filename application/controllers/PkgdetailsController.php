<?php

class PkgdetailsController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    
		$package = $this->_getParam('package', "None");
		$Pkgauth = $this->_helper->Pkgauth;
        $pkgStatus = $Pkgauth->auth($package);
        $detail = new Application_Model_Pkgdetails($package);
    	$result = $detail->getDetail();
    	$this->view->result = $result;
    	
    	
    	$this->view->status = $pkgStatus;
    }


}

