<?php

namespace App\Entity;

use App\Repository\CuentaCorrienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CuentaCorrienteRepository::class)
 */
class CuentaCorriente
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
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titular;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2, nullable=true)
     */
    private $saldo;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CuentaCorrienteMovimientos", mappedBy="cuentaCorriente")
     */
    private $cuentaCorrienteMovimientos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $iban;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getTitular(): ?string
    {
        return $this->titular;
    }

    public function setTitular(string $titular): self
    {
        $this->titular = $titular;

        return $this;
    }

    public function getSaldo(): ?string
    {
        return $this->saldo;
    }

    public function setSaldo(?string $saldo): self
    {
        $this->saldo = $saldo;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCuentaCorrienteMovimientos()
    {
        return $this->cuentaCorrienteMovimientos;
    }

    /**
     * @param mixed $cuentaCorrienteMovimientos
     */
    public function setCuentaCorrienteMovimientos($cuentaCorrienteMovimientos): void
    {
        $this->cuentaCorrienteMovimientos = $cuentaCorrienteMovimientos;
    }

    public function getIban(): ?string
    {
        return $this->iban;
    }

    public function setIban(string $iban): self
    {
        $this->iban = $iban;

        return $this;
    }
}
