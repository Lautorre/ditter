<?php

namespace App\Repository;

use App\Entity\Deet;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Deet|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deet|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deet[]    findAll()
 * @method Deet[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeetRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Deet::class);
    }

    // /**
    //  * @return Deet[] Returns an array of Deet objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Deet
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
