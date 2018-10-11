<?php

namespace Fyher\ClientBundle\Repository;

use Fyher\ClientBundle\Entity\TraitementRgpd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TraitementRgpd|null find($id, $lockMode = null, $lockVersion = null)
 * @method TraitementRgpd|null findOneBy(array $criteria, array $orderBy = null)
 * @method TraitementRgpd[]    findAll()
 * @method TraitementRgpd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TraitementRgpdRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TraitementRgpd::class);
    }

//    /**
//     * @return TraitementRgpd[] Returns an array of TraitementRgpd objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TraitementRgpd
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
