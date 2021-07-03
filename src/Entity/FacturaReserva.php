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
     * @ORM\Column(type="float")
     */
    private $precio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reserva", inversedBy="reserva", fetch="EAGER")
     */
    private $reserva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrecio(): ?float
    {
        return $this->precio;
    }

    public function setPrecio(float $precio): self
    {
        $this->precio = $precio;

        return $this;
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
