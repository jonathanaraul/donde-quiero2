<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Facturacion
 *
 * @ORM\Table(name="facturacion")
 * @ORM\Entity
 */
class Facturacion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="empresa", type="string", length=300, nullable=false)
     */
    private $empresa;

    /**
     * @var string
     *
     * @ORM\Column(name="identificador", type="string", length=300, nullable=false)
     */
    private $identificador;

     /**
     * @ORM\Column(type="text", nullable=false)
     */
    public $direccion;

    /**
     * @var \Localidad
     *
     * @ORM\ManyToOne(targetEntity="Localidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localidad", referencedColumnName="id", nullable=false)
     * })
     */
    private $localidad;


    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="\Proyecto\UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id", nullable=false)
     * })
     */
    private $user;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @ORM\Column(name="aceptoTerminos", type="boolean", nullable=false)
     */
    private $aceptoTerminos;


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
     * Set identificador
     *
     * @param string $identificador
     * @return Facturacion
     */
    public function setIdentificador($identificador)
    {
        $this->identificador = $identificador;
    
        return $this;
    }

    /**
     * Get identificador
     *
     * @return string 
     */
    public function getIdentificador()
    {
        return $this->identificador;
    }

    /**
     * Set direccion
     *
     * @param string $direccion
     * @return Facturacion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    
        return $this;
    }

    /**
     * Get direccion
     *
     * @return string 
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

 
    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Facturacion
     */
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    
        return $this;
    }

    /**
     * Get fechaRegistro
     *
     * @return \DateTime 
     */
    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    /**
     * Set localidad
     *
     * @param \Proyecto\PrincipalBundle\Entity\Localidad $localidad
     * @return Facturacion
     */
    public function setLocalidad(\Proyecto\PrincipalBundle\Entity\Localidad $localidad)
    {
        $this->localidad = $localidad;
    
        return $this;
    }

    /**
     * Get localidad
     *
     * @return \Proyecto\PrincipalBundle\Entity\Localidad 
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * Set empresa
     *
     * @param string $empresa
     * @return Facturacion
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;
    
        return $this;
    }

    /**
     * Get empresa
     *
     * @return string 
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Set aceptoTerminos
     *
     * @param boolean $aceptoTerminos
     * @return Facturacion
     */
    public function setAceptoTerminos($aceptoTerminos)
    {
        $this->aceptoTerminos = $aceptoTerminos;
    
        return $this;
    }

    /**
     * Get aceptoTerminos
     *
     * @return boolean 
     */
    public function getAceptoTerminos()
    {
        return $this->aceptoTerminos;
    }

    /**
     * Set user
     *
     * @param \Proyecto\UserBundle\Entity\User $user
     * @return Facturacion
     */
    public function setUser(\Proyecto\UserBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Proyecto\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
