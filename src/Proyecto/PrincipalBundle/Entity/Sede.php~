<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Sede
 *
 * @ORM\Table(name="sede")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Sede
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
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
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
     * @ORM\Column(name="latitud",type="float", nullable=false)
     */
    private $latitud;
    /**
     * @ORM\Column(name="longitud",type="float", nullable=false)
     */
    private $longitud;
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
     * @ORM\Column(name="enCentroCiudad", type="boolean", nullable=true)
     */
    private $enCentroCiudad;
    /**
     * @ORM\Column(name="cercaAutobus", type="boolean", nullable=true)
     */
    private $cercaAutobus;
    /**
     * @ORM\Column(name="cercaAeropuerto", type="boolean", nullable=true)
     */
    private $cercaAeropuerto;
    /**
     * @ORM\Column(name="accesibleMovilidadReducida", type="boolean", nullable=true)
     */
    private $accesibleMovilidadReducida;


    /**
     * @ORM\Column(name="colegioInstituto", type="boolean", nullable=true)
     */
    private $colegioInstituto;
    /**
     * @ORM\Column(name="universidad", type="boolean", nullable=true)
     */
    private $universidad;
    /**
     * @ORM\Column(name="otrosCentrosFormacion", type="boolean", nullable=true)
     */
    private $otrosCentrosFormacion;
    /**
     * @ORM\Column(name="coWorking", type="boolean", nullable=true)
     */
    private $coWorking;
    /**
     * @ORM\Column(name="centroNegocios", type="boolean", nullable=true)
     */
    private $centroNegocios;
    /**
     * @ORM\Column(name="oficinaProfesional", type="boolean", nullable=true)
     */
    private $oficinaProfesional;
    /**
     * @ORM\Column(name="hotel", type="boolean", nullable=true)
     */
    private $hotel;
    /**
     * @ORM\Column(name="restauranteBarDiscoteca", type="boolean", nullable=true)
     */
    private $restauranteBarDiscoteca;
    /**
     * @ORM\Column(name="finca", type="boolean", nullable=true)
     */
    private $finca;
    /**
     * @ORM\Column(name="colegioProfesional", type="boolean", nullable=true)
     */
    private $colegioProfesional;
    /**
     * @ORM\Column(name="fundacionCentroCultural", type="boolean", nullable=true)
     */
    private $fundacionCentroCultural;
    /**
     * @ORM\Column(name="clubPrivadoAsociacion", type="boolean", nullable=true)
     */
    private $clubPrivadoAsociacion;
    /**
     * @ORM\Column(name="cineTeatro", type="boolean", nullable=true)
     */
    private $cineTeatro;
    /**
     * @ORM\Column(name="centroDeportivo", type="boolean", nullable=true)
     */
    private $centroDeportivo;
    /**
     * @ORM\Column(name="centroFerial", type="boolean", nullable=true)
     */
    private $centroFerial;
    /**
     * @ORM\Column(name="centroRecreativo", type="boolean", nullable=true)
     */
    private $centroRecreativo;
    /**
     * @ORM\Column(name="centroComercial", type="boolean", nullable=true)
     */
    private $centroComercial;




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
     * @ORM\Column(name="aceptoCondicionesUsoPoliticaPrivacidad", type="boolean", nullable=false)
     */
    private $aceptoCondicionesUsoPoliticaPrivacidad;
    /**
     * @ORM\Column(name="precioPorHora",type="float", nullable=false)
     */
    private $precioPorHora;

    /**
     * @ORM\Column(name="destacado", type="boolean", nullable=true)
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * Set latitud
     *
     * @param float $latitud
     * @return Sede
     */
    public function setLatitud($latitud)
    {
        $this->latitud = $latitud;
    
        return $this;
    }

    /**
     * Get latitud
     *
     * @return float 
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * Set longitud
     *
     * @param float $longitud
     * @return Sede
     */
    public function setLongitud($longitud)
    {
        $this->longitud = $longitud;
    
        return $this;
    }

    /**
     * Get longitud
     *
     * @return float 
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * Set enCentroCiudad
     *
     * @param boolean $enCentroCiudad
     * @return Sede
     */
    public function setEnCentroCiudad($enCentroCiudad)
    {
        $this->enCentroCiudad = $enCentroCiudad;
    
        return $this;
    }

    /**
     * Get enCentroCiudad
     *
     * @return boolean 
     */
    public function getEnCentroCiudad()
    {
        return $this->enCentroCiudad;
    }

    /**
     * Set cercaAutobus
     *
     * @param boolean $cercaAutobus
     * @return Sede
     */
    public function setCercaAutobus($cercaAutobus)
    {
        $this->cercaAutobus = $cercaAutobus;
    
        return $this;
    }

    /**
     * Get cercaAutobus
     *
     * @return boolean 
     */
    public function getCercaAutobus()
    {
        return $this->cercaAutobus;
    }

    /**
     * Set cercaAeropuerto
     *
     * @param boolean $cercaAeropuerto
     * @return Sede
     */
    public function setCercaAeropuerto($cercaAeropuerto)
    {
        $this->cercaAeropuerto = $cercaAeropuerto;
    
        return $this;
    }

    /**
     * Get cercaAeropuerto
     *
     * @return boolean 
     */
    public function getCercaAeropuerto()
    {
        return $this->cercaAeropuerto;
    }

    /**
     * Set accesibleMovilidadReducida
     *
     * @param boolean $accesibleMovilidadReducida
     * @return Sede
     */
    public function setAccesibleMovilidadReducida($accesibleMovilidadReducida)
    {
        $this->accesibleMovilidadReducida = $accesibleMovilidadReducida;
    
        return $this;
    }

    /**
     * Get accesibleMovilidadReducida
     *
     * @return boolean 
     */
    public function getAccesibleMovilidadReducida()
    {
        return $this->accesibleMovilidadReducida;
    }

    /**
     * Set colegioInstituto
     *
     * @param boolean $colegioInstituto
     * @return Sede
     */
    public function setColegioInstituto($colegioInstituto)
    {
        $this->colegioInstituto = $colegioInstituto;
    
        return $this;
    }

    /**
     * Get colegioInstituto
     *
     * @return boolean 
     */
    public function getColegioInstituto()
    {
        return $this->colegioInstituto;
    }

    /**
     * Set universidad
     *
     * @param boolean $universidad
     * @return Sede
     */
    public function setUniversidad($universidad)
    {
        $this->universidad = $universidad;
    
        return $this;
    }

    /**
     * Get universidad
     *
     * @return boolean 
     */
    public function getUniversidad()
    {
        return $this->universidad;
    }

    /**
     * Set otrosCentrosFormacion
     *
     * @param boolean $otrosCentrosFormacion
     * @return Sede
     */
    public function setOtrosCentrosFormacion($otrosCentrosFormacion)
    {
        $this->otrosCentrosFormacion = $otrosCentrosFormacion;
    
        return $this;
    }

    /**
     * Get otrosCentrosFormacion
     *
     * @return boolean 
     */
    public function getOtrosCentrosFormacion()
    {
        return $this->otrosCentrosFormacion;
    }

    /**
     * Set coWorking
     *
     * @param boolean $coWorking
     * @return Sede
     */
    public function setCoWorking($coWorking)
    {
        $this->coWorking = $coWorking;
    
        return $this;
    }

    /**
     * Get coWorking
     *
     * @return boolean 
     */
    public function getCoWorking()
    {
        return $this->coWorking;
    }

    /**
     * Set centroNegocios
     *
     * @param boolean $centroNegocios
     * @return Sede
     */
    public function setCentroNegocios($centroNegocios)
    {
        $this->centroNegocios = $centroNegocios;
    
        return $this;
    }

    /**
     * Get centroNegocios
     *
     * @return boolean 
     */
    public function getCentroNegocios()
    {
        return $this->centroNegocios;
    }

    /**
     * Set oficinaProfesional
     *
     * @param boolean $oficinaProfesional
     * @return Sede
     */
    public function setOficinaProfesional($oficinaProfesional)
    {
        $this->oficinaProfesional = $oficinaProfesional;
    
        return $this;
    }

    /**
     * Get oficinaProfesional
     *
     * @return boolean 
     */
    public function getOficinaProfesional()
    {
        return $this->oficinaProfesional;
    }

    /**
     * Set hotel
     *
     * @param boolean $hotel
     * @return Sede
     */
    public function setHotel($hotel)
    {
        $this->hotel = $hotel;
    
        return $this;
    }

    /**
     * Get hotel
     *
     * @return boolean 
     */
    public function getHotel()
    {
        return $this->hotel;
    }

    /**
     * Set restauranteBarDiscoteca
     *
     * @param boolean $restauranteBarDiscoteca
     * @return Sede
     */
    public function setRestauranteBarDiscoteca($restauranteBarDiscoteca)
    {
        $this->restauranteBarDiscoteca = $restauranteBarDiscoteca;
    
        return $this;
    }

    /**
     * Get restauranteBarDiscoteca
     *
     * @return boolean 
     */
    public function getRestauranteBarDiscoteca()
    {
        return $this->restauranteBarDiscoteca;
    }

    /**
     * Set finca
     *
     * @param boolean $finca
     * @return Sede
     */
    public function setFinca($finca)
    {
        $this->finca = $finca;
    
        return $this;
    }

    /**
     * Get finca
     *
     * @return boolean 
     */
    public function getFinca()
    {
        return $this->finca;
    }

    /**
     * Set colegioProfesional
     *
     * @param boolean $colegioProfesional
     * @return Sede
     */
    public function setColegioProfesional($colegioProfesional)
    {
        $this->colegioProfesional = $colegioProfesional;
    
        return $this;
    }

    /**
     * Get colegioProfesional
     *
     * @return boolean 
     */
    public function getColegioProfesional()
    {
        return $this->colegioProfesional;
    }

    /**
     * Set fundacionCentroCultural
     *
     * @param boolean $fundacionCentroCultural
     * @return Sede
     */
    public function setFundacionCentroCultural($fundacionCentroCultural)
    {
        $this->fundacionCentroCultural = $fundacionCentroCultural;
    
        return $this;
    }

    /**
     * Get fundacionCentroCultural
     *
     * @return boolean 
     */
    public function getFundacionCentroCultural()
    {
        return $this->fundacionCentroCultural;
    }

    /**
     * Set clubPrivadoAsociacion
     *
     * @param boolean $clubPrivadoAsociacion
     * @return Sede
     */
    public function setClubPrivadoAsociacion($clubPrivadoAsociacion)
    {
        $this->clubPrivadoAsociacion = $clubPrivadoAsociacion;
    
        return $this;
    }

    /**
     * Get clubPrivadoAsociacion
     *
     * @return boolean 
     */
    public function getClubPrivadoAsociacion()
    {
        return $this->clubPrivadoAsociacion;
    }

    /**
     * Set cineTeatro
     *
     * @param boolean $cineTeatro
     * @return Sede
     */
    public function setCineTeatro($cineTeatro)
    {
        $this->cineTeatro = $cineTeatro;
    
        return $this;
    }

    /**
     * Get cineTeatro
     *
     * @return boolean 
     */
    public function getCineTeatro()
    {
        return $this->cineTeatro;
    }

    /**
     * Set centroDeportivo
     *
     * @param boolean $centroDeportivo
     * @return Sede
     */
    public function setCentroDeportivo($centroDeportivo)
    {
        $this->centroDeportivo = $centroDeportivo;
    
        return $this;
    }

    /**
     * Get centroDeportivo
     *
     * @return boolean 
     */
    public function getCentroDeportivo()
    {
        return $this->centroDeportivo;
    }

    /**
     * Set centroFerial
     *
     * @param boolean $centroFerial
     * @return Sede
     */
    public function setCentroFerial($centroFerial)
    {
        $this->centroFerial = $centroFerial;
    
        return $this;
    }

    /**
     * Get centroFerial
     *
     * @return boolean 
     */
    public function getCentroFerial()
    {
        return $this->centroFerial;
    }

    /**
     * Set centroRecreativo
     *
     * @param boolean $centroRecreativo
     * @return Sede
     */
    public function setCentroRecreativo($centroRecreativo)
    {
        $this->centroRecreativo = $centroRecreativo;
    
        return $this;
    }

    /**
     * Get centroRecreativo
     *
     * @return boolean 
     */
    public function getCentroRecreativo()
    {
        return $this->centroRecreativo;
    }

    /**
     * Set centroComercial
     *
     * @param boolean $centroComercial
     * @return Sede
     */
    public function setCentroComercial($centroComercial)
    {
        $this->centroComercial = $centroComercial;
    
        return $this;
    }

    /**
     * Get centroComercial
     *
     * @return boolean 
     */
    public function getCentroComercial()
    {
        return $this->centroComercial;
    }

    /**
     * Set modoAula
     *
     * @param boolean $modoAula
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * Set formacionTeorica
     *
     * @param boolean $formacionTeorica
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * Set jardineria
     *
     * @param boolean $jardineria
     * @return Sede
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
     * Set aceptacionReservaAutomatica
     *
     * @param boolean $aceptacionReservaAutomatica
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
     * Set aceptoCondicionesUsoPoliticaPrivacidad
     *
     * @param boolean $aceptoCondicionesUsoPoliticaPrivacidad
     * @return Sede
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
     * Set precioPorHora
     *
     * @param float $precioPorHora
     * @return Sede
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
     * @return Sede
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
     * Set user
     *
     * @param \Proyecto\PrincipalBundle\Entity\User $user
     * @return Sede
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
     * Set localidad
     *
     * @param \Proyecto\PrincipalBundle\Entity\Localidad $localidad
     * @return Sede
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
        return 'uploads/sedes';
    }



    /**
     * Set destacado
     *
     * @param boolean $destacado
     * @return Sede
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
     * @return Sede
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
     * @return Sede
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
}
