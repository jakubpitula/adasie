<?php

namespace App\Repository;

use App\Entity\Teacher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Teacher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teacher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teacher[]    findAll()
 * @method Teacher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeacherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teacher::class);
    }
    

    /**
     * @return Teacher[] Returns an array of Teacher objects
     */
    
    public function findByName($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.name = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAllBut($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.name != :val')
            ->setParameter('val', $value)
            ->orderBy('t.name', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findAll()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
    

    /*
    public function findOneBySomeField($value): ?Teacher
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
