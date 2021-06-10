<?php

namespace App\Repository;

use App\Entity\BookKBM;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookKBM|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookKBM|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookKBM[]    findAll()
 * @method BookKBM[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookKBMRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookKBM::class);
    }

    // /**
    //  * @return BookKBM[] Returns an array of BookKBM objects
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
    public function findOneBySomeField($value): ?BookKBM
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
