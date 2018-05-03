<?php

namespace App\Repository;

use App\Entity\BudgetCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BudgetCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method BudgetCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method BudgetCode[]    findAll()
 * @method BudgetCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BudgetCodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BudgetCode::class);
    }

//    /**
//     * @return BudgetCode[] Returns an array of BudgetCode objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BudgetCode
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
