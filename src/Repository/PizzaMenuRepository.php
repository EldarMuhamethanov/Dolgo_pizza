<?php

namespace App\Repository;

use App\Entity\PizzaMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PizzaMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method PizzaMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method PizzaMenu[]    findAll()
 * @method PizzaMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PizzaMenuRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PizzaMenu::class);
    }

    // /**
    //  * @return PizzaMenu[] Returns an array of PizzaMenu objects
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
    public function findOneBySomeField($value): ?PizzaMenu
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
