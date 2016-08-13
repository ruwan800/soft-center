<?php

class App_CustomErrorHandler extends Zend_Controller_Plugin_Abstract
{

	protected $error;
	
	public function __construct($error){
	
		$this->error = $error;
	
	}

	public function getCustomError(){

#		$error->exception->getChainedException()->errorInfo;

		$error = $this->error;
#		$error->getException();
#		return True;

		switch ($error->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                return False;
            default:
                break;
        }

		switch(get_class($error->exception)){
		case 'Zend_Db_Statement_Exception':
			$dbErrorInfo = $error->exception->getChainedException()->errorInfo;
			switch($dbErrorInfo[1]){
				case 1062:
					$message = "Entry already exsists.";
					break;
				case 1048:
					$message = "Atleast one requiered field is empty.";
					break;
				//new Case here for mysql specific;
				default:
					switch($dbErrorInfo[0]){
						case 23000:
							$message = "Unknown error with data you've provided.";
							break;
						//new Case here for commn sql;
						default:
							return False;
					}
					break;
			}
			break;
		case 'App_Exception':
			$message = $error->exception->getMessage();
			break;
		//new Case here for non database errors;
		default:
			return False;
		}
		$text = "An error occured. ";
		isset($dbErrorInfo) ? $erroInfo['exception'] = $dbErrorInfo : $erroInfo['exception'] = Null;
		isset($message) ? $erroInfo['message'] = $text.$message : $erroInfo['message'] = $text;
		return $erroInfo;



	}
}
