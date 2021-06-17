<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=SocioRepository::class)
 */
class Socio implements UserInterface
{
    const REGISTRO_OK = 'El socio se ha registrado correctamente';

    public function __construct(){
        $this->roles = ['ROLE_USER'];    
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $dni;

    /**
     * @ORM\Column(type="string", length=180, unique=true, nullable=true)
     */
    private $email;
    
    /**
     * @ORM\Column(type="string")
     */
    private $nombre;

    /**
     * @ORM\Column(type="string")
     */
    private $apellido1;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $apellido2;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $direccion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $num_socio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fecha_alta;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Noticia", mappedBy="socio")
     */
    private $noticia;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reserva", mappedBy="socio")
     */
    private $reserva;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): self
    {
        $this->dni = $dni;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of nombre
     */ 
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set the value of nombre
     *
     * @return  self
     */ 
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get the value of apellido1
     */ 
    public function getApellido1()
    {
        return $this->apellido1;
    }

    /**
     * Set the value of apellido1
     *
     * @return  self
     */ 
    public function setApellido1($apellido1)
    {
        $this->apellido1 = $apellido1;

        return $this;
    }

    /**
     * Get the value of apellido2
     */ 
    public function getApellido2()
    {
        return $this->apellido2;
    }

    /**
     * Set the value of apellido2
     *
     * @return  self
     */ 
    public function setApellido2($apellido2)
    {
        $this->apellido2 = $apellido2;

        return $this;
    }

    /**
     * Get the value of direccion
     */ 
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * Set the value of direccion
     *
     * @return  self
     */ 
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * Get the value of num_socio
     */ 
    public function getNumSocio()
    {
        return $this->num_socio;
    }

    /**
     * Set the value of num_socio
     *
     * @return  self
     */ 
    public function setNumSocio($num_socio)
    {
        $this->num_socio = $num_socio;

        return $this;
    }

    /**
     * Get the value of fecha_alta
     */ 
    public function getFechaAlta(): ?\DateTimeInterface
    {
        return $this->fecha_alta;
    }

    /**
     * Set the value of fecha_alta
     *
     * @return  self
     */ 
    public function setFechaAlta(\DateTimeInterface $fecha_alta)
    {
        $this->fecha_alta = $fecha_alta;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getNoticia(): ?Noticia
    {
        return $this->noticia;
    }

    /**
     * @param mixed $noticia
     */
    public function setNoticia($noticia): void
    {
        $this->noticia = $noticia;
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
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->dni;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }



    
}
