<?php

namespace App\Repository;

use App\Entity\TarsusDivision;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TarsusDivision|null find($id, $lockMode = null, $lockVersion = null)
 * @method TarsusDivision|null findOneBy(array $criteria, array $orderBy = null)
 * @method TarsusDivision[]    findAll()
 * @method TarsusDivision[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarsusDivisionRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TarsusDivision::class);
    }

//    /**
//     * @return TarsusDivision[] Returns an array of TarsusDivision objects
//     */
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
    public function findOneBySomeField($value): ?TarsusDivision
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
