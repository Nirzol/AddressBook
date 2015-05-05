<?php

namespace AddressBook\Form;

use Doctrine\ORM\EntityManager;
use Zend\Form\Form;

class ContactForm extends Form
{

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        parent::__construct('contact');

        $this->entityManager = $entityManager;

//        $element = new \Zend\Form\Element\Text('prenom');
//        $element->setLabel('Prénom : ');
//        $this->add($element);     
        $this->add(array(
            'name' => 'prenom',
            'options' => array(
                'label' => 'Prénom : ',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

//        $element = new \Zend\Form\Element\Text('nom');
//        $element->setLabel('Nom : ');
//        $this->add($element);     
        $this->add(array(
            'name' => 'nom',
            'options' => array(
                'label' => 'Nom : ',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

//        $element = new \Zend\Form\Element\Text('email');
//        $element->setLabel('Email : ');
//        $this->add($element);     
//        $this->add(array(
//            'name' => 'email',
//            'options' => array(
//                'label' => 'Email : ',
//            ),
//            'attributes' => array(
//                'type' => 'text'
//            ),
//        ));
        $this->add(array(
            'type' => 'Zend\Form\Element\Email',
            'name' => 'email',
            'options' => array(
                'label' => 'Email : '
            ),
        ));

//        $element = new \Zend\Form\Element\Text('telephone');
//        $element->setLabel('Téléphone : ');
//        $this->add($element);
        $this->add(array(
            'name' => 'telephone',
            'options' => array(
                'label' => 'Téléphone : ',
            ),
            'attributes' => array(
                'type' => 'text'
            ),
        ));

//        $elements = new \DoctrineModule\Form\Element\ObjectSelect('societe');
//        $elements->setLabel('Société : ');
//        $options = array(
//                'object_manager'     => $this->entityManager,
//                'target_class'       => 'AddressBook\Entity\Societe',
//                'property' => 'nom',
//                'is_method' => true,
//                'find_method'        => array(
//                    'name'   => 'getSociete',
//                ),
//            );
//        $elements->setOptions($options);
//        
//        $this->add($elements);

        $this->add(array(
            'type' => '\DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'societe',
            'options' => array(
                'label' => 'Société : ',
                'object_manager' => $this->entityManager,
                'target_class' => 'AddressBook\Entity\Societe',
                'property' => 'nom',
                'is_method' => true,
                'find_method' => array(
                    'name' => 'getSociete',
                ),
            ),
        ));

//        $this->add(array(
//           'name' => 'continent',
//           'type' => 'DoctrineModule\Form\Element\ObjectSelect',
//           'options' => array(
//                'object_manager'     => $this->entityManager,
//                'target_class'       => 'Tutorial\Entity\Countries',
//                'property' => 'continent',
//                'is_method' => true,
//                'find_method'        => array(
//                    'name'   => 'getContinent',
//                ),
//            ), 
//        ));
    }

}
