<?php

class Form_Login extends Zend_Form
{

    public function init()
    {
        $this->setName("login")
            ->setMethod('post');
             
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Username:')
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
                array('HtmlTag', array('tag' => 'p', 'class' => 'type-text'))
        ));

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password:')
                 ->setRequired()
                 ->setAttrib('size', '30')
                 ->addFilter('StringTrim', 'StringToLower')
                 ->addValidator('StringLength', false, array(4, 10));

        $password->class = "text";
        $password->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('Label'),
                array('HtmlTag', array('tag' => 'p', 'class' => 'type-text'))
        ));

        $submit = new Zend_Form_Element_Submit('Login');
        $submit->class = "novisible1";
        $submit->setDecorators(array(
                'ViewHelper',
                'Description',
                'Errors',
                array('HtmlTag', array('tag' => 'p', 'class' => 'last'))
        ));

  /*
        $submit = new Zend_Form_Element_Image('submit', array(
                'ignore' => true,
                'label'  => 'Submit',
                'src'    => '/media/css/image/submit.png'
        ));
*/


        $this->addElements(array(
            $username,
            $password,
            $submit
        ));

        $this->addElement('image', 'submit', array(
                'description' => '<a href="" class="button form_submit"><small class="icon play"></small><span>Login</span></a>',
                'ignore' => true,
                'decorators' => array(
                        array('Description', array('escape'=>false, 'tag'=>'p')),
                ),
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'div')),
            'Form'
        ));

    }


}