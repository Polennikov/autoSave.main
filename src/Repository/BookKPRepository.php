<?php

namespace App\Repository;

use App\Entity\BookKP;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookKP|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookKP|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookKP[]    findAll()
 * @method BookKP[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookKPRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookKP::class);
    }

    // /**
    //  * @return BookKP[] Returns an array of BookKP objects
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
    public function findOneBySomeField($value): ?BookKP
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
