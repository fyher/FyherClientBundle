<?php

namespace Fyher\ClientBundle\Repository;

use Fyher\ClientBundle\Entity\Alarme;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Alarme|null find($id, $lockMode = null, $lockVersion = null)
 * @method Alarme|null findOneBy(array $criteria, array $orderBy = null)
 * @method Alarme[]    findAll()
 * @method Alarme[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlarmeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Alarme::class);
    }


    public function alertedujour(){
        $datejour=new \DateTime();

        return $this->createQueryBuilder('a')
            ->andWhere('a.dateRappelAlarme like :date ')
            ->andWhere('a.luAlarme=0')
            ->setParameter('date', $datejour->format("Y-m-d").'%')
            ->getQuery()
            ->getResult()
            ;

    }

//    /**
//     * @return Alarme[] Returns an array of Alarme objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Alarme
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
