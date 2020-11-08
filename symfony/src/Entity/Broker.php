<?php

namespace App\Entity;

use App\Repository\BrokerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToMany;
use Doctrine\Common\Collections\Selectable;

/**
 * @ORM\Entity(repositoryClass=BrokerRepository::class)
 */
class Broker
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
    private $name;

    /**
     * @OneToMany(targetEntity="MeterPointPartner", mappedBy="partner", fetch="EXTRA_LAZY")
     */
    private $meterPointPartners;

    public function __construct()
    {
        $this->meterPointPartners = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getMeterPointPartners(): Selectable
    {
        return $this->meterPointPartners;
    }

    public function getRandomMeterPointPartner(): ?MeterPointPartner
    {
        return $this->getMeterPointPartners()->get(
            rand(0, $this->getMeterPointPartners()->count() - 1)
        );
    }
}
