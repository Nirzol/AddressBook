<?php

namespace AddressBook\Factory\Controller;

use AddressBook\Controller\ContactRestController;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Mvc\Controller\ControllerManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactRestControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $serviceLocator ControllerManager */
        $sm   = $serviceLocator->getServiceLocator();
        $contactService = $sm->get('AddressBook\Service\Contact');

        $contactForm    = $sm->get('FormElementManager')->get('AddressBook\Form\ContactForm');

        /* @var $serviceLocator ObjectManager */
        $om   = $sm->get('Doctrine\ORM\EntityManager');
        $hydrator = new DoctrineObject($om);

        $controller = new ContactRestController($contactService, $contactForm, $hydrator);

        return $controller;
    }
}
