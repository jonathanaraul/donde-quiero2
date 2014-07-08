<?php

namespace Project\BackBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * FacturacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FacturacionRepository extends EntityRepository
{
    public function findAllOrderedById()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT p FROM ProjectBackBundle:Facturacion p ORDER BY p.id ASC'
            )
            ->getResult();
    }

    public function getAllLength()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT COUNT(u.id) FROM ProjectBackBundle:Facturacion u'
            )
            ->getSingleScalarResult();
    }
}