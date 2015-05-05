<?php

namespace AddressBook\Service\Contact;

use Zend\Form\Form;

interface ContactServiceInterface
{
    public function getAll();
    public function getAllRest();
    public function getById($id, $form = null);
    public function getByIdWithSociete($id);
    public function insert(Form $form, $dataAssoc);
}
