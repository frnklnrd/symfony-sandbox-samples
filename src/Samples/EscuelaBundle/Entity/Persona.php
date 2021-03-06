<?php

namespace Samples\EscuelaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="samples_escuela__persona",
 *           uniqueConstraints={
 *                              @ORM\UniqueConstraint(name="persona_ci_unique",columns={"ci"}),
 *                              @ORM\UniqueConstraint(name="persona_nombre_apellidos_unique",columns={"nombre","apellido1","apellido2"})})
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="profesor_o_estudiante", type="string")
 * @ORM\DiscriminatorMap({"profesor" = "Profesor", "estudiante" = "Estudiante"})
 * @UniqueEntity(fields={"ci"})
 * @UniqueEntity(fields={"nombre", "apellido1", "apellido2"})
 */
abstract class Persona {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=11, unique=true, nullable=false )
     * @Assert\NotBlank(message="No debe estar vacío")
     * @Assert\Regex(pattern="/\w/", match=true, message="Debe contener solo números")
     * @Assert\Length(min=11, max=11, exactMessage="Debe estar formado por {{ limit }} digitos")
     */
    private $ci;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $apellido1;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $apellido2;

    /**
     * @ORM\Column(type="date", nullable=false)
     */
    private $fecha_nacimiento;

    /**
     * @ORM\Column(type="string", length=1, nullable=false)
     * @Assert\Choice(choices={"M","F"}, message="Debe seleccionar el sexo")
     */
    private $sexo;

    /**
     * @ORM\OneToOne(targetEntity="DireccionParticular", mappedBy="persona",cascade={"all"})
     * @Assert\Valid()
     */
    private $direccion;

    /**
     * @ORM\ManyToOne(targetEntity="Escuela")
     * @ORM\JoinColumn(name="escuela_id", referencedColumnName="id", nullable=false)
     */
    private $escuela;

    public function getEdad() {
        //->format('Y-m-d H:i:s');

        return (int) ($this->getFechaNacimiento()->diff(new \DateTime())->format("%Y"));
    }

    public function __toString() {
        return $this->getNombre() . " " . $this->getApellido1() . " " . $this->getApellido2();
    }

    public function getSexoMF() {
        return ($this->sexo=="M" || $this->sexo=="m")?"Masculino":"Femenino";
    }

    public function getTipo() {
        return substr(get_class($this), strrpos(get_class($this), "\\") + 1);
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set ci
     *
     * @param string $ci
     * @return Persona
     */
    public function setCi($ci) {
        $this->ci = $ci;

        return $this;
    }

    /**
     * Get ci
     *
     * @return string 
     */
    public function getCi() {
        return $this->ci;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Persona
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string 
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set apellido1
     *
     * @param string $apellido1
     * @return Persona
     */
    public function setApellido1($apellido1) {
        $this->apellido1 = $apellido1;

        return $this;
    }

    /**
     * Get apellido1
     *
     * @return string 
     */
    public function getApellido1() {
        return $this->apellido1;
    }

    /**
     * Set apellido2
     *
     * @param string $apellido2
     * @return Persona
     */
    public function setApellido2($apellido2) {
        $this->apellido2 = $apellido2;

        return $this;
    }

    /**
     * Get apellido2
     *
     * @return string 
     */
    public function getApellido2() {
        return $this->apellido2;
    }

    /**
     * Set fecha_nacimiento
     *
     * @param \DateTime $fechaNacimiento
     * @return Persona
     */
    public function setFechaNacimiento($fechaNacimiento) {
        $this->fecha_nacimiento = $fechaNacimiento;

        return $this;
    }

    /**
     * Get fecha_nacimiento
     *
     * @return \DateTime 
     */
    public function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Persona
     */
    public function setSexo($sexo) {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo() {
        return $this->sexo;
    }

    /**
     * Set direccion
     *
     * @param \Samples\EscuelaBundle\Entity\DireccionParticular $direccion
     * @return Persona
     */
    public function setDireccion(\Samples\EscuelaBundle\Entity\DireccionParticular $direccion) {
        $this->direccion = $direccion;
        if (!$this->direccion->getPersona())
            $this->direccion->setPersona($this);

        return $this;
    }

    /**
     * Get direccion
     *
     * @return \Samples\EscuelaBundle\Entity\DireccionParticular 
     */
    public function getDireccion() {
        return $this->direccion;
    }

    /**
     * Set escuela
     *
     * @param \Samples\EscuelaBundle\Entity\Escuela $escuela
     * @return Persona
     */
    public function setEscuela(\Samples\EscuelaBundle\Entity\Escuela $escuela = null) {
        $this->escuela = $escuela;

        return $this;
    }

    /**
     * Get escuela
     *
     * @return \Samples\EscuelaBundle\Entity\Escuela 
     */
    public function getEscuela() {
        return $this->escuela;
    }

}