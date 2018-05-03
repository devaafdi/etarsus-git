<?php

namespace App\Repository;

use App\Entity\ProjectName;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ProjectName|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProjectName|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProjectName[]    findAll()
 * @method ProjectName[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjectNameRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ProjectName::class);
    }

//    /**
//     * @return ProjectName[] Returns an array of ProjectName objects
//     */
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
    public function findOneBySomeField($value): ?ProjectName
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
