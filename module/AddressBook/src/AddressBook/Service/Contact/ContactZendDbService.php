<?php

namespace AddressBook\Service\Contact;

use AddressBook\Entity\Contact;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Stdlib\Hydrator\ClassMethods;

class ContactZendDbService implements ContactServiceInterface
{
    protected $tableGateway;
    
    public function __construct(AbstractTableGateway $tableGateway)
    {
        $this->tableGateway = $tableGateway;
    }
    
    public function getAll()
    {
        $listeContactsAssoc = $this->tableGateway->select()->toArray();
        $listeContacts = [];
        
        foreach ($listeContactsAssoc as $contactAssoc) {
            $contact = new Contact();
            
            // Permet de convertir un tableau en objet
            // hydrate tableau -> objet
            // extract objet -> tableau
            $hydrator = new ClassMethods();
            $hydrator->hydrate($contactAssoc, $contact);
            
            $listeContacts[] = $contact;
        }
        
        return $listeContacts;
    }

    public function getById($id)
    {
        $contactAssoc = (array) $this->tableGateway->select(array('id' => $id))->current();

        if (!$contactAssoc) {
            return null;
        }
        
        $contact = new Contact();

        $hydrator = new ClassMethods();
        $hydrator->hydrate($contactAssoc, $contact);
        
        return $contact;
    }
    
    public function getByIdWithSociete($id)
    {
        return $this->getById($id);
    }
 
    public function insert(\Zend\Form\Form $form, array $dataAssoc)
    {
        throw new \Exception('Pas encore implémenté');
    }
}
