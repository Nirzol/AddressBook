<?php

namespace AddressBook\Factory\Controller;

use AddressBook\Controller\ContactController;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $serviceLocator ControllerManager */
        $sm   = $serviceLocator->getServiceLocator();
        $contactService = $sm->get('AddressBook\Service\Contact');
        
        $contactForm    = $sm->get('FormElementManager')->get('AddressBook\Form\ContactForm');
        
        $controller = new ContactController($contactService, $contactForm);

        return $controller;
    }
}

