<?php

class Admin_AuthController extends Zend_Controller_Action
{
    /*
     * Stores current session
     *
     * @var Zend_Session_Namespace
     */
    protected $_session;

    public function init()
    {
        $this->_session = new Zend_Session_Namespace('auth');
    }

    public function preDispatch()
    {        
    }

    public function postDispatch()
    {        
    }

    public function indexAction()
    {
        $form = new Form_Login();
        $this->view->form = $form;
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                if ($this->_process($form->getValues())) {
                    // We're authenticated! Redirect to the home page                    
                    $this->_session->authenticatedAsAdmin = true;
                    $this->_helper->redirector('index', 'index');
                }
            }
        }                
    }

    protected function _process($values)
    {
        // Get our authentication adapter and check credentials
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['username']);
        $adapter->setCredential($values['password']);

        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write($user);
            return true;
        }
        return false;
    }

    protected function _getAuthAdapter()
    {
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

        $authAdapter->setTableName('vos_users')
                    ->setIdentityColumn('username')
                    ->setCredentialColumn('password')
                    ->setCredentialTreatment('MD5(?) AND acl = "admin"');

        return $authAdapter;
    }

    public function logoutAction()
    {
        $this->_session->authenticatedAsAdmin = false;
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index'); // back to login page
    }

}



