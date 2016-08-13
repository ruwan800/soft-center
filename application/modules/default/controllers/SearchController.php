<?php

/**
 * Description of SearchController
 *
 * @author CS
 */
class SearchController extends Zend_Controller_Action
{
    protected $_indexPath = '../application/data/search';

    public function buildindexAction()
    {
        Zend_Search_Lucene_Analysis_Analyzer::setDefault(new Zend_Search_Lucene_Analysis_Analyzer_Common_Utf8Num());

        /**
         * Create index
         */
        $index = new Zend_Search_Lucene($this->_indexPath, true);

        /**
         * Get all users
         */
        $pkgService = new App_Service_pkgService();
        $packages = $pkgService->getAllpkgs();

        /**
         * Create a document for each user and add it to the index
         */
        foreach ($packages as $package ) {
            $doc = new Zend_Search_Lucene_Document();

            /**
             * Fill document with data
             */
            $doc->addField(Zend_Search_Lucene_Field::keyword('package', $package->package, 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::keyword('filename', $package->filename, 'UTF-8'));
            $doc->addField(Zend_Search_Lucene_Field::keyword('repository', $package->repository, 'UTF-8'));


            /**
             * Add document
             */
            $index->addDocument($doc);
        }

        //$index->optimize();
    }

    public function searchAction()
    {
        if ($request->isPost()) {
            $post = $request->getPost();

            /**
             * Open index
             */
            $index = Zend_Search_Lucene::open($this->_indexPath);

            Zend_Search_Lucene_Search_Query_Wildcard::setMinPrefixLength(0);

            $query = 'username:"' . $post['username'] . '" OR city:"' . $post['city'] . '"';

            $this->view->result = $index->find($query);
        } else {
            $this->view->form = new Search_Form();
        }
    }
}