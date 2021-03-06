<?php

namespace Project\BackBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ConfirmacionElementoRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ConfirmacionElementoRepository extends EntityRepository
{
    public function findAllOrderedById()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM ProjectBackBundle:ConfirmacionElemento p ORDER BY p.id DESC'
            )
            ->getResult();
    }

    public function getAllLength()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(u.id) FROM ProjectBackBundle:ConfirmacionElemento u'
            )
            ->getSingleScalarResult();
    }
}
