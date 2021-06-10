<?php

namespace App\Repository;

use App\Entity\BookTB;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookTB|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookTB|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookTB[]    findAll()
 * @method BookTB[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookTBRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookTB::class);
    }

    // /**
    //  * @return BookTB[] Returns an array of BookTB objects
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
    public function findOneBySomeField($value): ?BookTB
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
