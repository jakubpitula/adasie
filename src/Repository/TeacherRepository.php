<?php

namespace App\Repository;

use App\Entity\Teacher;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Teacher|null find($id, $lockMode = null, $lockVersion = null)
 * @method Teacher|null findOneBy(array $criteria, array $orderBy = null)
 * @method Teacher[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TeacherRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Teacher::class);
    }

    public function cmp($a, $b){
        $a->getName() != 'brak' ? $aName = $a->getName() : $aName = 'brak  ';
        $b->getName() != 'brak' ? $bName = $b->getName() : $bName = 'brak  ';

        list($firstNameA, $lastNameA) = explode(" ", $aName, 2);
        list($firstNameB, $lastNameB) = explode(" ", $bName, 2);

        return strcmp($lastNameA, $lastNameB);
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
        $teachers = $this->createQueryBuilder('t')
            ->andWhere('t.name != :val')
            ->setParameter('val', $value)
            ->orderBy('t.name', 'ASC')
            ->getQuery()
            ->getResult();

        usort($teachers, array($this, 'cmp'));

        return $teachers;
    }

    public function findAll()
    {
        $teachers = $this->findBy(array(), array('name' => 'ASC'));
        usort($teachers, array($this, 'cmp'));

        return $teachers;
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
