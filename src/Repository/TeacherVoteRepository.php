<?php

namespace App\Repository;

use App\Entity\TeacherVote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TeacherVote|null find($id, $lockMode = null, $lockVersion = null)
 * @method TeacherVote|null findOneBy(array $criteria, array $orderBy = null)
 * @method TeacherVote[]    findAll()
 * @method TeacherVote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeacherVoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TeacherVote::class);
    }

    // /**
    //  * @return TeacherVote[] Returns an array of TeacherVote objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TeacherVote
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
