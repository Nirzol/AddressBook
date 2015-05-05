<?php

namespace AddressBook\Factory\Service;

use AddressBook\Service\Contact\ContactDoctrineService;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ContactDoctrineORMServiceFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var $serviceLocator ObjectManager */
        $om   = $serviceLocator->get('Doctrine\ORM\EntityManager');
        
        $contact = new \AddressBook\Entity\Contact();
        
        $hydrator = new \DoctrineModule\Stdlib\Hydrator\DoctrineObject($om);
        
        $contactInputFilter = new \AddressBook\InputFilter\ContactInputFilter();
        
        $service = new ContactDoctrineService($om, $contact, $hydrator, $contactInputFilter);

        return $service;
    }
}

   