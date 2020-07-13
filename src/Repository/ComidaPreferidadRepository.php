<?php

namespace App\Repository;

use App\Entity\ComidaPreferidad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method ComidaPreferidad|null find($id, $lockMode = null, $lockVersion = null)
 * @method ComidaPreferidad|null findOneBy(array $criteria, array $orderBy = null)
 * @method ComidaPreferidad[]    findAll()
 * @method ComidaPreferidad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComidaPreferidadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ComidaPreferidad::class);
    }

    // /**
    //  * @return ComidaPreferidad[] Returns an array of ComidaPreferidad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ComidaPreferidad
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
