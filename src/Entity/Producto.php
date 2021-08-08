<?php

namespace App\Entity;

use App\Repository\ProductoRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductoRepository::class)
 */
class Producto
{
    public function __construct(){
        $this->archivado = 0;
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $stock;

    /**
     * @ORM\Column(type="decimal", precision=10, scale=2)
     */
    private $precioUnitario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ConsumicionReserva", mappedBy="producto")
     */
    private $consumicionReserva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(?int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    /**
     * @param mixed $precioUnitario
     */
    public function setPrecioUnitario($precioUnitario): void
    {
        $this->precioUnitario = $precioUnitario;
    }


}
