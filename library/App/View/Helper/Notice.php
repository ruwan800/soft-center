<?php

/**
 * Description of IndexController
 *
 * @author CS
 */

class App_View_Helper_Notice extends Zend_View_Helper_Abstract
{
    // #FFCCEE
    public $startColour = 16764142;
    
    public function notice($message = 'No Message')
    {
        $this->startColour -= 6000;
        
        return "<div style='padding:4px; text-align:center; background:#".dechex($this->startColour).";'>$message</div>";
    }


}

