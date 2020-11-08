<?php

namespace App\Entity;

use App\Repository\MeterPointPartnerRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne;

/**
 * @ORM\Entity(repositoryClass=MeterPointPartnerRepository::class)
 */
class MeterPointPartner
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ManyToOne(targetEntity="Broker", inversedBy="partner_id")
     */
    private $partner;

    /**
     * @ManyToOne(targetEntity="MeterPoint", inversedBy="meter_point_id")
     */
    private $meter_point;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartner(): Broker
    {
        return $this->partner;
    }

    public function setPartner(Broker $partner): self
    {
        $this->partner = $partner;

        return $this;
    }

    public function getMeterPoint(): ?MeterPoint
    {
        return $this->meter_point;
    }

    public function setMeterPoint(MeterPoint $meter_point): self
    {
        $this->meter_point = $meter_point;

        return $this;
    }
}
