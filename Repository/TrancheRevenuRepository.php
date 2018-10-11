<?php

namespace Fyher\ClientBundle\Repository;

use Fyher\ClientBundle\Entity\TrancheRevenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TrancheRevenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method TrancheRevenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method TrancheRevenu[]    findAll()
 * @method TrancheRevenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrancheRevenuRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TrancheRevenu::class);
    }

//    /**
//     * @return TrancheRevenu[] Returns an array of TrancheRevenu objects
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
    public function findOneBySomeField($value): ?TrancheRevenu
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
