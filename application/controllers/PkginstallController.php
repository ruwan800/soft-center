<?php

class PkginstallController extends Zend_Controller_Action
{

    public function indexAction()
    {
		$package = $this->_getParam('package', "None");
		$search = new Application_Model_Pkgstatus();
        $pkgStatus = $search->isAllowed($package);
    	if ($pkgStatus){
    		$this->_redirect("apt://{$package}");
    	}
    	$this->view->status = $pkgStatus;
    }


}

