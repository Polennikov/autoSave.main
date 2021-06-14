<?php

namespace App\Repository;

use App\Entity\BookKC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookKC|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookKC|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookKC[]    findAll()
 * @method BookKC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookKCRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookKC::class);
    }

    // /**
    //  * @return BookKC[] Returns an array of BookKC objects
    //  */

    public function findIndex($value)
    {
         return $this->createQueryBuilder('b')
            ->andWhere('b.period >= :val')
            ->setParameter('val', $value)
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?BookKC
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
