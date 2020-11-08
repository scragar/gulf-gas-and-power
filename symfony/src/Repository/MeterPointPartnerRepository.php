<?php

namespace App\Repository;

use App\Entity\MeterPointPartner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MeterPointPartner|null find($id, $lockMode = null, $lockVersion = null)
 * @method MeterPointPartner|null findOneBy(array $criteria, array $orderBy = null)
 * @method MeterPointPartner[]    findAll()
 * @method MeterPointPartner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MeterPointPartnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MeterPointPartner::class);
    }

    public function findRandom(array $criteria = []): ?MeterPointPartner
    {
        $numEntries = $this->count($criteria);
        $randomEntry = rand(0, $numEntries-1);
        $searchResults = $this->findBy($criteria, ['id' => 'ASC'], 1, $randomEntry);
        if (empty($searchResults)) {
            return null;
        }
        return reset($searchResults);
    }
}
