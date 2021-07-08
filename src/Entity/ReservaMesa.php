<?php

namespace App\Entity;

use App\Repository\ReservaMesaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservaMesaRepository::class)
 */
class ReservaMesa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reserva", inversedBy="reservaMesa", fetch="EAGER")
     */
    private $reserva;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Mesa", inversedBy="reservaMesa", fetch="EAGER")
     */
    private $mesa;

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return mixed
     */
    public function getMesa(): ?Mesa
    {
        return $this->mesa;
    }

    /**
     * @param mixed $mesa
     */
    public function setMesa($mesa): void
    {
        $this->mesa = $mesa;
    }
}