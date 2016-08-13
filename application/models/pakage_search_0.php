<?php
require_once("../controller/includes/includes.php");
require_once("includes/mysql.php");



if(validUser()){
	$searchInput = new getInput;
	$searchInput->nameGET="pkg";
	$input=$searchInput->handleInput();
	
		$result = pkgSearch($input)
			db_connect()
			get results
			class:showResult($result)
}





class pkgSearchViewResult extends viewResult{

	public static function editResult(){
	
		#TODO save final result as $obj
		
	}

}



class getInput{

	public $nameGET="value";

	public function handleInput(){
		if(!isset $_GET[$this->nameGET]){
			if(DEVELOPMENT){
				return "dev";
			}
			else{
				notify(error)
			}
		}
		else{
			$input=$_GET[$this->nameGET];
			#TODO filter value
			return $input;
		}
	}
}










class viewResult{

	public static $obj;

	public static function goHTML(){
	
		
	
	}
	
	public static function goXML(){ 
	
	
		
	}
	
	public static function showResult($in){
		static::$obj=$in;
		if(!results)
			notify(error)
		else
			static::editResult()
			if(plainHTML)
				static::goHTML()
			else
				static::goXML()
	}
	
	public static function editResult(){
	
		notify("editResult child function not implemented")
		
	}
	
}


#check user's validity
function validUsr(task){

	$status=true;
	if (!isset($_SESSION['user'])) {	#check for valid user
		$status=false;
		login();
	}
	if (!recentUsr()){					#deny if timedout
		$status=false;
		login();
	}
	if (!validToDo(task)){				#deny if not allowed to do the task
		$status=false;
		notify("You are not allowed to do that task");
	}	
	return status;						#return true or false
}

#check user's validity to do the task
function validToDo(task){
	status=true;
	#TODO check validity for the task
	return status;
}


#login valid user if yet not logged in else do the rest
function login(){

	if (!isset($_SESSION)){
		session_start();
		$_SESSION['last_request']="site";
		$_SESSION['time']=#curtime#;
		$_SESSION['login_attempt']=0;
		showLogin();
		
	}
	else{
		if($_SESSION['login_attempt']>5){
			if(!time_passed){
				notify("sorry, wait few minutes before try again");
			}
			else{		
				$_SESSION['time']=#curtime#;
				$_SESSION['login_attempt']=0;
				showLogin();
			}
		}
		else{
			showLogin();
		}
	}
}

#show login prompt
function showLogin(){
	$_SESSION['login_attempt']++;
	if(login_success){
		set $_SESSION['user'];
		set $_SESSION['priv'];
		$_SESSION['time']=#curtime#;
		unset $_SESSION['login_attempt'];
		unset $_SESSION['last_request'];
		redirect to tast page or home
	}
	else{
	#TODO show login page
	}

}

#check for timedout users
function recentUsr(){
	status=true;
	#TODO check validity
	if(!valid){
		$status=false;
		unset $_SESSION['user'];
		unset $_SESSION['priv'];
		$_SESSION['time']=#curtime#;
		$_SESSION['login_attempt']=0;
	}
	return status;
}



























$domQ = DOMImplementation::createDocumentType("xml","1.0","UTF-8");


$document = DOMImplementation::createDocument(null, 'xml',$domQ );

$document->formatOutput = true;

function search_error($error){
	
	$error = $document->createElement('error');
	$text = $document->createTextNode($error);
	$error->appendChild($text);
}




    if(isset($_GET["pkg"]))
        $software=$_GET["pkg"];
    else
	$software="anna";		//TODO remove this line
    db_select(SOFT_CENTER);

    $query="SELECT soft_id,package,description FROM software WHERE package LIKE '%$software%' LIMIT 200;";
    $result = mysql_query($query) or die(search_error(mysql_error()));
	
    while($row=mysql_fetch_array( $result )){
    		//echo $row[0]."</br>";###############################################
		$package = $document->createElement('package');
		$name = $document->createElement('name');
		$description = $document->createElement('description');
		$soft_id = $document->createElement('soft_id');
		$nameText = $document->createTextNode($row[1]);
		$descriptionText = $document->createTextNode($row[2]);
		$soft_idText = $document->createTextNode($row[0]);
		$package->appendChild($name);
		$package->appendChild($description);
		$package->appendChild($soft_id);
		$name->appendChild($nameText);
		$description->appendChild($descriptionText);
		$soft_id->appendChild($soft_idText);
    }
if(!$document){
/*
	$error = $document->createElement('error');
	$text = $document->createTextNode("Nothing found related with \"".$software."\".");
	$error->appendChild($text);
*/
	echo "errr";
}
else{
	echo $document->saveXML();
	echo "none";
}

?>
