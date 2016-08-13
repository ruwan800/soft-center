<?php

class Application_Form_Request extends Zend_Form
{

    public function init()
    {

		$this->setName("request")
			 ->setMethod('post');

		$softname = new Zend_Form_Element_Text('softname');
		$softname->setLabel('Software name:')
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


		$usage = new Zend_Form_Element_Select('usage');
		$usage->setLabel('Request software for :')
				->addMultiOption('one', 'An Individual')
				->addMultiOption('group', 'A Group')
				->addMultiOption('catagory', 'Catagory')
				->addMultiOption('company', 'Company');

		$usage->class = "text";        
		$usage->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));
		
		$password = new Zend_Form_Element_Password('password','password');
        $password->setLabel('Password:')
                ->setAttrib('size', 25)
                ->addValidator('StringLength', false,array(3,50))
                ->setRequired(true)
                ->setValue('')
                ->setIgnore(false);
                
        $confirmPswd = new Zend_Form_Element_Password('vpassword', 'verifypassword');
         $confirmPswd->setLabel('CPassword:')
         		->setAttrib('size', 25)
                ->addValidator('StringLength', false,array(3,50))
                ->setRequired(true)
                ->setValue('')
                ->setIgnore(false);
        $confirmPswd->addValidator('Identical', false, array('token' => 'pswd'));

 

		
		
		$prio = new Zend_Form_Element_Radio('prio');
        $prio->setLabel(' Priority Level :')
             
              ->setSeparator('')
              ->setMultiOptions(array('24Hours' => '24Hours' , 'Week' => 'Week','Month' => 'Month' ))
              ->addErrorMessage('')
              ->addValidator('NotEmpty');
        $prio->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'dd' , 'style' => 'float: left'))
		));

              
        $remarks = new Zend_Form_Element_Textarea('remarks');
		$remarks->setLabel('Remarks :')
				 ->setAttrib('rows=10 cols=35', '30')
				 ->addFilters(array('StringTrim', 'StringToLower'))
				 ->addValidator('StringLength', false, array(4, 70));

		$remarks->class = "text";        
		$remarks->setDecorators(array(
				'ViewHelper',
				'Description',
				'Errors',
				array('Label'),
				array('HtmlTag', array('tag' => 'p'))
		));
              
        $updates = new Zend_Form_Element_Select('updates');
		$updates->setLabel('Allow Updates For a :')
				->addMultiOption('Week', 'Week')
				->addMultiOption('Month', 'Month')
				->addMultiOption('Half Year', 'Half Year')
				->addMultiOption('Year', 'Year');

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
				
				$softname,
				$username,
				$usage,
				$password,
				$confirmPswd,
				$prio,
				$remarks,
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



