<?php

class Application_Form_Adduser extends Zend_Form
{

    public function init()
    {
       
		$this->setName("add-user")
			 ->setMethod('post');

		$username = new Zend_Form_Element_Text('username');
		$username->setLabel('User Name:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(4, 10));

		$username->class = "text";        
		$username->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));


		$email = new Zend_Form_Element_Text('email');
		$email->setLabel('User e-mail:')
				 ->setRequired()
				 ->setAttrib('size', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(4, 70));

		$email->class = "text";        
		$email->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));



		$usertype = new Zend_Form_Element_Select('usertype');
		$usertype->setLabel('Priviledges of user :')
				->addMultiOption('level1','level1' )
				->addMultiOption('level2','level2')
				->addMultiOption('level3','level3' )
				->addMultiOption('admin','Administrater');
		$usertype->class = "text";        
		$usertype->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));
		
		
		$jobtype = new Zend_Form_Element_Select('jobtype');
		$jobtype->setLabel('Jobtype of user :')
				->addMultiOption('programer','programer' )
				->addMultiOption('qa','qa')
				->addMultiOption('Manager','Manager' )
				->addMultiOption('admin','Administrater');
		$jobtype->class = "text";        
		$jobtype->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));

		$submit = new Zend_Form_Element_Submit('createteam');
		$submit->class = "novisible";
		$submit->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('HtmlTag', array('tag' => 'p'))
		));

		$this->addElements(array(
				$username,
				$email,
				$usertype,
				$jobtype,
				$submit
			));

		$this->addElement('image', 'createteam', array(
				'description' => '<a href="" class="button form_submit"><small class="icon play"></small><span>Create Team</span></a>',
				'ignore' => true,
				'decorators' => array(
				        array('Description', array('escape'=>false, 'tag'=>'p')),
				),
		));

    }


}

