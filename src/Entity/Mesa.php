<?php

namespace App\Entity;

use App\Repository\MesaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MesaRepository::class)
 */
class Mesa
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReservaMesa", mappedBy="mesa")
     */
    private $reservaMesa;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getReservaMesa(): ?ReservaMesa
    {
        return $this->reservaMesa;
    }

    /**
     * @param mixed $reservaMesa
     */
    public function setReservaMesa($reservaMesa): void
    {
        $this->reservaMesa = $reservaMesa;
    }


}
