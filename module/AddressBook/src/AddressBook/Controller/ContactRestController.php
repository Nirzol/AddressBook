<?php

namespace AddressBook\Controller;

use AddressBook\Form\ContactForm;
use AddressBook\Service\Contact\ContactDoctrineService;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ContactRestController extends AbstractRestfulController
{

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

    /**
     *
     * @var DoctrineObject
     */
    protected $hydrator;

    public function __construct(ContactDoctrineService $contactService, ContactForm $contactForm, DoctrineObject $hydrator)
    {
        $this->contactService = $contactService;
        $this->contactForm = $contactForm;
        $this->hydrator = $hydrator;
    }

    public function getList()
    {
        $results = $this->contactService->getAll();
//        var_dump($results);
        $data = array();
        foreach ($results as $result) {
//            $resultArray = $this->hydrator->extract($result);
//            foreach ($resultArray as $key => $value) {
//                if (is_object($value)) {
//                    $resultArray[$key] = $this->hydrator->extract($value);
//                }
//            }
//            var_dump($result->toArray($this->hydrator));
            $data[] = $result->toArray($this->hydrator);
        }

        return new JsonModel(array(
            'data' => $data)
        );
    }

    public function get($id)
    {
        $result = $this->contactService->getById($id);

        $data[] = $result->toArray($this->hydrator);

        return new JsonModel(array(
            'data' => $data)
        );
    }

    public function create($data)
    {
        $form = $this->contactForm;

        if ($data) {
            $contact = $this->contactService->insert($form, $data);

            if ($contact) {
                $this->flashMessenger()->addSuccessMessage('Le contact a bien été insérer.');

                return new JsonModel(array(
                    'data' => $contact->getId(),
                    'success' => true,
                    'flashMessages' => array(
                        'success' => 'Le contact a bien été insérer.',
                    ),
                ));

//                return $this->redirect()->toRoute('contact');
            }
        }
//        var_dump($contact);
        return new JsonModel(array(
//            'data' => $contact->getId(),
            'success' => false,
            'flashMessages' => array(
                'error' => 'Le contact n\'a pas été insérer.',
            ),
        ));
    }

    public function update($id, $data)
    {
        $contact = $this->contactService->getById($id, $this->contactForm);

        if ($data) {
            $contact = $this->contactService->save($this->contactForm, $data, $contact);

            if ($contact) {
                $this->flashMessenger()->addSuccessMessage('Le contact a bien été updater.');

                return new JsonModel(array(
                    'data' => $contact->getId(),
                    'success' => true,
                    'flashMessages' => array(
                        'success' => 'Le contact a bien été updater.',
                    ),
                ));
            }
        }

        return new JsonModel(array(
            'data' => $contact,
            'success' => false,
            'flashMessages' => array(
                'error' => 'Le contact n\'a pas été updater.',
            ),
        ));
    }

    public function delete($id)
    {
        $this->contactService->delete($id);

        $this->flashMessenger()->addSuccessMessage('Le contact a bien été supprimé.');

        return new JsonModel(array(
            'data' => 'deleted',
            'success' => true,
            'flashMessages' => array(
                'error' => 'Le contact a bien été supprimé.',
            ),
        ));
    }

}
