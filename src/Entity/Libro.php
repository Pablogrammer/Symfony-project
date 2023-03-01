<?php

namespace App\Entity;

use App\Repository\LibroRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: LibroRepository::class)]
class Libro
{

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z0-9 áíéóúÁÉÍÓÚñÑ]+$/'
    )]
    #[Assert\Length(
        min: 1,
        max: 100,
    )]
    #[ORM\Column(length: 255)]
    private ?string $titulo = null;

    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z áíéóúÁÉÍÓÚñÑ]+$/'
    )]
    #[Assert\Length(
        min: 1,
        max: 100,
    )]
    #[ORM\Column(length: 255)]
    private ?string $autor = null;
    
    #[Assert\NotBlank]
    #[Assert\Length(
        min: 1,
        max: 100,
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z áíéóúÁÉÍÓÚñÑ]+$/'
    )]
    #[ORM\Column(length: 255)]
    private ?string $editorial = null;
    
    #[Assert\NotBlank]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z áíéóúÁÉÍÓÚñÑ]+$/'
    )]
    #[Assert\Length(
        min: 1,
        max: 100,
    )]
    #[ORM\Column(length: 255)]
    private ?string $genero = null;
    
    #[Assert\NotBlank]
    #[Assert\Range(
        min: 0,
        max: 0,
        notInRangeMessage: 'Un número entre {{ min }} y {{ max }}',
    )]
    #[ORM\Column]
    private ?int $numEjemplares = null;

    #[ORM\OneToMany(mappedBy: 'libro', targetEntity: Ejemplar::class, orphanRemoval: true)]
    private Collection $ejemplares;


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

    public function getAutor(): ?string
    {
        return $this->autor;
    }

    public function setAutor(string $autor): self
    {
        $this->autor = $autor;

        return $this;
    }

    public function getEditorial(): ?string
    {
        return $this->editorial;
    }

    public function setEditorial(string $editorial): self
    {
        $this->editorial = $editorial;

        return $this;
    }

    public function getGenero(): ?string
    {
        return $this->genero;
    }

    public function setGenero(string $genero): self
    {
        $this->genero = $genero;

        return $this;
    }

    public function getNumEjemplares(): ?int
    {
        return $this->numEjemplares;
    }

    public function setNumEjemplares(int $numEjemplares): self
    {
        $this->numEjemplares = $numEjemplares;

        return $this;
    }

    public function getEjemplares(): Collection{
        return $this->ejemplares;
    }

    public function __toString():string
    {
        return $this->titulo;
    }
}
