<?php

namespace AddressBook\InputFilter;

use Zend\InputFilter\InputFilter;

class ContactInputFilter extends InputFilter
{

    public function __construct()
    {
//        $input = new \Zend\InputFilter\Input('prenom');
//        // Trim du prénom
//        $filter = new \Zend\Filter\StringTrim();
//        $input->getFilterChain()->attach($filter);
//        // Striptags du prénom
//        $filter = new \Zend\Filter\StripTags;
//        $input->getFilterChain()->attach($filter);
//        //Max 40 char du prénom
//        $validator = new \Zend\Validator\StringLength();
//        $validator->setMax(40);
//        $input->getValidatorChain()->attach($validator);
//        // Prenom obligatoire
//        $validator = new \Zend\Validator\NotEmpty();
//        $input->getValidatorChain()->attach($validator);
//        $this->add($input);
        $this->add(array(
            'name' => 'prenom',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 40,
                    ),
                ),
                array(
                    'name' => 'NotEmpty',
                ),
            ),
        ));

        /**/
//        $input = new \Zend\InputFilter\Input('nom');
//        // Trim du nom
//        $filter = new \Zend\Filter\StringTrim();
//        $input->getFilterChain()->attach($filter);
//        // Striptags du nom
//        $filter = new \Zend\Filter\StripTags;
//        $input->getFilterChain()->attach($filter);
//        //Max 40 char du nom
//        $validator = new \Zend\Validator\StringLength();
//        $validator->setMax(40);
//        $input->getValidatorChain()->attach($validator);
//        // Nom obligatoire
//        $validator = new \Zend\Validator\NotEmpty();
//        $input->getValidatorChain()->attach($validator);
//        $this->add($input);
        $this->add(array(
            'name' => 'nom',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 1,
                        'max' => 40,
                    ),
                ),
                array(
                    'name' => 'NotEmpty',
                ),
            ),
        ));

        /**/
//        $input = new \Zend\InputFilter\Input('email');
//        $input->setRequired(false);
//        // Trim du email
//        $filter = new \Zend\Filter\StringTrim();
//        $input->getFilterChain()->attach($filter);
//        // Striptags du email
//        $filter = new \Zend\Filter\StripTags;
//        $input->getFilterChain()->attach($filter);
//        //Max 80 char du email
//        $validator = new \Zend\Validator\StringLength();
//        $validator->setMax(80);
//        $input->getValidatorChain()->attach($validator);
//        // email non obligatoire
//        $validator = new \Zend\Validator\EmailAddress();
//        $input->getValidatorChain()->attach($validator);
//        $this->add($input);
        $this->add(array(
            'name' => 'email',
            'required' => false,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 8,
                        'max' => 80,
                    ),
                ),
                array(
                    'name' => 'EmailAddress',
                ),
            ),
        ));

        /**/
//        $input = new \Zend\InputFilter\Input('telephone');
//        $input->setRequired(false);
//        // Trim du telephone
//        $filter = new \Zend\Filter\StringTrim();
//        $input->getFilterChain()->attach($filter);
//        // Striptags du telephone
//        $filter = new \Zend\Filter\StripTags;
//        $input->getFilterChain()->attach($filter);
//        //Max 40 char du telephone
//        $validator = new \Zend\Validator\StringLength();
//        $validator->setMax(40);
//        $input->getValidatorChain()->attach($validator);
//        $this->add($input);
        $this->add(array(
            'name' => 'telephone',
            'required' => false,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min' => 10,
                        'max' => 40,
                    ),
                ),
                array(
                    'name' => 'NotEmpty',
                ),
            ),
        ));
    }

}
