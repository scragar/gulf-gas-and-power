<?php

namespace App\Entity;

use App\Repository\MeterPointRepository;
use Doctrine\Common\Collections\Selectable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;

/**
 * @ORM\Entity(repositoryClass=MeterPointRepository::class)
 */
class MeterPoint
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $meterpoint;

    /**
     * @ORM\Column(type="integer")
     */
    private $consumption;

    /**
     * @ORM\Column(type="integer")
     */
    private $uplift;

    /** @OneToMany(targetEntity="MeterPointPartner", mappedBy="meter_point", fetch="EXTRA_LAZY") */
    private $meterPointPartners;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMeterpoint(): ?string
    {
        return $this->meterpoint;
    }

    public function setMeterpoint(string $meterpoint): self
    {
        $this->meterpoint = $meterpoint;

        return $this;
    }

    public function getConsumption(): ?int
    {
        return $this->consumption;
    }

    public function setConsumption(int $consumption): self
    {
        $this->consumption = $consumption;

        return $this;
    }

    public function getUplift(): ?int
    {
        return $this->uplift;
    }

    public function setUplift(int $uplift): self
    {
        $this->uplift = $uplift;

        return $this;
    }

    public function getMeterPointPartners(): Selectable
    {
        return $this->meterPointPartners;
    }
}
