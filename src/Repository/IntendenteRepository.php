<?php

namespace App\Repository;

use App\Entity\Intendente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Intendente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Intendente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Intendente[]    findAll()
 * @method Intendente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IntendenteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Intendente::class);
    }

    // /**
    //  * @return Intendente[] Returns an array of Intendente objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Intendente
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
