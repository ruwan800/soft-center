<?php

class TestController extends Zend_Controller_Action
{
/*
    public function init()
    {
        $this->view->addHelperPath(
                'ZendX/JQuery/View/Helper'
                ,'ZendX_JQuery_View_Helper');
    }
    public function indexAction()
    {
        $this->view->autocompleteElement = new ZendX_JQuery_Form_Element_AutoComplete('ac');
        $this->view->autocompleteElement->setLabel('Autocomplete');
        $this->view->autocompleteElement->setJQueryParam(
                'source', '/index/city');
    }
    public function cityAction()
    {
        $results = Model_City::search($this->_getParam('term'));
        $this->_helper->json(array_values($results));
    }
 *
 */
    public function init()
    {
        $this->_helper->ajaxContext->addActionContext('index', 'html')
                                   ->initContext();
    }

    public function indexAction()
    {
        $paginator = new Zend_Paginator($this->getModels());
        $paginator->setCurrentPageNumber($this->getRequest()->getParam('page', 1));
        $this->view->paginator = $paginator;
    }

    /**
     * Generate an array of Foo models
     *
     * @return array
     */
    private function getModels()
    {
        $pkgsTable = new Model_DbTable_Packages();
        $select = $pkgsTable->select()->distinct();
	$select->from("vos_packages", array('section','component'));
	$select->where('component = ?', 'main');
        $select->order('section');

        $adapter = new Zend_Paginator_Adapter_DbSelect($select);

        return $adapter;
    }

}

