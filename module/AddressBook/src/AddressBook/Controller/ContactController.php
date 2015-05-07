<?php

namespace AddressBook\Controller;

use AddressBook\Form\ContactForm;
use AddressBook\Service\Contact\ContactDoctrineService;
use Zend\Http\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class ContactController extends AbstractActionController
{

//    protected function getContactService() {
//        $service = new \AddressBook\Service\Contact\ContactFakeService();
//
//        return $service;
//    }
//    protected function getContactService()
//    {
////        $factory = new \Zend\Db\Adapter\AdapterServiceFactory();
////        $adapter = $factory->createService($this->getServiceLocator());
//        $adapter = $this->getServiceLocator()->get('Zend\Db\Adapter\Adapter');
//        $tableGateway = new \Zend\Db\TableGateway\TableGateway('contact', $adapter);
//        $service = new \AddressBook\Service\Contact\ContactZendDbService($tableGateway);
//
//        return $service;
//    }
//    /**
//     *
//     * @return AddressBook\Service\Contact\ContactFakeService
//     */
//    protected function getContactService()
//    {
//        $sm = $this->getServiceLocator();
//        $service = $sm->get('AddressBook\Service\ContactZendDb');
//
//        return $service;
//    }
    /**
     *
     * @var Request
     */
    protected $request;

    /**
     *
     * @return ContactDoctrineService
     */
    protected $contactService;

    /**
     *
     * @var ContactForm
     */
    protected $contactForm;

    public function __construct(ContactDoctrineService $contactService, ContactForm $contactForm)
    {
        $this->contactService = $contactService;
        $this->contactForm = $contactForm;
    }

    public function listAction()
    {
//        $service = $this->getContactService();

        $listeContacts = $this->contactService->getAll();

        return new ViewModel(array(
            'contacts' => $listeContacts,
        ));
    }

    public function addAction()
    {
//        $form = new ContactForm();
        $form = $this->contactForm;

        if ($this->request->isPost()) {
            $contact = $this->contactService->insert($form, $this->request->getPost());

            if ($contact) {
                $this->flashMessenger()->addSuccessMessage('Le contact a bien été insérer.');

                return $this->redirect()->toRoute('contact');
            }
        }

        return new ViewModel(array(
            'form' => $form->prepare(),
        ));
    }

    public function showAction()
    {
//        $service = $this->getContactService();

        $id = $this->params('id');

        $contact = $this->contactService->getById($id);

        if (!$contact) {
            return $this->notFoundAction();
        }

        return new ViewModel(array(
            'contact' => $contact,
        ));
    }

    public function modifyAction()
    {
        $id = $this->params('id');
        $form = $this->contactForm;
        $contact = $this->contactService->getById($id, $form);

        if ($this->request->isPost()) {
            $contact = $this->contactService->save($form, $this->request->getPost(), $contact);

            if ($contact) {
                $this->flashMessenger()->addSuccessMessage('Le contanct a bien été updaté.');

                return $this->redirect()->toRoute('contact');
            }
        }

        return new ViewModel(array(
            'form' => $form->prepare(),
        ));
    }

    public function deleteAction()
    {
        $id = $this->params('id');

        $this->contactService->delete($id);

        $this->flashMessenger()->addSuccessMessage('Le contact a bien été supprimé.');

        return $this->redirect()->toRoute('contact');
    }

}
