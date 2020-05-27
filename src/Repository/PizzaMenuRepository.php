<?php

namespace App\Repository;

use App\Entity\PizzaMenu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @method PizzaMenu|null find($id, $lockMode = null, $lockVersion = null)
 * @method PizzaMenu|null findOneBy(array $criteria, array $orderBy = null)
 * @method PizzaMenu[]    findAll()
 * @method PizzaMenu[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PizzaMenuRepository extends ServiceEntityRepository
{
    private $entityManager;
    private $entityRepository;
    public function __construct(EntityManagerInterface $entityManager, ManagerRegistry $registry)
    {
        parent::__construct($registry, PizzaMenu::class);
        $this->entityManager = $entityManager;
    }

    public function getAll()
    {
        $this->entityRepository = $this->entityManager->getRepository(PizzaMenu::class);
        return $this->entityRepository->findAll();
    }

    public function findById(string $id)
    {
        $this->entityRepository = $this->entityManager->getRepository(PizzaMenu::class);
        return $this->entityRepository->find($id);
    }
    public function update()
    {
        $this->entityManager->flush();
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
