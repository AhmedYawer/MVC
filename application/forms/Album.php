<?php

class Application_Form_Album extends Zend_Form
{

    public function init ()
    {
        $this->setName('album')->setAction('addalbum');
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        $artist = new Zend_Form_Element_Text('artist');
        $artist->setLabel('Artist')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
        
        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        $submit->setValue('Add Album');// Added this line 
        $this->addElements(array(
                $id,
                $artist,
                $title,
                $submit
        ));
    }
    /*
     * Previously we just used init
     * Now we construct the form, calling parent constructor which 
     * in turn calls init
     * We do this to allow us to set an option to change 
     * the text on the button from add to update
     * 
     */
    public function __construct($boolUpdate=false) {
        
        parent::__construct();
        if ($boolUpdate) {
            $e = $this->getElement('submit')->setValue('Update Album');
            $this->setAction('/updatealbum');
        }
        
         
        
    }
}