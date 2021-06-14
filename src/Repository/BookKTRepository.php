<?php

namespace App\Repository;

use App\Entity\BookKT;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookKT|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookKT|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookKT[]    findAll()
 * @method BookKT[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookKTRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookKT::class);
    }

    public function findIndex($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.region = :val')
            ->setParameter('val', $value)
            ->setMaxResults(1)
            ->getQuery()
            ->getResult()
            ;
    }

    // /**
    //  * @return BookKT[] Returns an array of BookKT objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookKT
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
