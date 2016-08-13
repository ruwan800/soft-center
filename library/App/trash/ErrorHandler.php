<?php

class App_ErrorHandler extends Zend_Controller_Plugin_Abstract
{
	protected $dispatchedOnce = False;

	public function postDispatch(Zend_Controller_Request_Abstract $request){

#		$this->gotError = new Zend_Acl();

		$response = $this->getResponse();
		if ($response->isException()){
			$exceptions = $response->getException();
			#echo "PPPPPPPPPPPPPPPPPPPPP";########################################
			#print_r($exceptions);#############################################
			echo "####################################################".$this->dispatchedOnce."@@@@@@@@@@@@@@@@";
			if( ! $this->dispatchedOnce){
				echo "asdfdsafdsafdsfs";
				$request->setDispatched(False);
				$request->setControllerName('voserror');
				$request->setActionName('index');
				$this->dispatchedOnce = True;
				
			}
			
			$error            = new ArrayObject(array(), ArrayObject::ARRAY_AS_PROPS);
			$exceptions       = $response->getException();
			$exception        = $exceptions[0];
			$exceptionType    = get_class($exception);
			$error->exception = $exception;
#			$this->setResponse("");
			#$plugin = new Zend_Controller_Plugin_ErrorHandler();
			#$plugin ->setErrorHandlerModule('mystuff')
       		#		->setErrorHandlerController('static');
			
		}

#		$front = Zend_Controller_Front::getInstance();
#		$front->returnResponse(true);
#		$response = $front->dispatch();
		
#		if ($response->isException()) {
#			$request->setDispatched(False);
#			$request->setControllerName('voserror');
#			$request->setActionName('index');
#			}
			#$exceptions = $response->getException();
			// handle exceptions ...
#		} else {
			#$response->sendHeaders();
			#$response->outputBody();
#		}



#		$getError = new App_GetError();
#		$error = $getError->_error;
#		$handler =  new Zend_Controller_Plugin_ErrorHandler();
#		$handler->setErrorHandlerController('voserror')
#				->setErrorHandlerAction('index');
#		$error = Zend_Controller_Action::_getParam('error_handler');
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
