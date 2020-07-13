<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IntendenteRepository")
 */
class Intendente
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
    private $estado;

    /**
     * @ORM\Column(type="date")
     */
    private $fecha_inicio;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $fin_Funcion;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Persona", inversedBy="intendente", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $relation;



     public function __toString()
    {
        #$nombreApellido= 
       
        return  $this-> getEstado();

        
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getFechaInicio(): ?\DateTimeInterface
    {
        return $this->fecha_inicio;
    }

    public function setFechaInicio(\DateTimeInterface $fecha_inicio): self
    {
        $this->fecha_inicio = $fecha_inicio;

        return $this;
    }

    public function getFinFuncion(): ?\DateTimeInterface
    {
        return $this->fin_Funcion;
    }

    public function setFinFuncion(?\DateTimeInterface $fin_Funcion): self
    {
        $this->fin_Funcion = $fin_Funcion;

        return $this;
    }

    public function getRelation(): ?Persona
    {
        return $this->relation;
    }

    public function setRelation(Persona $relation): self
    {
        $this->relation = $relation;

        return $this;
    }
}
