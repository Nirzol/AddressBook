<?php

namespace AddressBookTest\Entity;

class ContactTest extends \PHPUnit_Framework_TestCase
{
    protected $contact;

    // Appelée avant chaque test cette classe
    protected function setUp()
    {
        $this->contact = new \AddressBook\Entity\Contact();
    }

    // Va être appelée une fois avant l'exécution des tests
    // de cette classe
    public static function setUpBeforeClass()
    {
        require_once __DIR__ . '/../../../src/AddressBook/Entity/Contact.php';
    }

    // après chaque test de cette classe
    protected function tearDown()
    {

    }

    // à la fin de tous les tests de cette classe
    public static function tearDownAfterClass()
    {

    }

    public function testInitValuesAreNull()
    {
        $this->assertNull($this->contact->getEmail());
        $this->assertNull($this->contact->getId());
        $this->assertNull($this->contact->getNom());
        $this->assertNull($this->contact->getPrenom());
        $this->assertNull($this->contact->getSociete());
        $this->assertNull($this->contact->getTelephone());
    }
}
