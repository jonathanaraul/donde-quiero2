<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Espacio
 *
 * @ORM\Table(name="espacio")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Espacio
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(name="propietarioEmpleado", type="boolean", nullable=true)
     */
    private $propietarioEmpleado;
    
    /**
     * @ORM\Column(name="agenteComercial", type="boolean", nullable=true)
     */
    private $agenteComercial;
    
    /**
     * @ORM\Column(name="administradorWeb", type="boolean", nullable=true)
     */
    private $administradorWeb;

    /**
     * @ORM\Column(name="destacado", type="boolean", nullable=false)
     */
    private $destacado;
    /**
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;
    /**
     * @ORM\Column(name="suspendido", type="boolean", nullable=false)
     */
    private $suspendido;


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
     * @var \Localidad
     *
     * @ORM\ManyToOne(targetEntity="Localidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="localidad", referencedColumnName="id", nullable=false)
     * })
     */
    private $localidad;
    

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @ORM\Column(type="string", length=60, nullable=false)
     */
    private $nombre;

     /**
     * @ORM\Column(type="text")
     */
    public $descripcionGeneral;  

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $enlaceVideo;

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
     * @ORM\Column(name="superficie",type="integer", nullable=true)
     */
    private $superficie;

    /**
     * @ORM\Column(name="anchoMinimoLibre",type="integer", nullable=true)
     */
    private $anchoMinimoLibre;

    /**
     * @ORM\Column(name="largoMinimoLibre",type="integer", nullable=true)
     */
    private $largoMinimoLibre;

    /**
     * @ORM\Column(name="alturaMinimaLibre",type="integer", nullable=true)
     */
    private $alturaMinimaLibre;

    /**
     * @ORM\Column(name="modoAula", type="boolean", nullable=true)
     */
    private $modoAula;

    /**
     * @ORM\Column(name="modoAulaCapacidad",type="integer", nullable=true)
     */
    private $modoAulaCapacidad;

    /**
     * @ORM\Column(name="modoBanquete", type="boolean", nullable=true)
     */
    private $modoBanquete;

    /**
     * @ORM\Column(name="modoBanqueteCapacidad",type="integer", nullable=true)
     */
    private $modoBanqueteCapacidad;

    /**
     * @ORM\Column(name="modoCocktail", type="boolean", nullable=true)
     */
    private $modoCocktail;

    /**
     * @ORM\Column(name="modoCocktailCapacidad",type="integer", nullable=true)
     */
    private $modoCocktailCapacidad;


    /**
     * @ORM\Column(name="modoEscenario",type="boolean", nullable=true)
     */
    private $modoEscenario;

    /**
     * @ORM\Column(name="modoEscenarioCapacidad", type="integer", nullable=true)
     */
    private $modoEscenarioCapacidad;

    /**
     * @ORM\Column(name="modoExposicion",type="boolean", nullable=true)
     */
    private $modoExposicion;

    /**
     * @ORM\Column(name="modoExposicionCapacidad",type="integer", nullable=true)
     */
    private $modoExposicionCapacidad;



    /**
     * @ORM\Column(name="pilaresSueltos",type="boolean", nullable=true)
     */
    private $pilaresSueltos;

    /**
     * @ORM\Column(name="entradaAseosMovilidadReducida",type="boolean", nullable=true)
     */
    private $entradaAseosMovilidadReducida;

    /**
     * @ORM\Column(name="ventanasExterior",type="boolean", nullable=true)
     */
    private $ventanasExterior;

    /**
     * @ORM\Column(name="ventanasPatioInterior",type="boolean", nullable=true)
     */
    private $ventanasPatioInterior;

    /**
     * @ORM\Column(name="posibilidadOscurecerSala",type="boolean", nullable=true)
     */
    private $posibilidadOscurecerSala;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $otrasCaracteristicas;


   /**
     * @ORM\Column(name="proyectorPantallaSala", type="boolean", nullable=true)
     */
    private $proyectorPantallaSala;
    /**
     * @ORM\Column(name="microfonoAltavoces", type="boolean", nullable=true)
     */
    private $microfonoAltavoces;
    /**
     * @ORM\Column(name="videocamara", type="boolean", nullable=true)
     */
    private $videocamara;
    /**
     * @ORM\Column(name="wifi", type="boolean", nullable=true)
     */
    private $wifi;
    /**
     * @ORM\Column(name="internetCable", type="boolean", nullable=true)
     */
    private $internetCable;
    /**
     * @ORM\Column(name="maquinaBebidas", type="boolean", nullable=true)
     */
    private $maquinaBebidas;
    /**
     * @ORM\Column(name="pizarra", type="boolean", nullable=true)
     */
    private $pizarra;
    /**
     * @ORM\Column(name="conserjeria", type="boolean", nullable=true)
     */
    private $conserjeria;
    /**
     * @ORM\Column(name="aireAcondicionado", type="boolean", nullable=true)
     */
    private $aireAcondicionado;
    /**
     * @ORM\Column(name="calefaccion", type="boolean", nullable=true)
     */
    private $calefaccion;


    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $otrosServicios;

   /**
     * @ORM\Column(name="aceptacionReservaAutomatica", type="boolean", nullable=true)
     */
    private $aceptacionReservaAutomatica;
    /**
     * @ORM\Column(name="tiempoMaximoAceptacionReservaAutomatica24h", type="boolean", nullable=true)
     */
    private $tiempoMaximoAceptacionReservaAutomatica24h;
    /**
     * @ORM\Column(name="tiempoMaximoAceptacionReservaAutomatica48", type="boolean", nullable=true)
     */
    private $tiempoMaximoAceptacionReservaAutomatica48;
    /**
     * @ORM\Column(name="datosFacturacionPagoDelUsuario", type="boolean", nullable=true)
     */
    private $datosFacturacionPagoDelUsuario;
    /**
     * @ORM\Column(name="anadirDatosFacturacionPago", type="boolean", nullable=true)
     */
    private $anadirDatosFacturacionPago;
    /**
     * @ORM\Column(name="todas", type="boolean", nullable=true)
     */
    private $todas;
    /**
     * @ORM\Column(name="similaresCentroRealiza", type="boolean", nullable=true)
     */
    private $similaresCentroRealiza;
    /**
     * @ORM\Column(name="formacionTeorica", type="boolean", nullable=true)
     */
    private $formacionTeorica;
    /**
     * @ORM\Column(name="formacionInformatica", type="boolean", nullable=true)
     */
    private $formacionInformatica;
    /**
     * @ORM\Column(name="formacionTaller", type="boolean", nullable=true)
     */
    private $formacionTaller;
    /**
     * @ORM\Column(name="exposicion", type="boolean", nullable=true)
     */
    private $exposicion;
    /**
     * @ORM\Column(name="ventaFeria", type="boolean", nullable=true)
     */
    private $ventaFeria;
    /**
     * @ORM\Column(name="deporte", type="boolean", nullable=true)
     */
    private $deporte;
    /**
     * @ORM\Column(name="espectaculo", type="boolean", nullable=true)
     */
    private $espectaculo;
    /**
     * @ORM\Column(name="reunionAsamblea", type="boolean", nullable=true)
     */
    private $reunionAsamblea;
    /**
     * @ORM\Column(name="boda", type="boolean", nullable=true)
     */
    private $boda;
    /**
     * @ORM\Column(name="fiesta", type="boolean", nullable=true)
     */
    private $fiesta;
    /**
     * @ORM\Column(name="jardineria", type="boolean", nullable=true)
     */
    private $jardineria;
    /**
     * @ORM\Column(name="aceptoCondicionesUsoPoliticaPrivacidad", type="boolean", nullable=false)
     */
    private $aceptoCondicionesUsoPoliticaPrivacidad;

    /**
     * @ORM\Column(name="precioPorHora",type="float", nullable=false)
     */
    private $precioPorHora;



     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $path;
    
    /**
     * @Assert\File(maxSize="6000000")
     */
    private $file;
    private $temp;


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
     * Set propietarioEmpleado
     *
     * @param boolean $propietarioEmpleado
     * @return Espacio
     */
    public function setPropietarioEmpleado($propietarioEmpleado)
    {
        $this->propietarioEmpleado = $propietarioEmpleado;
    
        return $this;
    }

    /**
     * Get propietarioEmpleado
     *
     * @return boolean 
     */
    public function getPropietarioEmpleado()
    {
        return $this->propietarioEmpleado;
    }

    /**
     * Set agenteComercial
     *
     * @param boolean $agenteComercial
     * @return Espacio
     */
    public function setAgenteComercial($agenteComercial)
    {
        $this->agenteComercial = $agenteComercial;
    
        return $this;
    }

    /**
     * Get agenteComercial
     *
     * @return boolean 
     */
    public function getAgenteComercial()
    {
        return $this->agenteComercial;
    }

    /**
     * Set administradorWeb
     *
     * @param boolean $administradorWeb
     * @return Espacio
     */
    public function setAdministradorWeb($administradorWeb)
    {
        $this->administradorWeb = $administradorWeb;
    
        return $this;
    }

    /**
     * Get administradorWeb
     *
     * @return boolean 
     */
    public function getAdministradorWeb()
    {
        return $this->administradorWeb;
    }

    /**
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return Espacio
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
     * Set nombre
     *
     * @param string $nombre
     * @return Espacio
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
     * Set descripcionGeneral
     *
     * @param string $descripcionGeneral
     * @return Espacio
     */
    public function setDescripcionGeneral($descripcionGeneral)
    {
        $this->descripcionGeneral = $descripcionGeneral;
    
        return $this;
    }

    /**
     * Get descripcionGeneral
     *
     * @return string 
     */
    public function getDescripcionGeneral()
    {
        return $this->descripcionGeneral;
    }

    /**
     * Set enlaceVideo
     *
     * @param string $enlaceVideo
     * @return Espacio
     */
    public function setEnlaceVideo($enlaceVideo)
    {
        $this->enlaceVideo = $enlaceVideo;
    
        return $this;
    }

    /**
     * Get enlaceVideo
     *
     * @return string 
     */
    public function getEnlaceVideo()
    {
        return $this->enlaceVideo;
    }

    /**
     * Set superficie
     *
     * @param integer $superficie
     * @return Espacio
     */
    public function setSuperficie($superficie)
    {
        $this->superficie = $superficie;
    
        return $this;
    }

    /**
     * Get superficie
     *
     * @return integer 
     */
    public function getSuperficie()
    {
        return $this->superficie;
    }

    /**
     * Set anchoMinimoLibre
     *
     * @param integer $anchoMinimoLibre
     * @return Espacio
     */
    public function setAnchoMinimoLibre($anchoMinimoLibre)
    {
        $this->anchoMinimoLibre = $anchoMinimoLibre;
    
        return $this;
    }

    /**
     * Get anchoMinimoLibre
     *
     * @return integer 
     */
    public function getAnchoMinimoLibre()
    {
        return $this->anchoMinimoLibre;
    }

    /**
     * Set largoMinimoLibre
     *
     * @param integer $largoMinimoLibre
     * @return Espacio
     */
    public function setLargoMinimoLibre($largoMinimoLibre)
    {
        $this->largoMinimoLibre = $largoMinimoLibre;
    
        return $this;
    }

    /**
     * Get largoMinimoLibre
     *
     * @return integer 
     */
    public function getLargoMinimoLibre()
    {
        return $this->largoMinimoLibre;
    }

    /**
     * Set alturaMinimaLibre
     *
     * @param integer $alturaMinimaLibre
     * @return Espacio
     */
    public function setAlturaMinimaLibre($alturaMinimaLibre)
    {
        $this->alturaMinimaLibre = $alturaMinimaLibre;
    
        return $this;
    }

    /**
     * Get alturaMinimaLibre
     *
     * @return integer 
     */
    public function getAlturaMinimaLibre()
    {
        return $this->alturaMinimaLibre;
    }

    /**
     * Set modoAula
     *
     * @param boolean $modoAula
     * @return Espacio
     */
    public function setModoAula($modoAula)
    {
        $this->modoAula = $modoAula;
    
        return $this;
    }

    /**
     * Get modoAula
     *
     * @return boolean 
     */
    public function getModoAula()
    {
        return $this->modoAula;
    }

    /**
     * Set modoAulaCapacidad
     *
     * @param integer $modoAulaCapacidad
     * @return Espacio
     */
    public function setModoAulaCapacidad($modoAulaCapacidad)
    {
        $this->modoAulaCapacidad = $modoAulaCapacidad;
    
        return $this;
    }

    /**
     * Get modoAulaCapacidad
     *
     * @return integer 
     */
    public function getModoAulaCapacidad()
    {
        return $this->modoAulaCapacidad;
    }

    /**
     * Set modoBanquete
     *
     * @param boolean $modoBanquete
     * @return Espacio
     */
    public function setModoBanquete($modoBanquete)
    {
        $this->modoBanquete = $modoBanquete;
    
        return $this;
    }

    /**
     * Get modoBanquete
     *
     * @return boolean 
     */
    public function getModoBanquete()
    {
        return $this->modoBanquete;
    }

    /**
     * Set modoBanqueteCapacidad
     *
     * @param integer $modoBanqueteCapacidad
     * @return Espacio
     */
    public function setModoBanqueteCapacidad($modoBanqueteCapacidad)
    {
        $this->modoBanqueteCapacidad = $modoBanqueteCapacidad;
    
        return $this;
    }

    /**
     * Get modoBanqueteCapacidad
     *
     * @return integer 
     */
    public function getModoBanqueteCapacidad()
    {
        return $this->modoBanqueteCapacidad;
    }

    /**
     * Set modoCocktail
     *
     * @param boolean $modoCocktail
     * @return Espacio
     */
    public function setModoCocktail($modoCocktail)
    {
        $this->modoCocktail = $modoCocktail;
    
        return $this;
    }

    /**
     * Get modoCocktail
     *
     * @return boolean 
     */
    public function getModoCocktail()
    {
        return $this->modoCocktail;
    }

    /**
     * Set modoCocktailCapacidad
     *
     * @param integer $modoCocktailCapacidad
     * @return Espacio
     */
    public function setModoCocktailCapacidad($modoCocktailCapacidad)
    {
        $this->modoCocktailCapacidad = $modoCocktailCapacidad;
    
        return $this;
    }

    /**
     * Get modoCocktailCapacidad
     *
     * @return integer 
     */
    public function getModoCocktailCapacidad()
    {
        return $this->modoCocktailCapacidad;
    }

    /**
     * Set modoEscenario
     *
     * @param boolean $modoEscenario
     * @return Espacio
     */
    public function setModoEscenario($modoEscenario)
    {
        $this->modoEscenario = $modoEscenario;
    
        return $this;
    }

    /**
     * Get modoEscenario
     *
     * @return boolean 
     */
    public function getModoEscenario()
    {
        return $this->modoEscenario;
    }

    /**
     * Set modoEscenarioCapacidad
     *
     * @param integer $modoEscenarioCapacidad
     * @return Espacio
     */
    public function setModoEscenarioCapacidad($modoEscenarioCapacidad)
    {
        $this->modoEscenarioCapacidad = $modoEscenarioCapacidad;
    
        return $this;
    }

    /**
     * Get modoEscenarioCapacidad
     *
     * @return integer 
     */
    public function getModoEscenarioCapacidad()
    {
        return $this->modoEscenarioCapacidad;
    }

    /**
     * Set modoExposicion
     *
     * @param boolean $modoExposicion
     * @return Espacio
     */
    public function setModoExposicion($modoExposicion)
    {
        $this->modoExposicion = $modoExposicion;
    
        return $this;
    }

    /**
     * Get modoExposicion
     *
     * @return boolean 
     */
    public function getModoExposicion()
    {
        return $this->modoExposicion;
    }

    /**
     * Set modoExposicionCapacidad
     *
     * @param integer $modoExposicionCapacidad
     * @return Espacio
     */
    public function setModoExposicionCapacidad($modoExposicionCapacidad)
    {
        $this->modoExposicionCapacidad = $modoExposicionCapacidad;
    
        return $this;
    }

    /**
     * Get modoExposicionCapacidad
     *
     * @return integer 
     */
    public function getModoExposicionCapacidad()
    {
        return $this->modoExposicionCapacidad;
    }



   
    /**
     * Set otrasCaracteristicas
     *
     * @param string $otrasCaracteristicas
     * @return Espacio
     */
    public function setOtrasCaracteristicas($otrasCaracteristicas)
    {
        $this->otrasCaracteristicas = $otrasCaracteristicas;
    
        return $this;
    }

    /**
     * Get otrasCaracteristicas
     *
     * @return string 
     */
    public function getOtrasCaracteristicas()
    {
        return $this->otrasCaracteristicas;
    }

    /**
     * Set proyectorPantallaSala
     *
     * @param boolean $proyectorPantallaSala
     * @return Espacio
     */
    public function setProyectorPantallaSala($proyectorPantallaSala)
    {
        $this->proyectorPantallaSala = $proyectorPantallaSala;
    
        return $this;
    }

    /**
     * Get proyectorPantallaSala
     *
     * @return boolean 
     */
    public function getProyectorPantallaSala()
    {
        return $this->proyectorPantallaSala;
    }

    /**
     * Set microfonoAltavoces
     *
     * @param boolean $microfonoAltavoces
     * @return Espacio
     */
    public function setMicrofonoAltavoces($microfonoAltavoces)
    {
        $this->microfonoAltavoces = $microfonoAltavoces;
    
        return $this;
    }

    /**
     * Get microfonoAltavoces
     *
     * @return boolean 
     */
    public function getMicrofonoAltavoces()
    {
        return $this->microfonoAltavoces;
    }

    /**
     * Set videocamara
     *
     * @param boolean $videocamara
     * @return Espacio
     */
    public function setVideocamara($videocamara)
    {
        $this->videocamara = $videocamara;
    
        return $this;
    }

    /**
     * Get videocamara
     *
     * @return boolean 
     */
    public function getVideocamara()
    {
        return $this->videocamara;
    }

    /**
     * Set wifi
     *
     * @param boolean $wifi
     * @return Espacio
     */
    public function setWifi($wifi)
    {
        $this->wifi = $wifi;
    
        return $this;
    }

    /**
     * Get wifi
     *
     * @return boolean 
     */
    public function getWifi()
    {
        return $this->wifi;
    }

    /**
     * Set internetCable
     *
     * @param boolean $internetCable
     * @return Espacio
     */
    public function setInternetCable($internetCable)
    {
        $this->internetCable = $internetCable;
    
        return $this;
    }

    /**
     * Get internetCable
     *
     * @return boolean 
     */
    public function getInternetCable()
    {
        return $this->internetCable;
    }

    /**
     * Set maquinaBebidas
     *
     * @param boolean $maquinaBebidas
     * @return Espacio
     */
    public function setMaquinaBebidas($maquinaBebidas)
    {
        $this->maquinaBebidas = $maquinaBebidas;
    
        return $this;
    }

    /**
     * Get maquinaBebidas
     *
     * @return boolean 
     */
    public function getMaquinaBebidas()
    {
        return $this->maquinaBebidas;
    }

    /**
     * Set pizarra
     *
     * @param boolean $pizarra
     * @return Espacio
     */
    public function setPizarra($pizarra)
    {
        $this->pizarra = $pizarra;
    
        return $this;
    }

    /**
     * Get pizarra
     *
     * @return boolean 
     */
    public function getPizarra()
    {
        return $this->pizarra;
    }

    /**
     * Set conserjeria
     *
     * @param boolean $conserjeria
     * @return Espacio
     */
    public function setConserjeria($conserjeria)
    {
        $this->conserjeria = $conserjeria;
    
        return $this;
    }

    /**
     * Get conserjeria
     *
     * @return boolean 
     */
    public function getConserjeria()
    {
        return $this->conserjeria;
    }

    /**
     * Set aireAcondicionado
     *
     * @param boolean $aireAcondicionado
     * @return Espacio
     */
    public function setAireAcondicionado($aireAcondicionado)
    {
        $this->aireAcondicionado = $aireAcondicionado;
    
        return $this;
    }

    /**
     * Get aireAcondicionado
     *
     * @return boolean 
     */
    public function getAireAcondicionado()
    {
        return $this->aireAcondicionado;
    }

    /**
     * Set calefaccion
     *
     * @param boolean $calefaccion
     * @return Espacio
     */
    public function setCalefaccion($calefaccion)
    {
        $this->calefaccion = $calefaccion;
    
        return $this;
    }

    /**
     * Get calefaccion
     *
     * @return boolean 
     */
    public function getCalefaccion()
    {
        return $this->calefaccion;
    }

    /**
     * Set otrosServicios
     *
     * @param string $otrosServicios
     * @return Espacio
     */
    public function setOtrosServicios($otrosServicios)
    {
        $this->otrosServicios = $otrosServicios;
    
        return $this;
    }

    /**
     * Get otrosServicios
     *
     * @return string 
     */
    public function getOtrosServicios()
    {
        return $this->otrosServicios;
    }

    /**
     * Set aceptacionReservaAutomatica
     *
     * @param boolean $aceptacionReservaAutomatica
     * @return Espacio
     */
    public function setAceptacionReservaAutomatica($aceptacionReservaAutomatica)
    {
        $this->aceptacionReservaAutomatica = $aceptacionReservaAutomatica;
    
        return $this;
    }

    /**
     * Get aceptacionReservaAutomatica
     *
     * @return boolean 
     */
    public function getAceptacionReservaAutomatica()
    {
        return $this->aceptacionReservaAutomatica;
    }

    /**
     * Set tiempoMaximoAceptacionReservaAutomatica24h
     *
     * @param boolean $tiempoMaximoAceptacionReservaAutomatica24h
     * @return Espacio
     */
    public function setTiempoMaximoAceptacionReservaAutomatica24h($tiempoMaximoAceptacionReservaAutomatica24h)
    {
        $this->tiempoMaximoAceptacionReservaAutomatica24h = $tiempoMaximoAceptacionReservaAutomatica24h;
    
        return $this;
    }

    /**
     * Get tiempoMaximoAceptacionReservaAutomatica24h
     *
     * @return boolean 
     */
    public function getTiempoMaximoAceptacionReservaAutomatica24h()
    {
        return $this->tiempoMaximoAceptacionReservaAutomatica24h;
    }

    /**
     * Set tiempoMaximoAceptacionReservaAutomatica48
     *
     * @param boolean $tiempoMaximoAceptacionReservaAutomatica48
     * @return Espacio
     */
    public function setTiempoMaximoAceptacionReservaAutomatica48($tiempoMaximoAceptacionReservaAutomatica48)
    {
        $this->tiempoMaximoAceptacionReservaAutomatica48 = $tiempoMaximoAceptacionReservaAutomatica48;
    
        return $this;
    }

    /**
     * Get tiempoMaximoAceptacionReservaAutomatica48
     *
     * @return boolean 
     */
    public function getTiempoMaximoAceptacionReservaAutomatica48()
    {
        return $this->tiempoMaximoAceptacionReservaAutomatica48;
    }

    /**
     * Set datosFacturacionPagoDelUsuario
     *
     * @param boolean $datosFacturacionPagoDelUsuario
     * @return Espacio
     */
    public function setDatosFacturacionPagoDelUsuario($datosFacturacionPagoDelUsuario)
    {
        $this->datosFacturacionPagoDelUsuario = $datosFacturacionPagoDelUsuario;
    
        return $this;
    }

    /**
     * Get datosFacturacionPagoDelUsuario
     *
     * @return boolean 
     */
    public function getDatosFacturacionPagoDelUsuario()
    {
        return $this->datosFacturacionPagoDelUsuario;
    }

    /**
     * Set anadirDatosFacturacionPago
     *
     * @param boolean $anadirDatosFacturacionPago
     * @return Espacio
     */
    public function setAnadirDatosFacturacionPago($anadirDatosFacturacionPago)
    {
        $this->anadirDatosFacturacionPago = $anadirDatosFacturacionPago;
    
        return $this;
    }

    /**
     * Get anadirDatosFacturacionPago
     *
     * @return boolean 
     */
    public function getAnadirDatosFacturacionPago()
    {
        return $this->anadirDatosFacturacionPago;
    }

    /**
     * Set todas
     *
     * @param boolean $todas
     * @return Espacio
     */
    public function setTodas($todas)
    {
        $this->todas = $todas;
    
        return $this;
    }

    /**
     * Get todas
     *
     * @return boolean 
     */
    public function getTodas()
    {
        return $this->todas;
    }

    /**
     * Set similaresCentroRealiza
     *
     * @param boolean $similaresCentroRealiza
     * @return Espacio
     */
    public function setSimilaresCentroRealiza($similaresCentroRealiza)
    {
        $this->similaresCentroRealiza = $similaresCentroRealiza;
    
        return $this;
    }

    /**
     * Get similaresCentroRealiza
     *
     * @return boolean 
     */
    public function getSimilaresCentroRealiza()
    {
        return $this->similaresCentroRealiza;
    }

    /**
     * Set formacionTeorica
     *
     * @param boolean $formacionTeorica
     * @return Espacio
     */
    public function setFormacionTeorica($formacionTeorica)
    {
        $this->formacionTeorica = $formacionTeorica;
    
        return $this;
    }

    /**
     * Get formacionTeorica
     *
     * @return boolean 
     */
    public function getFormacionTeorica()
    {
        return $this->formacionTeorica;
    }

    /**
     * Set formacionInformatica
     *
     * @param boolean $formacionInformatica
     * @return Espacio
     */
    public function setFormacionInformatica($formacionInformatica)
    {
        $this->formacionInformatica = $formacionInformatica;
    
        return $this;
    }

    /**
     * Get formacionInformatica
     *
     * @return boolean 
     */
    public function getFormacionInformatica()
    {
        return $this->formacionInformatica;
    }

    /**
     * Set formacionTaller
     *
     * @param boolean $formacionTaller
     * @return Espacio
     */
    public function setFormacionTaller($formacionTaller)
    {
        $this->formacionTaller = $formacionTaller;
    
        return $this;
    }

    /**
     * Get formacionTaller
     *
     * @return boolean 
     */
    public function getFormacionTaller()
    {
        return $this->formacionTaller;
    }

    /**
     * Set exposicion
     *
     * @param boolean $exposicion
     * @return Espacio
     */
    public function setExposicion($exposicion)
    {
        $this->exposicion = $exposicion;
    
        return $this;
    }

    /**
     * Get exposicion
     *
     * @return boolean 
     */
    public function getExposicion()
    {
        return $this->exposicion;
    }

    /**
     * Set ventaFeria
     *
     * @param boolean $ventaFeria
     * @return Espacio
     */
    public function setVentaFeria($ventaFeria)
    {
        $this->ventaFeria = $ventaFeria;
    
        return $this;
    }

    /**
     * Get ventaFeria
     *
     * @return boolean 
     */
    public function getVentaFeria()
    {
        return $this->ventaFeria;
    }

    /**
     * Set deporte
     *
     * @param boolean $deporte
     * @return Espacio
     */
    public function setDeporte($deporte)
    {
        $this->deporte = $deporte;
    
        return $this;
    }

    /**
     * Get deporte
     *
     * @return boolean 
     */
    public function getDeporte()
    {
        return $this->deporte;
    }

    /**
     * Set espectaculo
     *
     * @param boolean $espectaculo
     * @return Espacio
     */
    public function setEspectaculo($espectaculo)
    {
        $this->espectaculo = $espectaculo;
    
        return $this;
    }

    /**
     * Get espectaculo
     *
     * @return boolean 
     */
    public function getEspectaculo()
    {
        return $this->espectaculo;
    }

    /**
     * Set reunionAsamblea
     *
     * @param boolean $reunionAsamblea
     * @return Espacio
     */
    public function setReunionAsamblea($reunionAsamblea)
    {
        $this->reunionAsamblea = $reunionAsamblea;
    
        return $this;
    }

    /**
     * Get reunionAsamblea
     *
     * @return boolean 
     */
    public function getReunionAsamblea()
    {
        return $this->reunionAsamblea;
    }

    /**
     * Set boda
     *
     * @param boolean $boda
     * @return Espacio
     */
    public function setBoda($boda)
    {
        $this->boda = $boda;
    
        return $this;
    }

    /**
     * Get boda
     *
     * @return boolean 
     */
    public function getBoda()
    {
        return $this->boda;
    }

    /**
     * Set fiesta
     *
     * @param boolean $fiesta
     * @return Espacio
     */
    public function setFiesta($fiesta)
    {
        $this->fiesta = $fiesta;
    
        return $this;
    }

    /**
     * Get fiesta
     *
     * @return boolean 
     */
    public function getFiesta()
    {
        return $this->fiesta;
    }

    /**
     * Set aceptoCondicionesUsoPoliticaPrivacidad
     *
     * @param boolean $aceptoCondicionesUsoPoliticaPrivacidad
     * @return Espacio
     */
    public function setAceptoCondicionesUsoPoliticaPrivacidad($aceptoCondicionesUsoPoliticaPrivacidad)
    {
        $this->aceptoCondicionesUsoPoliticaPrivacidad = $aceptoCondicionesUsoPoliticaPrivacidad;
    
        return $this;
    }

    /**
     * Get aceptoCondicionesUsoPoliticaPrivacidad
     *
     * @return boolean 
     */
    public function getAceptoCondicionesUsoPoliticaPrivacidad()
    {
        return $this->aceptoCondicionesUsoPoliticaPrivacidad;
    }

    /**
     * Set jardineria
     *
     * @param boolean $jardineria
     * @return Espacio
     */
    public function setJardineria($jardineria)
    {
        $this->jardineria = $jardineria;
    
        return $this;
    }

    /**
     * Get jardineria
     *
     * @return boolean 
     */
    public function getJardineria()
    {
        return $this->jardineria;
    }

    /**
     * Set precioPorHora
     *
     * @param float $precioPorHora
     * @return Espacio
     */
    public function setPrecioPorHora($precioPorHora)
    {
        $this->precioPorHora = $precioPorHora;
    
        return $this;
    }

    /**
     * Get precioPorHora
     *
     * @return float 
     */
    public function getPrecioPorHora()
    {
        return $this->precioPorHora;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Espacio
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set localidad
     *
     * @param \Proyecto\PrincipalBundle\Entity\Localidad $localidad
     * @return Espacio
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
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->getFile()) {
            // do whatever you want to generate a unique name
            $filename = sha1(uniqid(mt_rand(), true));
            $this->path = $filename.'.'.$this->getFile()->guessExtension();
        }
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        if (null === $this->getFile()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFile()->move($this->getUploadRootDir(), $this->path);

        // check if we have an old image
        if (isset($this->temp)) {
            // delete the old image
            unlink($this->getUploadRootDir().'/'.$this->temp);
            // clear the temp image path
            $this->temp = null;
        }
        $this->file = null;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        if ($file = $this->getAbsolutePath()) {
            unlink($file);
        }
    }
    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile() {
        return $this -> file;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : $this->getUploadDir().'/'.$this->path;
    }

    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/espacios';
    }







    /**
     * Set destacado
     *
     * @param boolean $destacado
     * @return Espacio
     */
    public function setDestacado($destacado)
    {
        $this->destacado = $destacado;
    
        return $this;
    }

    /**
     * Get destacado
     *
     * @return boolean 
     */
    public function getDestacado()
    {
        return $this->destacado;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return Espacio
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    /**
     * Get estado
     *
     * @return boolean 
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * Set suspendido
     *
     * @param boolean $suspendido
     * @return Espacio
     */
    public function setSuspendido($suspendido)
    {
        $this->suspendido = $suspendido;

        return $this;
    }

    /**
     * Get suspendido
     *
     * @return boolean 
     */
    public function getSuspendido()
    {
        return $this->suspendido;
    }

    /**
     * Set pilaresSueltos
     *
     * @param boolean $pilaresSueltos
     * @return Espacio
     */
    public function setPilaresSueltos($pilaresSueltos)
    {
        $this->pilaresSueltos = $pilaresSueltos;

        return $this;
    }

    /**
     * Get pilaresSueltos
     *
     * @return boolean 
     */
    public function getPilaresSueltos()
    {
        return $this->pilaresSueltos;
    }

    /**
     * Set entradaAseosMovilidadReducida
     *
     * @param boolean $entradaAseosMovilidadReducida
     * @return Espacio
     */
    public function setEntradaAseosMovilidadReducida($entradaAseosMovilidadReducida)
    {
        $this->entradaAseosMovilidadReducida = $entradaAseosMovilidadReducida;

        return $this;
    }

    /**
     * Get entradaAseosMovilidadReducida
     *
     * @return boolean 
     */
    public function getEntradaAseosMovilidadReducida()
    {
        return $this->entradaAseosMovilidadReducida;
    }

    /**
     * Set ventanasExterior
     *
     * @param boolean $ventanasExterior
     * @return Espacio
     */
    public function setVentanasExterior($ventanasExterior)
    {
        $this->ventanasExterior = $ventanasExterior;

        return $this;
    }

    /**
     * Get ventanasExterior
     *
     * @return boolean 
     */
    public function getVentanasExterior()
    {
        return $this->ventanasExterior;
    }

    /**
     * Set ventanasPatioInterior
     *
     * @param boolean $ventanasPatioInterior
     * @return Espacio
     */
    public function setVentanasPatioInterior($ventanasPatioInterior)
    {
        $this->ventanasPatioInterior = $ventanasPatioInterior;

        return $this;
    }

    /**
     * Get ventanasPatioInterior
     *
     * @return boolean 
     */
    public function getVentanasPatioInterior()
    {
        return $this->ventanasPatioInterior;
    }

    /**
     * Set posibilidadOscurecerSala
     *
     * @param boolean $posibilidadOscurecerSala
     * @return Espacio
     */
    public function setPosibilidadOscurecerSala($posibilidadOscurecerSala)
    {
        $this->posibilidadOscurecerSala = $posibilidadOscurecerSala;

        return $this;
    }

    /**
     * Get posibilidadOscurecerSala
     *
     * @return boolean 
     */
    public function getPosibilidadOscurecerSala()
    {
        return $this->posibilidadOscurecerSala;
    }

    /**
     * Set sede
     *
     * @param \Proyecto\PrincipalBundle\Entity\Sede $sede
     * @return Espacio
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
     * Set user
     *
     * @param \Proyecto\UserBundle\Entity\User $user
     * @return Espacio
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
