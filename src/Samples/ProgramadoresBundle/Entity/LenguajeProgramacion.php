<?php

namespace Samples\ProgramadoresBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_programadores__lenguaje_programacion")
 * @ORM\Entity(repositoryClass="\Samples\ProgramadoresBundle\Manager\LenguajeProgramacionRepository") 
 * @UniqueEntity(fields={"nombre"})  
 */
class LenguajeProgramacion {

    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     * @ORM\GeneratedValue(strategy="UUID")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    protected $nombre;

    public function __toString() {
        return $this->getNombre()?$this->getNombre():"Lenguaje de Programación";
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return LenguajeProgramacion
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre()
    {
        return $this->nombre;
    }
}
