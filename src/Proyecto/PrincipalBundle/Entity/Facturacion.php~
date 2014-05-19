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
     * @var string
     *
     * @ORM\Column(name="numeroCuenta", type="string", length=300, nullable=false)
     */
    private $numeroCuenta;
    /**
     * @var string
     *
     * @ORM\Column(name="numeroTarjeta", type="string", length=300, nullable=false)
     */
    private $numeroTarjeta;

    /**
     * * @var \DateTime
     *
     * @ORM\Column(name="fechaCaducidad", type="datetime", nullable=false)
     */
    private $fechaCaducidad;

    /**
     * @var string
     *
     * @ORM\Column(name="codigo", type="string", length=300, nullable=false)
     */
    private $codigo;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
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
     * Set numeroCuenta
     *
     * @param string $numeroCuenta
     * @return Facturacion
     */
    public function setNumeroCuenta($numeroCuenta)
    {
        $this->numeroCuenta = $numeroCuenta;
    
        return $this;
    }

    /**
     * Get numeroCuenta
     *
     * @return string 
     */
    public function getNumeroCuenta()
    {
        return $this->numeroCuenta;
    }

    /**
     * Set numeroTarjeta
     *
     * @param string $numeroTarjeta
     * @return Facturacion
     */
    public function setNumeroTarjeta($numeroTarjeta)
    {
        $this->numeroTarjeta = $numeroTarjeta;
    
        return $this;
    }

    /**
     * Get numeroTarjeta
     *
     * @return string 
     */
    public function getNumeroTarjeta()
    {
        return $this->numeroTarjeta;
    }

    /**
     * Set fechaCaducidad
     *
     * @param \DateTime $fechaCaducidad
     * @return Facturacion
     */
    public function setFechaCaducidad($fechaCaducidad)
    {
        $this->fechaCaducidad = $fechaCaducidad;
    
        return $this;
    }

    /**
     * Get fechaCaducidad
     *
     * @return \DateTime 
     */
    public function getFechaCaducidad()
    {
        return $this->fechaCaducidad;
    }

    /**
     * Set codigo
     *
     * @param string $codigo
     * @return Facturacion
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    
        return $this;
    }

    /**
     * Get codigo
     *
     * @return string 
     */
    public function getCodigo()
    {
        return $this->codigo;
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
     * Set user
     *
     * @param \Proyecto\PrincipalBundle\Entity\User $user
     * @return Facturacion
     */
    public function setUser(\Proyecto\PrincipalBundle\Entity\User $user)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Proyecto\PrincipalBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
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
}