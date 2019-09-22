<?php

namespace App\Repository;

use App\Entity\Minivote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Minivote|null find($id, $lockMode = null, $lockVersion = null)
 * @method Minivote|null findOneBy(array $criteria, array $orderBy = null)
 * @method Minivote[]    findAll()
 * @method Minivote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MinivoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Minivote::class);
    }


    public function findNumberOfMinivotes($teacher, $category)
    {
        $result = $this->createQueryBuilder('v')
            ->andWhere('v.category = :cat')
            ->andWhere('v.teacher = :teach')
            ->setParameter('cat', $category)
            ->setParameter('teach', $teacher)
            ->getQuery()
            ->getResult()
        ;

        return count($result);
    }
    // /**
    //  * @return Minivote[] Returns an array of Minivote objects
    //  */
    
    // public function findByExampleField($value)
    // {
    //     return $this->createQueryBuilder('m')
    //         ->andWhere('m.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->orderBy('m.id', 'ASC')
    //         ->setMaxResults(10)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
    

    /*
    public function findOneBySomeField($value): ?Minivote
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
