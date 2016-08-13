<?php

class Application_Form_Delteampkg extends Zend_Form
{

    public function init()
    {
		$this->setName("searchpkg")
			 ->setMethod('post');

		$searchtxt = new Zend_Form_Element_Text('searchtxt');
		$searchtxt->setLabel('Enter text to search a package:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(3, 10));

		$searchtxt->class = "text";        
		$searchtxt->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));



		$submit = new Zend_Form_Element_Submit('searchpkg');
		$submit->class = "novisible";
		$submit->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('HtmlTag', array('tag' => 'p'))
		));

		$this->addElements(array(
				$searchtxt,
				$submit
			));

		$this->addElement('image', 'searchpkg', array(
				'description' => '<a href="" class="button form_submit"><small class="icon play"></small><span>Search Package</span></a>',
				'ignore' => true,
				'decorators' => array(
				        array('Description', array('escape'=>false, 'tag'=>'p')),
				),
		));
    }


}

