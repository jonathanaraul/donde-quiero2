<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Reserva
 *
 * @ORM\Table(name="reserva")
 * @ORM\Entity
 */
class Reserva
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
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
     * @ORM\Column(name="fechaInicio", type="datetime", nullable=false)
     */
    private $fechaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaFin", type="datetime", nullable=false)
     */
    private $fechaFin;

    /**
     * @ORM\Column(name="numeroReservacion",type="integer", nullable=false)
     */
    private $numeroReservacion;


    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $titulo;

    /**
     * @ORM\Column(name="todoDia",type="boolean", nullable=false)
     */
    private $todoDia;

    /**
     * @ORM\Column(name="pagado",type="boolean", nullable=false)
     */
    private $pagado;

    /**
     * @ORM\Column(name="cancelado",type="boolean", nullable=false)
     */
    private $cancelado;
    /**
     * @ORM\Column(name="aprobado",type="boolean", nullable=false)
     */
    private $aprobado;

    /**
     * @ORM\Column(name="oculto",type="boolean", nullable=false)
     */
    private $oculto;

    /**
     * @var \Espacio
     *
     * @ORM\ManyToOne(targetEntity="Espacio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="espacio", referencedColumnName="id", nullable=true)
     * })
     */
    private $espacio;

    /**
     * @var \Sede
     *
     * @ORM\ManyToOne(targetEntity="Sede")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="sede", referencedColumnName="id", nullable=true)
     * })
     */
    private $sede;

     /**
     * @var \Servicio
     *
     * @ORM\ManyToOne(targetEntity="Servicio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="servicio", referencedColumnName="id", nullable=true)
     * })
     */
    private $servicio;

    /**
     * @var \Evento
     *
     * @ORM\ManyToOne(targetEntity="Evento")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="evento", referencedColumnName="id", nullable=true)
     * })
     */
    private $evento;


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
     * Set fechaInicio
     *
     * @param \DateTime $fechaInicio
     * @return Reserva
     */
    public function setFechaInicio($fechaInicio)
    {
        $this->fechaInicio = $fechaInicio;
    
        return $this;
    }

    /**
     * Get fechaInicio
     *
     * @return \DateTime 
     */
    public function getFechaInicio()
    {
        return $this->fechaInicio;
    }

    /**
     * Set fechaFin
     *
     * @param \DateTime $fechaFin
     * @return Reserva
     */
    public function setFechaFin($fechaFin)
    {
        $this->fechaFin = $fechaFin;
    
        return $this;
    }

    /**
     * Get fechaFin
     *
     * @return \DateTime 
     */
    public function getFechaFin()
    {
        return $this->fechaFin;
    }

    /**
     * Set numeroReservacion
     *
     * @param integer $numeroReservacion
     * @return Reserva
     */
    public function setNumeroReservacion($numeroReservacion)
    {
        $this->numeroReservacion = $numeroReservacion;
    
        return $this;
    }

    /**
     * Get numeroReservacion
     *
     * @return integer 
     */
    public function getNumeroReservacion()
    {
        return $this->numeroReservacion;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Reserva
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set todoDia
     *
     * @param boolean $todoDia
     * @return Reserva
     */
    public function setTodoDia($todoDia)
    {
        $this->todoDia = $todoDia;
    
        return $this;
    }

    /**
     * Get todoDia
     *
     * @return boolean 
     */
    public function getTodoDia()
    {
        return $this->todoDia;
    }

    /**
     * Set espacio
     *
     * @param \Proyecto\PrincipalBundle\Entity\Espacio $espacio
     * @return Reserva
     */
    public function setEspacio(\Proyecto\PrincipalBundle\Entity\Espacio $espacio = null)
    {
        $this->espacio = $espacio;
    
        return $this;
    }

    /**
     * Get espacio
     *
     * @return \Proyecto\PrincipalBundle\Entity\Espacio 
     */
    public function getEspacio()
    {
        return $this->espacio;
    }

    /**
     * Set sede
     *
     * @param \Proyecto\PrincipalBundle\Entity\Sede $sede
     * @return Reserva
     */
    public function setSede(\Proyecto\PrincipalBundle\Entity\Sede $sede = null)
    {
        $this->sede = $sede;
    
        return $this;
    }

    /**
     * Get sede
     *
     * @return \Proyecto\PrincipalBundle\Entity\Sede 
     */
    public function getSede()
    {
        return $this->sede;
    }

    /**
     * Set servicio
     *
     * @param \Proyecto\PrincipalBundle\Entity\Servicio $servicio
     * @return Reserva
     */
    public function setServicio(\Proyecto\PrincipalBundle\Entity\Servicio $servicio = null)
    {
        $this->servicio = $servicio;
    
        return $this;
    }

    /**
     * Get servicio
     *
     * @return \Proyecto\PrincipalBundle\Entity\Servicio 
     */
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set evento
     *
     * @param \Proyecto\PrincipalBundle\Entity\Evento $evento
     * @return Reserva
     */
    public function setEvento(\Proyecto\PrincipalBundle\Entity\Evento $evento = null)
    {
        $this->evento = $evento;
    
        return $this;
    }

    /**
     * Get evento
     *
     * @return \Proyecto\PrincipalBundle\Entity\Evento 
     */
    public function getEvento()
    {
        return $this->evento;
    }

    /**
     * Set pagado
     *
     * @param boolean $pagado
     * @return Reserva
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;
    
        return $this;
    }

    /**
     * Get pagado
     *
     * @return boolean 
     */
    public function getPagado()
    {
        return $this->pagado;
    }

    /**
     * Set cancelado
     *
     * @param boolean $cancelado
     * @return Reserva
     */
    public function setCancelado($cancelado)
    {
        $this->cancelado = $cancelado;
    
        return $this;
    }

    /**
     * Get cancelado
     *
     * @return boolean 
     */
    public function getCancelado()
    {
        return $this->cancelado;
    }

    /**
     * Set aprobado
     *
     * @param boolean $aprobado
     * @return Reserva
     */
    public function setAprobado($aprobado)
    {
        $this->aprobado = $aprobado;
    
        return $this;
    }

    /**
     * Get aprobado
     *
     * @return boolean 
     */
    public function getAprobado()
    {
        return $this->aprobado;
    }

    /**
     * Set oculto
     *
     * @param boolean $oculto
     * @return Reserva
     */
    public function setOculto($oculto)
    {
        $this->oculto = $oculto;
    
        return $this;
    }

    /**
     * Get oculto
     *
     * @return boolean 
     */
    public function getOculto()
    {
        return $this->oculto;
    }

    /**
     * Set user
     *
     * @param \Proyecto\UserBundle\Entity\User $user
     * @return Reserva
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
