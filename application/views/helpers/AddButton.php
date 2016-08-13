<?php

class Zend_View_Helper_AddButton extends Zend_View_Helper_Abstract
{

    public function addButton($type, $back=Null)

    {
		if( $back == 1 or $back == -1 ){
    		$link = "javascript:history.back()";
    	}
    	else if( 0 < $back && $back < 3 ){
    		$link = "javascript:history.go(-{$back})";
    	}
    	else if( -3 < $back && $back < 0 ){
    		$link = "javascript:history.go({$back})";
    	}
    	else{
    		$link = "/".$back;
    	}
    	switch($type){
    		case 'cancel' :
    			$button = "<a href='{$link}' class='button ml'><small class='icon cross'></small><span>Cancel</span></a>";
    			break;
    		case 'ok' :
    			$button = "<a href='{$link}' 
    					class='button ml'><small class='icon check'></small><span>&nbsp;&nbsp;OK&nbsp;&nbsp;</span></a>";
    			break;
    		case 'back' :
    			$back ? Null : $link = "javascript:history.back()";
    			$button="<a href='{$link}' class='button ml'><small class='icon arrow_left'></small><span>Back</span></a>";
    			break;
    		case 'home'	:
    			$button="<a href='/' class='button ml'><small class='icon home'></small><span>Home</span></a>";
    			break;
    		default	:
    			$button="<a href='{$link}' class='button ml'><span>{$type}</span></a>";
    			break;
    	}
		return $button;
		
    }

}
