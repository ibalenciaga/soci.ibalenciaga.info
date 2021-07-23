<?php

namespace App\Entity;

use App\Repository\CuentaCorrienteMovimientosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CuentaCorrienteMovimientosRepository::class)
 */
class CuentaCorrienteMovimientos
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
    private $concepto;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $importe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CuentaCorriente", inversedBy="cuentaCorrienteMovimientos", fetch="EAGER")
     */
    private $cuentaCorriente;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getConcepto(): ?string
    {
        return $this->concepto;
    }

    public function setConcepto(string $concepto): self
    {
        $this->concepto = $concepto;

        return $this;
    }

    public function getImporte(): ?string
    {
        return $this->importe;
    }

    public function setImporte(string $importe): self
    {
        $this->importe = $importe;

        return $this;
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

    /**
     * @return mixed
     */
    public function getCuentaCorriente()
    {
        return $this->cuentaCorriente;
    }

    /**
     * @param mixed $cuentaCorriente
     */
    public function setCuentaCorriente($cuentaCorriente): void
    {
        $this->cuentaCorriente = $cuentaCorriente;
    }
}
