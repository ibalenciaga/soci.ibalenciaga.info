<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservaRepository::class)
 */
class Reserva
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $fecha;

    /**
     * @ORM\Column(type="integer", nullable=false)
     */
    private $comensales;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Socio", inversedBy="reserva", fetch="EAGER")
     */
    private $socio;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Turno", inversedBy="reserva", fetch="EAGER")
     */
    private $turno;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReservaMesa", mappedBy="reserva")
     */
    private $reservaMesa;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\FacturaReserva", mappedBy="reserva")
     */
    private $facturaReserva;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ConsumicionReserva", mappedBy="reserva")
     */
    private $consumicionReserva;

    /**
     * @ORM\Column(type="boolean")
     */
    private $archivado;

    public $mesas = Array();
    public $factura = Array();

    public function __construct()
    {
        $this->archivado = 0;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(\DateTimeInterface $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getComensales(): ?int
    {
        return $this->comensales;
    }

    public function setComensales(int $comensales): self
    {
        $this->comensales = $comensales;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getSocio(): ?Socio
    {
        return $this->socio;
    }

    /**
     * @param mixed $socio
     */
    public function setSocio($socio): void
    {
        $this->socio = $socio;
    }



    /**
     * @return mixed
     */
    public function getTurno(): ?Turno
    {
        return $this->turno;
    }

    /**
     * @param mixed $turno
     */
    public function setTurno($turno): void
    {
        $this->turno = $turno;
    }

    public function getArchivado(): ?bool
    {
        return $this->archivado;
    }

    public function setArchivado(bool $archivado): self
    {
        $this->archivado = $archivado;

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

    /**
     * @return mixed
     */
    public function getFacturaReserva(): ?FacturaReserva
    {
        return $this->facturaReserva;
    }

    /**
     * @param mixed $facturaReserva
     */
    public function setFacturaReserva($facturaReserva): void
    {
        $this->facturaReserva = $facturaReserva;
    }

    /**
     * @return mixed
     */
    public function getConsumicionReserva(): ?ConsumicionReserva
    {
        return $this->consumicionReserva;
    }

    /**
     * @param mixed $consumicionReserva
     */
    public function setConsumicionReserva($consumicionReserva): void
    {
        $this->consumicionReserva = $consumicionReserva;
    }



}
