<?php

namespace BlogBundle\Repository;

/**
 * StudentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StudentRepository extends \Doctrine\ORM\EntityRepository
{
    public function findStudents()
    {
        return $this->createQueryBuilder( 'a' )
            ->select( 'a' )
            ->getQuery()
            ->getResult();
    }
}
