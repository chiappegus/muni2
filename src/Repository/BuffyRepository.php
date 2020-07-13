<?php

namespace App\Repository;

use App\Entity\Buffy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Buffy|null find($id, $lockMode = null, $lockVersion = null)
 * @method Buffy|null findOneBy(array $criteria, array $orderBy = null)
 * @method Buffy[]    findAll()
 * @method Buffy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BuffyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Buffy::class);
    }

    // /**
    //  * @return Buffy[] Returns an array of Buffy objects
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
    public function findOneBySomeField($value): ?Buffy
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
