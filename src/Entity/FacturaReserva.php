<?php

namespace App\Entity;

use App\Repository\FacturaReservaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FacturaReservaRepository::class)
 */
class FacturaReserva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $importe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reserva", inversedBy="facturaReserva", fetch="EAGER")
     */
    private $reserva;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getImporte(): ?float
    {
        return $this->importe;
    }

    /**
     * @param mixed $importe
     */
    public function setImporte($importe): void
    {
        $this->importe = $importe;
    }

    /**
     * @return mixed
     */
    public function getReserva(): ?Reserva
    {
        return $this->reserva;
    }

    /**
     * @param mixed $reserva
     */
    public function setReserva($reserva): void
    {
        $this->reserva = $reserva;
    }
}
