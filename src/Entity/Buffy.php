<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="buffy")
 * @ORM\Entity(repositoryClass="App\Repository\BuffyRepository")
 */
class Buffy
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $name;
    /**
     * @ORM\Column(type="text")
     */
    private $quote;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ComidaPreferidad", mappedBy="Nombre_buffy")
     */
    private $Comidas_preferidas;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ComidaPreferidad", mappedBy="comida")
     */
    private $platosDeComidas;


    /**
     *@ORM\Column(type="string", length=32  ,  unique=true)
     * @Gedmo\Slug(fields={"name"})
     */
    private $slug;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ComidaPreferidad", inversedBy="pepe")
     * @ORM\JoinColumn(nullable=false)
     */
    private $pepe;
    /**
    * Get slug
    * @return  
    */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
    * Set slug
    * @return $this
    */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }


    public function __toString()
    {
        return (string) $this->id;
    }

    public function __construct()
    {
        $this->Comidas_preferidas = new ArrayCollection();
        $this->platosDeComidas    = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getQuote()
    {
        return $this->quote;
    }

    /**
     * @param mixed $quote
     */
    public function setQuote($quote): void
    {
        $this->quote = $quote;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|ComidaPreferidad[]
     */
    public function getComidasPreferidas(): Collection
    {
        return $this->Comidas_preferidas;
    }

    public function addComidasPreferida(ComidaPreferidad $comidasPreferida): self
    {
        if (!$this->Comidas_preferidas->contains($comidasPreferida)) {
            $this->Comidas_preferidas[] = $comidasPreferida;
            $comidasPreferida->setNombreBuffy($this);
        }

        return $this;
    }

    public function removeComidasPreferida(ComidaPreferidad $comidasPreferida): self
    {
        if ($this->Comidas_preferidas->contains($comidasPreferida)) {
            $this->Comidas_preferidas->removeElement($comidasPreferida);
            // set the owning side to null (unless already changed)
            if ($comidasPreferida->getNombreBuffy() === $this) {
                $comidasPreferida->setNombreBuffy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ComidaPreferidad[]
     */
    public function getPlatosDeComidas(): Collection
    {
        return $this->platosDeComidas;
    }

    public function addPlatosDeComida(ComidaPreferidad $platosDeComida): self
    {
        if (!$this->platosDeComidas->contains($platosDeComida)) {
            $this->platosDeComidas[] = $platosDeComida;
            $platosDeComida->setComida($this);
        }

        return $this;
    }

    public function removePlatosDeComida(ComidaPreferidad $platosDeComida): self
    {
        if ($this->platosDeComidas->contains($platosDeComida)) {
            $this->platosDeComidas->removeElement($platosDeComida);
            // set the owning side to null (unless already changed)
            if ($platosDeComida->getComida() === $this) {
                $platosDeComida->setComida(null);
            }
        }

        return $this;
    }

    public function getPepe(): ?ComidaPreferidad
    {
        return $this->pepe;
    }

    public function setPepe(?ComidaPreferidad $pepe): self
    {
        $this->pepe = $pepe;

        return $this;
    }

}
