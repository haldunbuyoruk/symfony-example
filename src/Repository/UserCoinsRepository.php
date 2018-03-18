<?php

namespace App\Repository;

use App\Entity\UserCoins;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCoins|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCoins|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCoins[]    findAll()
 * @method UserCoins[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCoinsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCoins::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('u')
            ->where('u.something = :value')->setParameter('value', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
