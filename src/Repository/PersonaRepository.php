<?php

namespace App\Repository;

use App\Entity\Persona;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Persona|null find($id, $lockMode = null, $lockVersion = null)
 * @method Persona|null findOneBy(array $criteria, array $orderBy = null)
 * @method Persona[]    findAll()
 * @method Persona[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Persona::class);
    }

    // /**
    //  * @return Persona[] Returns an array of Persona objects
    //  */
    /*
    public function findByExampleField($value)
    {
    return $this->createQueryBuilder('p')
    ->andWhere('p.exampleField = :val')
    ->setParameter('val', $value)
    ->orderBy('p.id', 'ASC')
    ->setMaxResults(10)
    ->getQuery()
    ->getResult()
    ;
    }
     */

    /*
    public function findOneBySomeField($value): ?Persona
    {
    return $this->createQueryBuilder('p')
    ->andWhere('p.exampleField = :val')
    ->setParameter('val', $value)
    ->getQuery()
    ->getOneOrNullResult()
    ;
    }
     */

    /**
     * @param null|string $value
     * @return Persona[] Returns an array of Persona objects
     */

    public function findByDni( ? string $value)
    {
        /*=================================
        =            con inner            =
        =================================*/

        /*el tema aca es que trae toda la info
        con el inner y si no es intendente o no esta cargado no trae nada

        /*=====  End of con inner  ======*/

        return $this->createQueryBuilder('p')
            ->innerJoin('p.intendente', 'a')
        //->addSelect('a')
            ->andWhere('p.dni like :val')
            ->setParameter('val', '%' . $value . '%')
            ->orderBy('p.id', 'ASC')
        //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param null|string $value
     * @return Persona[] Returns an array of Persona objects
     */

    public function findByDniINNER( ? string $value)
    {
        /*=================================
        =            con inner            =
        =================================*/

        /*el tema aca es que trae toda la info
        con el inner y si no es intendente o no esta cargado no trae nada

        /*=====  End of con inner  ======*/

        return $this->createQueryBuilder('p')
            ->innerJoin('p.intendente', 'a')
        //->addSelect('a')
            ->andWhere('p.dni like :val OR p.nombre like :val OR a.estado like :val')
            ->setParameter('val', '%' . $value . '%')
            ->orderBy('p.id', 'ASC')
        //->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * @param null|string $value
     */

    public function getwithQueryBuilder( ? string $value) : QueryBuilder
    {
        /*=================================
        =            con con left se soliciona            =
        =================================*/

        /*el tema aca es que trae toda la info
        con el left  y si no es intendente o no esta cargado  trae todo

        /*=====  End of con con left se soliciona    ======*/

        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.intendente', 'a')
            ->addSelect('a');
        if ($value) {
            $qb->andWhere('p.dni like :val OR p.nombre like :val OR a.estado like :val')
                ->setParameter('val', '%' . $value . '%');

        }

        return $qb
            ->orderBy('p.id', 'ASC');
        # es increible como baja el tiempo

        //->setMaxResults(10)
        //   ->getQuery()
        //  ->getResult()

    }

    /**
     * @param null|string $value
     * @return Persona[] Returns an array of Persona objects
     */

    public function papillo()
    {
        /*=================================
        =            con inner            =
        =================================*/

        /*el tema aca es que trae toda la info
        con el inner y si no es intendente o no esta cargado no trae nada

        /*=====  End of con inner  ======*/

        return $this->createQueryBuilder('a')

            ->leftJoin('a.relation_id', 'fc')
            ->addSelect('fc')

            ->getQuery()
            ->execute();

    }

}
