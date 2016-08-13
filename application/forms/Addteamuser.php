<?php

class Application_Form_Addteamuser extends Zend_Form
{

    public function init()
    {
		$this->setName("searchusr")
			 ->setAction('/addteamuser/form')
			 ->setMethod('post');

		$searchtxt = new Zend_Form_Element_Text('searchtxt');
		$searchtxt->setLabel('Enter text to search a User:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(1, 10));

		$searchtxt->class = "text";        
		$searchtxt->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));

		$submit = new Zend_Form_Element_Submit('searchusr');
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

		$this->addElement('image', 'searchusr', array(
				'description' => '<a href="" class="button form_submit"><small class="icon play"></small><span>Search User</span></a>',
				'ignore' => true,
				'decorators' => array(
				        array('Description', array('escape'=>false, 'tag'=>'p')),
				),
		));
    }
}

