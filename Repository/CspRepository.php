<?php

namespace Fyher\ClientBundle\Repository;

use Fyher\ClientBundle\Entity\Csp;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Csp|null find($id, $lockMode = null, $lockVersion = null)
 * @method Csp|null findOneBy(array $criteria, array $orderBy = null)
 * @method Csp[]    findAll()
 * @method Csp[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CspRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Csp::class);
    }

//    /**
//     * @return Csp[] Returns an array of Csp objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Csp
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
