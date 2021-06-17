<?php

namespace App\Entity;

use App\Repository\NoticiaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=NoticiaRepository::class)
 */
class Noticia
{
    const REGISTRO_OK = 'El socio se ha registrado correctamente';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titulo;

    /**
     * @ORM\Column(type="string", length=80000)
     */
    private $contenido;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_publicacion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Socio", inversedBy="noticia", fetch="EAGER")
     */
    private $socio;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitulo(): ?string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): self
    {
        $this->titulo = $titulo;

        return $this;
    }

    public function getContenido(): ?string
    {
        return $this->contenido;
    }

    public function setContenido(string $contenido): self
    {
        $this->contenido = $contenido;

        return $this;
    }

    public function getFechaPublicacion(): ?\DateTimeInterface
    {
        return $this->fecha_publicacion;
    }

    public function setFechaPublicacion(\DateTimeInterface $fecha_publicacion): self
    {
        $this->fecha_publicacion = $fecha_publicacion;

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


}
