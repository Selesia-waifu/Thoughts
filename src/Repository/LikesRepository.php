<?php

namespace App\Repository;

use App\Entity\Likes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Likes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Likes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Likes[]    findAll()
 * @method Likes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LikesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Likes::class);
    }
    public function Quitarlike($id)
    {
     $em = $this->getEntityManager();
     $result = $em->createQuery('
     Delete from App:Likes lik where lik.id=:id
     ')->setParameter('id',$id);
     
    }
    public function Obtenerid($idpensamiento,$iduser)
    {
      $em = $this->getEntityManager();
      $result = $em->createQuery('select lik.id from App:Likes lik where lik.id_user = :iduser and 
      lik.id_publicacion=:idpensamiento
      ')->setParameter('iduser',$iduser)->setParameter('idpensamiento',$idpensamiento);
      return $result->getSingleScalarResult();
    }
    public function Getlikes($id)
    {
        $em = $this->getEntityManager();
        $result=$em->createQuery('select count(lik.id) from App:Likes lik where 
        lik.id_publicacion = :id'
        )->setParameter('id',$id);
        return $result->getSingleScalarResult();
    }
    public function Comprobarlike($id)
    {
        $em=$this->getEntityManager();
        $likes=$em->createQuery('select IDENTITY(lik.id_publicacion) as lies from App:Likes lik
        where lik.id_user =:id')
        ->setParameter('id',$id);
        return $likes->getResult();
    }

    // /**
    //  * @return Likes[] Returns an array of Likes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Likes
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
