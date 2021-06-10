<?php

namespace App\Repository;

use App\Entity\BookKBC;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookKBC|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookKBC|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookKBC[]    findAll()
 * @method BookKBC[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookKBCRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookKBC::class);
    }

    // /**
    //  * @return BookKBC[] Returns an array of BookKBC objects
    //  */

    public function findAge($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.age >= :val')
            ->setParameter('val', $value)
            ->setMaxResults(100)
            ->getQuery()
            ->getResult()
            ;
/*        $connect = $this->getEntityManager()->getConnection();

        $sql = "
            SELECT * FROM BookKBC t
            WHERE t.age > :value
            ";
        $stmt = $connect->prepare($sql);
        $stmt->execute([
            'value' => $value,
        ]);

        return $stmt->fetchAll();*/
    }


    /*
    public function findOneBySomeField($value): ?BookKBC
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
