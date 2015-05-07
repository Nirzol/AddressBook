<?php

namespace AddressBook\Factory\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use AddressBook\Form\ContactForm;

class ContactFormFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $services         = $serviceLocator->getServiceLocator();
        $entityManager    = $services->get('Doctrine\ORM\EntityManager');

        $form = new ContactForm($entityManager);

        return $form;
    }
}
