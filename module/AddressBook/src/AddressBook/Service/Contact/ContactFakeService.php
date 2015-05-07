<?php

namespace AddressBook\Service\Contact;

class ContactFakeService implements ContactServiceInterface
{
    protected $listeContacts = array();

    public function __construct(Array $listeContacts = array())
    {
        if (empty($listeContacts)) {
            $contact1 = new \AddressBook\Entity\Contact();
            $contact1->setId(12)
                    ->setPrenom('Thierry')
                    ->setNom('Henry')
                    ->setEmail('titi@henry.com');

            $this->listeContacts[] = $contact1;

            $contact2 = new \AddressBook\Entity\Contact();
            $contact2->setId(4)
                    ->setPrenom('Barack')
                    ->setNom('Obama')
                    ->setTelephone('+1 352 356 3632');

            $this->listeContacts[] = $contact2;

            return;
        }

        $this->listeContacts = $listeContacts;
    }

    public function getAll()
    {
        return $this->listeContacts;
    }

    public function getById($id)
    {
        foreach ($this->listeContacts as $contact) {
            if ($contact->getId() == $id) {
                return $contact;
            }
        }

        return null;
    }
    public function getByIdWithSociete($id)
    {
        return $this->getById($id);
    }

    public function insert(\Zend\Form\Form $form, $dataAssoc)
    {
        throw new \Exception('Pas encore implémenté');
    }

    public function getAllRest()
    {

    }

}
