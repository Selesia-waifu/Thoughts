<?php

namespace App\Repository;

use App\Entity\Pensamientos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pensamientos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pensamientos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pensamientos[]    findAll()
 * @method Pensamientos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PensamientosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pensamientos::class);
    }

    // /**
    //  * @return Pensamientos[] Returns an array of Pensamientos objects
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
    public function findOneBySomeField($value): ?Pensamientos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
