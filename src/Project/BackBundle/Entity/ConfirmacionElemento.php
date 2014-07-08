<?php

namespace Project\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * ConfirmacionElemento
 *
 * @ORM\Table(name="confirmacion_elemento")
 * @ORM\Entity(repositoryClass="Project\BackBundle\Entity\ConfirmacionElementoRepository")
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
     * @param \Project\BackBundle\Entity\Confirmacion $confirmacion
     * @return ConfirmacionElemento
     */
    public function setConfirmacion(\Project\BackBundle\Entity\Confirmacion $confirmacion)
    {
        $this->confirmacion = $confirmacion;
    
        return $this;
    }

    /**
     * Get confirmacion
     *
     * @return \Project\BackBundle\Entity\Confirmacion 
     */
    public function getConfirmacion()
    {
        return $this->confirmacion;
    }

    /**
     * Set reserva
     *
     * @param \Project\BackBundle\Entity\Reserva $reserva
     * @return ConfirmacionElemento
     */
    public function setReserva(\Project\BackBundle\Entity\Reserva $reserva)
    {
        $this->reserva = $reserva;
    
        return $this;
    }

    /**
     * Get reserva
     *
     * @return \Project\BackBundle\Entity\Reserva 
     */
    public function getReserva()
    {
        return $this->reserva;
    }
}
