<?php

namespace Project\BackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Provincia
 *
 * @ORM\Table(name="provincia")
 * @ORM\Entity(repositoryClass="Project\BackBundle\Entity\ProvinciaRepository")
 * @ORM\Entity
 */
class Provincia
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
     * @ORM\Column(name="nombre", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="seo", type="string", length=50, nullable=false)
     */
    private $seo;

    /**
     * @var string
     *
     * @ORM\Column(name="iniciales", type="string", length=3, nullable=false)
     */
    private $iniciales;


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
     * @return Provincia
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

    /**
     * Set seo
     *
     * @param string $seo
     * @return Provincia
     */
    public function setSeo($seo)
    {
        $this->seo = $seo;
    
        return $this;
    }

    /**
     * Get seo
     *
     * @return string 
     */
    public function getSeo()
    {
        return $this->seo;
    }

    /**
     * Set iniciales
     *
     * @param string $iniciales
     * @return Provincia
     */
    public function setIniciales($iniciales)
    {
        $this->iniciales = $iniciales;
    
        return $this;
    }

    /**
     * Get iniciales
     *
     * @return string 
     */
    public function getIniciales()
    {
        return $this->iniciales;
    }


}
