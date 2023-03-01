<?php

namespace App\Entity;

use App\Repository\SocioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SocioRepository::class)]
class Socio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z áíéóúÁÉÍÓÚñÑ]+$/'
    )]
    #[Assert\Length(
        min: 1,
        max: 100,
    )]
    #[ORM\Column(length: 255)]
    private ?string $nombre = null;


    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z áíéóúÁÉÍÓÚñÑ]+$/'
    )]
    #[Assert\Length(
        min: 1,
        max: 100,
    )]
    #[ORM\Column(length: 255)]
    private ?string $apellidos = null;


    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9 áíéóúÁÉÍÓÚñÑ@.]+$/'
    )]
    #[Assert\Email(
        message: 'El email {{ value }} no es un email válido.',
    )]
    #[ORM\Column(length: 255)]
    private ?string $correo = null;
    
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[0-9]+$/'
    )]
    #[Assert\Length(
        min: 9,
        max: 9,
    )]
    #[ORM\Column(length: 255)]
    private ?string $telefono = null;


    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9 áíéóúÁÉÍÓÚñÑ]+$/'
    )]
    #[Assert\Length(
        min: 1,
        max: 200,
    )]
    #[ORM\Column(length: 255)]
    private ?string $direccion = null;

    #[ORM\OneToMany(mappedBy: 'socio', targetEntity: Prestamo::class, orphanRemoval: true)]
    private Collection $prestamos;

    public function __construct()
    {
        $this->prestamos = new ArrayCollection();
    }

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

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo): self
    {
        $this->correo = $correo;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(string $direccion): self
    {
        $this->direccion = $direccion;

        return $this;
    }

    /**
     * @return Collection<int, Prestamo>
     */
    public function getPrestamos(): Collection
    {
        return $this->prestamos;
    }

    public function addPrestamo(Prestamo $prestamo): self
    {
        if (!$this->prestamos->contains($prestamo)) {
            $this->prestamos->add($prestamo);
            $prestamo->setSocio($this);
        }

        return $this;
    }

    public function removePrestamo(Prestamo $prestamo): self
    {
        if ($this->prestamos->removeElement($prestamo)) {
            // set the owning side to null (unless already changed)
            if ($prestamo->getSocio() === $this) {
                $prestamo->setSocio(null);
            }
        }

        return $this;
    }

    public function __toString():string
    {
        return $this->nombre;
    }
}
