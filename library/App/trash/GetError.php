<?php

class App_GetError
{

	public function __construct(){


#		Zend_Controller_Response_Abstract()
#		$c = $this->getResponse();
#		$e = $c->getException ();
#		print_r( $e);
#		echo $c."sdssfdsfdsfdsf";
		$error = $this->_getParam('error_handler');
		print_r($error)
#		$this->error = $c->_getParam('error_handler');
/*
		$errorNs = new Zend_Session_Namespace('error');
#		echo $request->getControllerName ()." ERT<br/>";
		if($errorNs->genError){
			$request->setDispatched(False);
			$request->setControllerName('voserror');
			$request->setActionName('dberror');
		}
#		return $this->_forward('another');
		echo "geterror<br/>";
#		print_r($errorNs->genError);########################################
		Zend_Session::namespaceUnset('error');
#		throw new Exception("hello");
#		die("hello");
*/
	}
}
