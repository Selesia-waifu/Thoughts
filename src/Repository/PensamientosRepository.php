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
    public function MostrarPensamientos()
    {
        return $this->getEntityManager()
        ->createQuery('select pensamiento.id,pensamiento.titulo,pensamiento.Contenido,pensamiento.Contadorlikes,pensamiento.fecha_pensamiento,user.nickname,
                      user.email,user.id as userid
                      from App:Pensamientos pensamiento
                      Join pensamiento.Id_user user order by pensamiento.fecha_pensamiento desc')
                      ->getResult();
    }
    public function MostrarMisPensamientos()
    {
        $em = $this->getEntityManager();
        $query =$em
        ->createQuery('select pensamiento.id'

        );
    }
    public function MostrarPensamientosID($id)
    {
        $em = $this->getEntityManager();
        $query=$em
        ->createQuery('select pensamiento.id,pensamiento.titulo,pensamiento.Contenido,pensamiento.Contadorlikes,pensamiento.fecha_pensamiento,user.nickname,
                      user.email
                      from App:Pensamientos pensamiento
                      Join pensamiento.Id_user user where pensamiento.id = :id')
                      ->setParameter('id',$id);
        return $query->getResult();              
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
