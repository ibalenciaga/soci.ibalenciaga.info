<?php

namespace App\Entity;

use App\Repository\TurnoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TurnoRepository::class)
 */
class Turno
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
    private $turno;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reserva", mappedBy="turno")
     */
    private $reserva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTurno(): ?string
    {
        return $this->turno;
    }

    public function setTurno(string $turno): self
    {
        $this->turno = $turno;

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
