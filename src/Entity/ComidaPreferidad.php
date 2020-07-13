<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComidaPreferidadRepository")
 */
class ComidaPreferidad
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Buffy", inversedBy="Comidas_preferidas")
     */
    private $Nombre_buffy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Buffy", inversedBy="platosDeComidas")
     */
    private $comida;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Buffy", mappedBy="pepe", orphanRemoval=true)
     */
    private $pepe;

    public function __construct()
    {
        $this->pepe = new ArrayCollection();
    }

/*    public function __toString()
    {
        return (string) $this->Nombre_buffy;
    }*/
      public function __toString()
    {
        return (string) $this->nombre;
    }
    public function getId():  ? int
    {
        return $this->id;
    }

    public function getNombre() :  ? string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre) : self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNombreBuffy():  ? Buffy
    {
        return $this->Nombre_buffy;
    }

    public function setNombreBuffy( ? Buffy $Nombre_buffy) : self
    {
        $this->Nombre_buffy = $Nombre_buffy;

        return $this;
    }

    public function getComida() :  ? Buffy
    {
        return $this->comida;
    }

    public function setComida( ? Buffy $comida) : self
    {
        $this->comida = $comida;

        return $this;
    }

    /**
     * @return Collection|Buffy[]
     */
    public function getPepe(): Collection
    {
        return $this->pepe;
    }

    public function addPepe(Buffy $pepe): self
    {
        if (!$this->pepe->contains($pepe)) {
            $this->pepe[] = $pepe;
            $pepe->setPepe($this);
        }

        return $this;
    }

    public function removePepe(Buffy $pepe): self
    {
        if ($this->pepe->contains($pepe)) {
            $this->pepe->removeElement($pepe);
            // set the owning side to null (unless already changed)
            if ($pepe->getPepe() === $this) {
                $pepe->setPepe(null);
            }
        }

        return $this;
    }
}
