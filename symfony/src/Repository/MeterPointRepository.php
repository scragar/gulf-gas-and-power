<?php

namespace App\Repository;

use App\Entity\MeterPoint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeterPoint|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeterPoint|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeterPoint[]    findAll()
 * @method MeterPoint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeterPointRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeterPoint::class);
    }
}
