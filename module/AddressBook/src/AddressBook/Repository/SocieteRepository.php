<?php

namespace AddressBook\Repository;
 
use Doctrine\ORM\EntityRepository;
 
class SocieteRepository extends EntityRepository
{
    public function getSociete()
    {
        $querybuilder = $this->createQueryBuilder('s');
        return $querybuilder->select('s')
                    ->groupBy('s.nom')
                    ->orderBy('s.id', 'ASC')
                    ->getQuery()->getResult();
    }
}