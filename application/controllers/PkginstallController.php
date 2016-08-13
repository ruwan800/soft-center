<?php

class PkginstallController extends Zend_Controller_Action
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
    	if ($pkgStatus){
    		$this->_redirect("apt://{$package}");
    	}
    	$this->view->status = $pkgStatus;
    }


}

