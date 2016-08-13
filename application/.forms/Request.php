<?php

class Application_Form_Request extends Zend_Form
{

    public function init()
    {

		$this->setName("request")
			 ->setMethod('post');

		$emid = new Zend_Form_Element_Text('emid');
		$emid->setLabel('Employee ID:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(4, 10));

		$emid->class = "text";        
		$emid->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));


		$username = new Zend_Form_Element_Text('username');
		$username->setLabel('Username:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(4, 70));

		$username->class = "text";        
		$username->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));


		$softname = new Zend_Form_Element_Text('softname');
		$softname->setLabel('Software name:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(0, 70));

		$softname->class = "text";        
		$softname->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));


		$updates = new Zend_Form_Element_Select('updates');
		$updates->setLabel('Allow Updates for a :')
				->addMultiOption('Week', 'week')
				->addMultiOption('Month', 'month')
				->addMultiOption('Half Year', '6months')
				->addMultiOption('Year', 'year');

		$updates->class = "text";        
		$updates->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));

		$submit = new Zend_Form_Element_Submit('Send Request');
		$submit->class = "novisible";
		$submit->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('HtmlTag', array('tag' => 'p'))
		));

		$this->addElements(array(
				$emid,
				$username,
				$softname,
				$updates,
				$submit
			));

		$this->addElement('image', 'Send Request', array(
				'description' => '<a href="" class="button form_submit"><small class="icon play"></small><span>Send Request</span></a>',
				'ignore' => true,
				'decorators' => array(
				        array('Description', array('escape'=>false, 'tag'=>'p')),
				),
		));


    
    }


}
