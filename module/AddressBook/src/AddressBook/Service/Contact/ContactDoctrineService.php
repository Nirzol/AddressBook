<?php

namespace AddressBook\Service\Contact;

use AddressBook\Entity\Contact;
use AddressBook\InputFilter\ContactInputFilter;
use Doctrine\ORM\EntityManager;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject;
use Zend\Form\Form;

class ContactDoctrineService implements ContactServiceInterface
{
    /**
     *
     * @var EntityManager
     */
    protected $em;

    /**
     *
     * @var Contact
     */
    protected $contact;

    /**
     *
     * @var DoctrineObject
     */
    protected $hydrator;

    /**
     *
     * @var ContactInputFilter
     */
    protected $contactInputFilter;

    public function __construct(EntityManager $em, Contact $contact, DoctrineObject $hydrator, ContactInputFilter $contactInputFilter)
    {
        $this->em = $em;
        $this->contact = $contact;
        $this->hydrator = $hydrator;
        $this->contactInputFilter = $contactInputFilter;
    }

    public function getAll()
    {
//        throw new \Exception('Méthode pas encore implémentée');
        $repo = $this->em->getRepository('AddressBook\Entity\Contact');

        return $repo->findAll();
    }

    public function getAllRest()
    {
        $repo = $this->em->getRepository('AddressBook\Entity\Contact')->createQueryBuilder('Contact');

        return $repo->getQuery()->getArrayResult();
//       return $repo->getQuery()->getResult(\Doctrine\ORM\AbstractQuery::HYDRATE_ARRAY);
    }

    public function getById($id, $form = null)
    {
//        throw new \Exception('Méthode pas encore implémentée');
        $repo = $this->em->getRepository('AddressBook\Entity\Contact');

        $repoFind = $repo->find($id);

        if ($form != null) {
//            $hydrator = new DoctrineObject($this->em);
            $form->setHydrator($this->hydrator);
            $form->bind($repoFind);
        }

        return $repoFind;
    }

    public function getByIdWithSociete($id)
    {
        $dql = "SELECT c, s " .
               "FROM AddressBook\Entity\Contact c " .
               "LEFT JOIN c.societe s " .
               "WHERE c.id = :id";

        return $this->em->createQuery($dql)
                    ->setParameter('id', $id)
                    ->getSingleResult();
    }

    public function insert(Form $form, $dataAssoc)
    {
        $contact = $this->contact;

//        $hydrator = new DoctrineObject($this->em);
        $form->setHydrator($this->hydrator);

        $form->bind($contact);
//        $form->setInputFilter(new ContactInputFilter());
        $form->setInputFilter($this->contactInputFilter);
        $form->setData($dataAssoc);

        if (!$form->isValid()) {
            return null;
        }
        $this->em->persist($contact);
        $this->em->flush();

        return $contact;
    }

    public function save(Form $form, $dataAssoc, Contact $contact = null)
    {
        if (!$contact === null) {
            $contact = $this->contact;
        }

//        $hydrator = new DoctrineObject($this->em);
        $form->setHydrator($this->hydrator);

        $form->bind($contact);
//        $form->setInputFilter(new ContactInputFilter());
        $form->setInputFilter($this->contactInputFilter);
        $form->setData($dataAssoc);

        if (!$form->isValid()) {
            return null;
        }

//        $contact->setNom($dataAssoc['nom']);
//        $contact->setPrenom($dataAssoc['prenom']);

        $this->em->persist($contact);
        $this->em->flush();

        return $contact;
    }

    public function delete($id)
    {
        $this->em->remove($this->getById($id));
        $this->em->flush();
    }
}
