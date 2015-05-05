<?php

namespace AddressBookTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ContactControllerTest extends AbstractHttpControllerTestCase
{
    protected function setUp()
    {
        $this->setApplicationConfig(require 'config/application.config.php');
    }
    
    public function testListActionIsAccessible()
    {
        $this->dispatch('/contact');
        
//        var_dump($this->getResponse()->getContent());
//        var_dump($this->getApplicationServiceLocator()->get('config'));
        
        $this->assertResponseStatusCode(200);
        $this->assertModuleName('addressbook');
        $this->assertControllerName('addressbook\controller\contact');
        $this->assertActionName('list');
        $this->assertMatchedRouteName('contact');
    }
    
    // Problème : on dépend de la base de données qui risque d'évoluer
    // Il faudrait remplir la base dans le setUp
    public function testShowActionContainsContactWithMysql()
    {
        $this->dispatch('/contact/2');
        
        // On vérifie via un selecteur CSS (attention tous n'existent pas)
        // qu'il y a bien 3 paragraphe dans la réponse
        $this->assertQueryCount('p', 3);
        $this->assertContains('Zinédine', $this->getResponse()->getContent());     
        $this->assertContains('Zidane', $this->getResponse()->getContent());
    }
    
    // Fake : inconvénient de devoir écrire la classe
    public function testShowActionContainsContactWithFake()
    {
        $dataTest = [
            (new \AddressBook\Entity\Contact)->setId('2')
                                             ->setPrenom('Alain')
                                             ->setNom('Delon')
        ];
        $fakeService = new \AddressBook\Service\Contact\ContactFakeService($dataTest);
        
        $this->getApplicationServiceLocator()
             ->setAllowOverride(true)
             ->setService('AddressBook\Service\Contact', $fakeService);
        
        $this->dispatch('/contact/2');
        
        // On vérifie via un selecteur CSS (attention tous n'existent pas)
        // qu'il y a bien 3 paragraphe dans la réponse
//        $this->assertQueryCount('p', 3);
        $this->assertContains('Alain', $this->getResponse()->getContent());     
        $this->assertContains('Delon', $this->getResponse()->getContent());
    }
    
    // Mock : pas besoin d'écrire la classe et permet de savoir
    // combien de fois sont appelées les méthodes
    public function testShowActionContainsContactWithMock()
    {
//        $mockService = $this->getMockBuilder(\AddressBook\Service\Contact\ContactServiceInterface::class)
//                            ->getMock();
        
        $mockService = $this->getMockBuilder(\AddressBook\Service\Contact\ContactDoctrineService::class)
                            ->disableOriginalConstructor()
                            ->getMock();
        
        $mockService->expects($this->once())
                    ->method('getByIdWithSociete')
                    ->willReturn((new \AddressBook\Entity\Contact)
                                             ->setId('2')
                                             ->setPrenom('Barack')
                                             ->setNom('Obama'));
                
        $this->getApplicationServiceLocator()
             ->setAllowOverride(true)
             ->setService('AddressBook\Service\Contact', $mockService);
        
        $this->dispatch('/contact/2');
        
        // On vérifie via un selecteur CSS (attention tous n'existent pas)
        // qu'il y a bien 3 paragraphe dans la réponse
        $this->assertQueryCount('p', 2);
        $this->assertContains('Barack', $this->getResponse()->getContent());     
        $this->assertContains('Obama', $this->getResponse()->getContent());
    }
}
