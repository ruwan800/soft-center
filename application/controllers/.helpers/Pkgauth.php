
<?php
class PkgauthController extends Zend_Controller_Action_Helper_Abstract
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {

    }


    public function barAction()
    {
        // Add two actions to the stack
        // Add call to /foo/baz/bar/baz
        // (FooController::bazAction() with request var bar == baz)
        $this->_helper->actionStack('baz',
                                    'foo',
                                    'default',
                                    array('bar' => 'baz'));
 
        // Add call to /bar/bat
        // (BarController::batAction())
        $this->_helper->actionStack('bat', 'bar');
    }
}

?>
