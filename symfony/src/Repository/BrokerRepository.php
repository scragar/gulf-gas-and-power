<?php

namespace App\Repository;

use App\Entity\Broker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Broker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Broker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Broker[]    findAll()
 * @method Broker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BrokerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Broker::class);
    }

    public function findRandom(array $criteria = []): ?Broker
    {
        $numEntries = $this->count($criteria);
        $randomEntry = rand(0, $numEntries-1);
        $searchResults = $this->findBy($criteria, ['id' => 'ASC'], 1, $randomEntry);
        if (empty($searchResults)) {
            return null;
        }
        return reset($searchResults);
    }

    public function getCommissionWithZeros(string $brokerName, string $meterpoint = null): array
    {
        $rsm = new ResultSetMapping();
        $rsm->addScalarResult('broker_id', 'broker_id', \Doctrine\DBAL\Types\Types::INTEGER);
        $rsm->addScalarResult('commission', 'commission', \Doctrine\DBAL\Types\Types::INTEGER);

        return $this
            ->getEntityManager()
            ->createNativeQuery(<<<SQL
SELECT
    B.id AS broker_id,
    COALESCE(SUM(MP.consumption * MP.uplift)) AS commission
FROM broker AS B
LEFT JOIN meter_point_partner AS MPP
    ON
    MPP.partner_id = B.id
LEFT JOIN meter_point AS MP
    ON
    MP.id = MPP.meter_point_id
    AND
    (
        :meterpoint = ''
        OR 
        MP.meterpoint = :meterpoint
    )
WHERE
    B.name LIKE :broker
GROUP BY
    B.id
SQL,
                $rsm
            )
            ->setParameters([
                ':broker' => $brokerName,
                ':meterpoint' => $meterpoint,
            ])
            ->getArrayResult();
    }

    public function getCommission(string $brokerName, string $meterpoint = null): array
    {
        $query = $this->createQueryBuilder('b')
            ->select([
                'b.id AS broker_id',
                'SUM(mp.consumption * mp.uplift) AS commission',
            ])
            ->innerJoin(
                'b.meterPointPartners',
                'mpp'
            )
            ->innerJoin(
                'mpp.meter_point',
                'mp'
            )
            ->where('b.name LIKE :brokerName')
            ->groupBy('b.id')
            ->setParameter(':brokerName', '%'.$brokerName.'%');

        if (!empty($meterpoint)) {
            $query->andWhere('mp.meterpoint = :meterpoint')
                ->setParameter(':meterpoint', $meterpoint);
        }

        return $query->getQuery()->getArrayResult();
    }
}
