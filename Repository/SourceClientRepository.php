<?php

namespace Fyher\ClientBundle\Repository;

use Fyher\ClientBundle\Entity\SourceClient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SourceClient|null find($id, $lockMode = null, $lockVersion = null)
 * @method SourceClient|null findOneBy(array $criteria, array $orderBy = null)
 * @method SourceClient[]    findAll()
 * @method SourceClient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SourceClientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SourceClient::class);
    }

//    /**
//     * @return SourceClient[] Returns an array of SourceClient objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SourceClient
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
