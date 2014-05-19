<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ConfirmacionElemento
 *
 * @ORM\Table(name="confirmacion_elemento")
 * @ORM\Entity
 */
class ConfirmacionElemento
{
	/**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
 
    /**
     * @var \Confirmacion
     *
     * @ORM\ManyToOne(targetEntity="Confirmacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="confirmacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $confirmacion;

    /**
     * @var \Reserva
     *
     * @ORM\ManyToOne(targetEntity="Reserva")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="reserva", referencedColumnName="id", nullable=false)
     * })
     */
    private $reserva;


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
     * Set confirmacion
     *
     * @param \Proyecto\PrincipalBundle\Entity\Confirmacion $confirmacion
     * @return ConfirmacionElemento
     */
    public function setConfirmacion(\Proyecto\PrincipalBundle\Entity\Confirmacion $confirmacion)
    {
        $this->confirmacion = $confirmacion;
    
        return $this;
    }

    /**
     * Get confirmacion
     *
     * @return \Proyecto\PrincipalBundle\Entity\Confirmacion 
     */
    public function getConfirmacion()
    {
        return $this->confirmacion;
    }

    /**
     * Set reserva
     *
     * @param \Proyecto\PrincipalBundle\Entity\Reserva $reserva
     * @return ConfirmacionElemento
     */
    public function setReserva(\Proyecto\PrincipalBundle\Entity\Reserva $reserva)
    {
        $this->reserva = $reserva;
    
        return $this;
    }

    /**
     * Get reserva
     *
     * @return \Proyecto\PrincipalBundle\Entity\Reserva 
     */
    public function getReserva()
    {
        return $this->reserva;
    }
}