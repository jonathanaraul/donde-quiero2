<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Servicio
 *
 * @ORM\Table(name="servicio")
 * @ORM\Entity(repositoryClass="Proyecto\PrincipalBundle\Entity\ServicioRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Servicio
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
     * @ORM\Column(name="ofrecidosTodos", type="boolean", nullable=true)
     */
    private $ofrecidosTodos;
    /**
     * @ORM\Column(name="sedePropiosEventos", type="boolean", nullable=true)
     */
    private $sedePropiosEventos;
    /**
     * @ORM\Column(name="empresaEventosOtros", type="boolean", nullable=true)
     */
    private $empresaEventosOtros;
    /**
     * @ORM\Column(name="todosMultimedia", type="boolean", nullable=true)
     */
    


    private $todosMultimedia;
    /**
     * @ORM\Column(name="grabacionEdicionVideo", type="boolean", nullable=true)
     */
    private $grabacionEdicionVideo;
    /**
     * @ORM\Column(name="fotografoEvento", type="boolean", nullable=true)
     */
    private $fotografoEvento;
    /**
     * @ORM\Column(name="alquilerCamaras", type="boolean", nullable=true)
     */
    private $alquilerCamaras;
    /**
     * @ORM\Column(name="alquilerPortatiles", type="boolean", nullable=true)
     */
    private $alquilerPortatiles;
    /**
     * @ORM\Column(name="alquilerProyectoresPantallas", type="boolean", nullable=true)
     */
    private $alquilerProyectoresPantallas;
    /**
     * @ORM\Column(name="sonidoMicrofonoAltavoces", type="boolean", nullable=true)
     */
    private $sonidoMicrofonoAltavoces;
    /**
     * @ORM\Column(name="iluminacion", type="boolean", nullable=true)
     */
    private $iluminacion;



    /**
     * @ORM\Column(name="todosMejoraEspacios", type="boolean", nullable=true)
     */
    private $todosMejoraEspacios;
    /**
     * @ORM\Column(name="decoracionAccesorios", type="boolean", nullable=true)
     */
    private $decoracionAccesorios;
    /**
     * @ORM\Column(name="floristeria", type="boolean", nullable=true)
     */
    private $floristeria;
    /**
     * @ORM\Column(name="disenioExposicionesTemporales", type="boolean", nullable=true)
     */
    private $disenioExposicionesTemporales;
    /**
     * @ORM\Column(name="montajeExposicion", type="boolean", nullable=true)
     */
    private $montajeExposicion;
    /**
     * @ORM\Column(name="escenografia", type="boolean", nullable=true)
     */
    private $escenografia;
    /**
     * @ORM\Column(name="rehabilitacionArquitectnica", type="boolean", nullable=true)
     */
    private $rehabilitacionArquitectnica;
    /**
     * @ORM\Column(name="limpiezaNormalIntensivo", type="boolean", nullable=true)
     */
    private $limpiezaNormalIntensivo;
    /**
     * @ORM\Column(name="seguros", type="boolean", nullable=true)
     */
    private $seguros;




    /**
     * @ORM\Column(name="todosMejoradeContenidos", type="boolean", nullable=true)
     */
    private $todosMejoradeContenidos;
    /**
     * @ORM\Column(name="impresionGrabacionDocs", type="boolean", nullable=true)
     */
    private $impresionGrabacionDocs;
    /**
     * @ORM\Column(name="transporteMercancias", type="boolean", nullable=true)
     */
    private $transporteMercancias;
    /**
     * @ORM\Column(name="envios", type="boolean", nullable=true)
     */
    private $envios;
    /**
     * @ORM\Column(name="mobiliarioAulaTallerRecepcion", type="boolean", nullable=true)
     */
    private $mobiliarioAulaTallerRecepcion;
    /**
     * @ORM\Column(name="accesoriosFormacionPizarras", type="boolean", nullable=true)
     */
    private $accesoriosFormacionPizarras;
    /**
     * @ORM\Column(name="papeleriaNormalCorporativa", type="boolean", nullable=true)
     */
    private $papeleriaNormalCorporativa;
    /**
     * @ORM\Column(name="internetCable", type="boolean", nullable=true)
     */
    private $internetCable;
    /**
     * @ORM\Column(name="internetWifiContenidos", type="boolean", nullable=true)
     */
    private $internetWifiContenidos;
    /**
     * @ORM\Column(name="animacion", type="boolean", nullable=true)
     */
    private $animacion;
    /**
     * @ORM\Column(name="interpretacionMusical", type="boolean", nullable=true)
     */
    private $interpretacionMusical;
    /**
     * @ORM\Column(name="interpretacionTeatral", type="boolean", nullable=true)
     */
    private $interpretacionTeatral;




    /**
     * @ORM\Column(name="todosServicioAsistentes", type="boolean", nullable=true)
     */
    private $todosServicioAsistentes;
    /**
     * @ORM\Column(name="catering", type="boolean", nullable=true)
     */
    private $catering;
    /**
     * @ORM\Column(name="azafatas", type="boolean", nullable=true)
     */
    private $azafatas;
    /**
     * @ORM\Column(name="recepcionista", type="boolean", nullable=true)
     */
    private $recepcionista;
    /**
     * @ORM\Column(name="traduccion", type="boolean", nullable=true)
     */
    private $traduccion;
    /**
     * @ORM\Column(name="interpretes", type="boolean", nullable=true)
     */
    private $interpretes;
    /**
     * @ORM\Column(name="receptoresAuricularEscucharInterprete", type="boolean", nullable=true)
     */
    private $receptoresAuricularEscucharInterprete;
    /**
     * @ORM\Column(name="alojamiento", type="boolean", nullable=true)
     */
    private $alojamiento;
     /**
     * @ORM\Column(name="internetWifiAsistentes", type="boolean", nullable=true)
     */
    private $internetWifiAsistentes;
    /**
     * @ORM\Column(name="viaje", type="boolean", nullable=true)
     */
    private $viaje;
    /**
     * @ORM\Column(name="transporteLocalAsistentes", type="boolean", nullable=true)
     */
    private $transporteLocalAsistentes;
    /**
     * @ORM\Column(name="guiaAcompanianteAsistentes", type="boolean", nullable=true)
     */
    private $guiaAcompanianteAsistentes; 


    /**
     * @ORM\Column(name="todosImagenCorporativa", type="boolean", nullable=true)
     */
    private $todosImagenCorporativa;
     /**
     * @ORM\Column(name="logosDocsCorporativos", type="boolean", nullable=true)
     */
    private $logosDocsCorporativos;
    /**
     * @ORM\Column(name="webEventoSede", type="boolean", nullable=true)
     */
    private $webEventoSede;
    /**
     * @ORM\Column(name="impresionGrabacion", type="boolean", nullable=true)
     */
    private $impresionGrabacion;
    /**
     * @ORM\Column(name="repartoPublicitario", type="boolean", nullable=true)
     */
    private $repartoPublicitario;
    /**
     * @ORM\Column(name="posicionamiento", type="boolean", nullable=true)
     */
    private $posicionamiento;
     /**
     * @ORM\Column(name="communityManagement", type="boolean", nullable=true)
     */
    private $communityManagement;
    /**
     * @ORM\Column(name="difusionInternet", type="boolean", nullable=true)
     */
    private $difusionInternet;
    /**
     * @ORM\Column(name="difusionOtrosMedios", type="boolean", nullable=true)
     */
    private $difusionOtrosMedios;
    /**
     * @ORM\Column(name="emisionOnlinePaginaEvento", type="boolean", nullable=true)
     */
    private $emisionOnlinePaginaEvento;

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
     * @ORM\Column(name="estado", type="boolean", nullable=false)
     */
    private $estado;
    /**
     * @ORM\Column(name="suspendido", type="boolean", nullable=false)
     */
    private $suspendido;

    /**
     * @ORM\Column(name="destacado", type="boolean", nullable=true)
     */
    private $destacado;
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * Set ofrecidosTodos
     *
     * @param boolean $ofrecidosTodos
     * @return Servicio
     */
    public function setOfrecidosTodos($ofrecidosTodos)
    {
        $this->ofrecidosTodos = $ofrecidosTodos;
    
        return $this;
    }

    /**
     * Get ofrecidosTodos
     *
     * @return boolean 
     */
    public function getOfrecidosTodos()
    {
        return $this->ofrecidosTodos;
    }

    /**
     * Set sedePropiosEventos
     *
     * @param boolean $sedePropiosEventos
     * @return Servicio
     */
    public function setSedePropiosEventos($sedePropiosEventos)
    {
        $this->sedePropiosEventos = $sedePropiosEventos;
    
        return $this;
    }

    /**
     * Get sedePropiosEventos
     *
     * @return boolean 
     */
    public function getSedePropiosEventos()
    {
        return $this->sedePropiosEventos;
    }

    /**
     * Set empresaEventosOtros
     *
     * @param boolean $empresaEventosOtros
     * @return Servicio
     */
    public function setEmpresaEventosOtros($empresaEventosOtros)
    {
        $this->empresaEventosOtros = $empresaEventosOtros;
    
        return $this;
    }

    /**
     * Get empresaEventosOtros
     *
     * @return boolean 
     */
    public function getEmpresaEventosOtros()
    {
        return $this->empresaEventosOtros;
    }

    /**
     * Set todosMultimedia
     *
     * @param boolean $todosMultimedia
     * @return Servicio
     */
    public function setTodosMultimedia($todosMultimedia)
    {
        $this->todosMultimedia = $todosMultimedia;
    
        return $this;
    }

    /**
     * Get todosMultimedia
     *
     * @return boolean 
     */
    public function getTodosMultimedia()
    {
        return $this->todosMultimedia;
    }

    /**
     * Set grabacionEdicionVideo
     *
     * @param boolean $grabacionEdicionVideo
     * @return Servicio
     */
    public function setGrabacionEdicionVideo($grabacionEdicionVideo)
    {
        $this->grabacionEdicionVideo = $grabacionEdicionVideo;
    
        return $this;
    }

    /**
     * Get grabacionEdicionVideo
     *
     * @return boolean 
     */
    public function getGrabacionEdicionVideo()
    {
        return $this->grabacionEdicionVideo;
    }

    /**
     * Set fotografoEvento
     *
     * @param boolean $fotografoEvento
     * @return Servicio
     */
    public function setFotografoEvento($fotografoEvento)
    {
        $this->fotografoEvento = $fotografoEvento;
    
        return $this;
    }

    /**
     * Get fotografoEvento
     *
     * @return boolean 
     */
    public function getFotografoEvento()
    {
        return $this->fotografoEvento;
    }

    /**
     * Set alquilerCamaras
     *
     * @param boolean $alquilerCamaras
     * @return Servicio
     */
    public function setAlquilerCamaras($alquilerCamaras)
    {
        $this->alquilerCamaras = $alquilerCamaras;
    
        return $this;
    }

    /**
     * Get alquilerCamaras
     *
     * @return boolean 
     */
    public function getAlquilerCamaras()
    {
        return $this->alquilerCamaras;
    }

    /**
     * Set alquilerPortatiles
     *
     * @param boolean $alquilerPortatiles
     * @return Servicio
     */
    public function setAlquilerPortatiles($alquilerPortatiles)
    {
        $this->alquilerPortatiles = $alquilerPortatiles;
    
        return $this;
    }

    /**
     * Get alquilerPortatiles
     *
     * @return boolean 
     */
    public function getAlquilerPortatiles()
    {
        return $this->alquilerPortatiles;
    }

    /**
     * Set alquilerProyectoresPantallas
     *
     * @param boolean $alquilerProyectoresPantallas
     * @return Servicio
     */
    public function setAlquilerProyectoresPantallas($alquilerProyectoresPantallas)
    {
        $this->alquilerProyectoresPantallas = $alquilerProyectoresPantallas;
    
        return $this;
    }

    /**
     * Get alquilerProyectoresPantallas
     *
     * @return boolean 
     */
    public function getAlquilerProyectoresPantallas()
    {
        return $this->alquilerProyectoresPantallas;
    }

    /**
     * Set sonidoMicrofonoAltavoces
     *
     * @param boolean $sonidoMicrofonoAltavoces
     * @return Servicio
     */
    public function setSonidoMicrofonoAltavoces($sonidoMicrofonoAltavoces)
    {
        $this->sonidoMicrofonoAltavoces = $sonidoMicrofonoAltavoces;
    
        return $this;
    }

    /**
     * Get sonidoMicrofonoAltavoces
     *
     * @return boolean 
     */
    public function getSonidoMicrofonoAltavoces()
    {
        return $this->sonidoMicrofonoAltavoces;
    }

    /**
     * Set iluminacion
     *
     * @param boolean $iluminacion
     * @return Servicio
     */
    public function setIluminacion($iluminacion)
    {
        $this->iluminacion = $iluminacion;
    
        return $this;
    }

    /**
     * Get iluminacion
     *
     * @return boolean 
     */
    public function getIluminacion()
    {
        return $this->iluminacion;
    }

    /**
     * Set todosMejoraEspacios
     *
     * @param boolean $todosMejoraEspacios
     * @return Servicio
     */
    public function setTodosMejoraEspacios($todosMejoraEspacios)
    {
        $this->todosMejoraEspacios = $todosMejoraEspacios;
    
        return $this;
    }

    /**
     * Get todosMejoraEspacios
     *
     * @return boolean 
     */
    public function getTodosMejoraEspacios()
    {
        return $this->todosMejoraEspacios;
    }

    /**
     * Set decoracionAccesorios
     *
     * @param boolean $decoracionAccesorios
     * @return Servicio
     */
    public function setDecoracionAccesorios($decoracionAccesorios)
    {
        $this->decoracionAccesorios = $decoracionAccesorios;
    
        return $this;
    }

    /**
     * Get decoracionAccesorios
     *
     * @return boolean 
     */
    public function getDecoracionAccesorios()
    {
        return $this->decoracionAccesorios;
    }

    /**
     * Set floristeria
     *
     * @param boolean $floristeria
     * @return Servicio
     */
    public function setFloristeria($floristeria)
    {
        $this->floristeria = $floristeria;
    
        return $this;
    }

    /**
     * Get floristeria
     *
     * @return boolean 
     */
    public function getFloristeria()
    {
        return $this->floristeria;
    }

    /**
     * Set disenioExposicionesTemporales
     *
     * @param boolean $disenioExposicionesTemporales
     * @return Servicio
     */
    public function setDisenioExposicionesTemporales($disenioExposicionesTemporales)
    {
        $this->disenioExposicionesTemporales = $disenioExposicionesTemporales;
    
        return $this;
    }

    /**
     * Get disenioExposicionesTemporales
     *
     * @return boolean 
     */
    public function getDisenioExposicionesTemporales()
    {
        return $this->disenioExposicionesTemporales;
    }

    /**
     * Set montajeExposicion
     *
     * @param boolean $montajeExposicion
     * @return Servicio
     */
    public function setMontajeExposicion($montajeExposicion)
    {
        $this->montajeExposicion = $montajeExposicion;
    
        return $this;
    }

    /**
     * Get montajeExposicion
     *
     * @return boolean 
     */
    public function getMontajeExposicion()
    {
        return $this->montajeExposicion;
    }

    /**
     * Set escenografia
     *
     * @param boolean $escenografia
     * @return Servicio
     */
    public function setEscenografia($escenografia)
    {
        $this->escenografia = $escenografia;
    
        return $this;
    }

    /**
     * Get escenografia
     *
     * @return boolean 
     */
    public function getEscenografia()
    {
        return $this->escenografia;
    }

    /**
     * Set rehabilitacionArquitectnica
     *
     * @param boolean $rehabilitacionArquitectnica
     * @return Servicio
     */
    public function setRehabilitacionArquitectnica($rehabilitacionArquitectnica)
    {
        $this->rehabilitacionArquitectnica = $rehabilitacionArquitectnica;
    
        return $this;
    }

    /**
     * Get rehabilitacionArquitectnica
     *
     * @return boolean 
     */
    public function getRehabilitacionArquitectnica()
    {
        return $this->rehabilitacionArquitectnica;
    }

    /**
     * Set limpiezaNormalIntensivo
     *
     * @param boolean $limpiezaNormalIntensivo
     * @return Servicio
     */
    public function setLimpiezaNormalIntensivo($limpiezaNormalIntensivo)
    {
        $this->limpiezaNormalIntensivo = $limpiezaNormalIntensivo;
    
        return $this;
    }

    /**
     * Get limpiezaNormalIntensivo
     *
     * @return boolean 
     */
    public function getLimpiezaNormalIntensivo()
    {
        return $this->limpiezaNormalIntensivo;
    }

    /**
     * Set seguros
     *
     * @param boolean $seguros
     * @return Servicio
     */
    public function setSeguros($seguros)
    {
        $this->seguros = $seguros;
    
        return $this;
    }

    /**
     * Get seguros
     *
     * @return boolean 
     */
    public function getSeguros()
    {
        return $this->seguros;
    }

    /**
     * Set todosMejoradeContenidos
     *
     * @param boolean $todosMejoradeContenidos
     * @return Servicio
     */
    public function setTodosMejoradeContenidos($todosMejoradeContenidos)
    {
        $this->todosMejoradeContenidos = $todosMejoradeContenidos;
    
        return $this;
    }

    /**
     * Get todosMejoradeContenidos
     *
     * @return boolean 
     */
    public function getTodosMejoradeContenidos()
    {
        return $this->todosMejoradeContenidos;
    }

    /**
     * Set impresionGrabacionDocs
     *
     * @param boolean $impresionGrabacionDocs
     * @return Servicio
     */
    public function setImpresionGrabacionDocs($impresionGrabacionDocs)
    {
        $this->impresionGrabacionDocs = $impresionGrabacionDocs;
    
        return $this;
    }

    /**
     * Get impresionGrabacionDocs
     *
     * @return boolean 
     */
    public function getImpresionGrabacionDocs()
    {
        return $this->impresionGrabacionDocs;
    }

    /**
     * Set transporteMercancias
     *
     * @param boolean $transporteMercancias
     * @return Servicio
     */
    public function setTransporteMercancias($transporteMercancias)
    {
        $this->transporteMercancias = $transporteMercancias;
    
        return $this;
    }

    /**
     * Get transporteMercancias
     *
     * @return boolean 
     */
    public function getTransporteMercancias()
    {
        return $this->transporteMercancias;
    }

    /**
     * Set envios
     *
     * @param boolean $envios
     * @return Servicio
     */
    public function setEnvios($envios)
    {
        $this->envios = $envios;
    
        return $this;
    }

    /**
     * Get envios
     *
     * @return boolean 
     */
    public function getEnvios()
    {
        return $this->envios;
    }

    /**
     * Set mobiliarioAulaTallerRecepcion
     *
     * @param boolean $mobiliarioAulaTallerRecepcion
     * @return Servicio
     */
    public function setMobiliarioAulaTallerRecepcion($mobiliarioAulaTallerRecepcion)
    {
        $this->mobiliarioAulaTallerRecepcion = $mobiliarioAulaTallerRecepcion;
    
        return $this;
    }

    /**
     * Get mobiliarioAulaTallerRecepcion
     *
     * @return boolean 
     */
    public function getMobiliarioAulaTallerRecepcion()
    {
        return $this->mobiliarioAulaTallerRecepcion;
    }

    /**
     * Set accesoriosFormacionPizarras
     *
     * @param boolean $accesoriosFormacionPizarras
     * @return Servicio
     */
    public function setAccesoriosFormacionPizarras($accesoriosFormacionPizarras)
    {
        $this->accesoriosFormacionPizarras = $accesoriosFormacionPizarras;
    
        return $this;
    }

    /**
     * Get accesoriosFormacionPizarras
     *
     * @return boolean 
     */
    public function getAccesoriosFormacionPizarras()
    {
        return $this->accesoriosFormacionPizarras;
    }

    /**
     * Set papeleriaNormalCorporativa
     *
     * @param boolean $papeleriaNormalCorporativa
     * @return Servicio
     */
    public function setPapeleriaNormalCorporativa($papeleriaNormalCorporativa)
    {
        $this->papeleriaNormalCorporativa = $papeleriaNormalCorporativa;
    
        return $this;
    }

    /**
     * Get papeleriaNormalCorporativa
     *
     * @return boolean 
     */
    public function getPapeleriaNormalCorporativa()
    {
        return $this->papeleriaNormalCorporativa;
    }

    /**
     * Set internetCable
     *
     * @param boolean $internetCable
     * @return Servicio
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
     * Set internetWifiContenidos
     *
     * @param boolean $internetWifiContenidos
     * @return Servicio
     */
    public function setInternetWifiContenidos($internetWifiContenidos)
    {
        $this->internetWifiContenidos = $internetWifiContenidos;
    
        return $this;
    }

    /**
     * Get internetWifiContenidos
     *
     * @return boolean 
     */
    public function getInternetWifiContenidos()
    {
        return $this->internetWifiContenidos;
    }

    /**
     * Set animacion
     *
     * @param boolean $animacion
     * @return Servicio
     */
    public function setAnimacion($animacion)
    {
        $this->animacion = $animacion;
    
        return $this;
    }

    /**
     * Get animacion
     *
     * @return boolean 
     */
    public function getAnimacion()
    {
        return $this->animacion;
    }


    /**
     * Set interpretacionMusical
     *
     * @param boolean $interpretacionMusical
     * @return Servicio
     */
    public function setInterpretacionMusical($interpretacionMusical)
    {
        $this->interpretacionMusical = $interpretacionMusical;
    
        return $this;
    }

    /**
     * Get interpretacionMusical
     *
     * @return boolean 
     */
    public function getInterpretacionMusical()
    {
        return $this->interpretacionMusical;
    }

    /**
     * Set interpretacionTeatral
     *
     * @param boolean $interpretacionTeatral
     * @return Servicio
     */
    public function setInterpretacionTeatral($interpretacionTeatral)
    {
        $this->interpretacionTeatral = $interpretacionTeatral;
    
        return $this;
    }

    /**
     * Get interpretacionTeatral
     *
     * @return boolean 
     */
    public function getInterpretacionTeatral()
    {
        return $this->interpretacionTeatral;
    }

    /**
     * Set todosServicioAsistentes
     *
     * @param boolean $todosServicioAsistentes
     * @return Servicio
     */
    public function setTodosServicioAsistentes($todosServicioAsistentes)
    {
        $this->todosServicioAsistentes = $todosServicioAsistentes;
    
        return $this;
    }

    /**
     * Get todosServicioAsistentes
     *
     * @return boolean 
     */
    public function getTodosServicioAsistentes()
    {
        return $this->todosServicioAsistentes;
    }

    /**
     * Set catering
     *
     * @param boolean $catering
     * @return Servicio
     */
    public function setCatering($catering)
    {
        $this->catering = $catering;
    
        return $this;
    }

    /**
     * Get catering
     *
     * @return boolean 
     */
    public function getCatering()
    {
        return $this->catering;
    }

    /**
     * Set azafatas
     *
     * @param boolean $azafatas
     * @return Servicio
     */
    public function setAzafatas($azafatas)
    {
        $this->azafatas = $azafatas;
    
        return $this;
    }

    /**
     * Get azafatas
     *
     * @return boolean 
     */
    public function getAzafatas()
    {
        return $this->azafatas;
    }

    /**
     * Set recepcionista
     *
     * @param boolean $recepcionista
     * @return Servicio
     */
    public function setRecepcionista($recepcionista)
    {
        $this->recepcionista = $recepcionista;
    
        return $this;
    }

    /**
     * Get recepcionista
     *
     * @return boolean 
     */
    public function getRecepcionista()
    {
        return $this->recepcionista;
    }

    /**
     * Set traduccion
     *
     * @param boolean $traduccion
     * @return Servicio
     */
    public function setTraduccion($traduccion)
    {
        $this->traduccion = $traduccion;
    
        return $this;
    }

    /**
     * Get traduccion
     *
     * @return boolean 
     */
    public function getTraduccion()
    {
        return $this->traduccion;
    }

    /**
     * Set interpretes
     *
     * @param boolean $interpretes
     * @return Servicio
     */
    public function setInterpretes($interpretes)
    {
        $this->interpretes = $interpretes;
    
        return $this;
    }

    /**
     * Get interpretes
     *
     * @return boolean 
     */
    public function getInterpretes()
    {
        return $this->interpretes;
    }

    /**
     * Set receptoresAuricularEscucharInterprete
     *
     * @param boolean $receptoresAuricularEscucharInterprete
     * @return Servicio
     */
    public function setReceptoresAuricularEscucharInterprete($receptoresAuricularEscucharInterprete)
    {
        $this->receptoresAuricularEscucharInterprete = $receptoresAuricularEscucharInterprete;
    
        return $this;
    }

    /**
     * Get receptoresAuricularEscucharInterprete
     *
     * @return boolean 
     */
    public function getReceptoresAuricularEscucharInterprete()
    {
        return $this->receptoresAuricularEscucharInterprete;
    }

    /**
     * Set aceptacionReservaAutomatica
     *
     * @param boolean $aceptacionReservaAutomatica
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
        return 'uploads/servicios';
    }



    /**
     * Set alojamiento
     *
     * @param boolean $alojamiento
     * @return Servicio
     */
    public function setAlojamiento($alojamiento)
    {
        $this->alojamiento = $alojamiento;
    
        return $this;
    }

    /**
     * Get alojamiento
     *
     * @return boolean 
     */
    public function getAlojamiento()
    {
        return $this->alojamiento;
    }

    /**
     * Set internetWifiAsistentes
     *
     * @param boolean $internetWifiAsistentes
     * @return Servicio
     */
    public function setInternetWifiAsistentes($internetWifiAsistentes)
    {
        $this->internetWifiAsistentes = $internetWifiAsistentes;
    
        return $this;
    }

    /**
     * Get internetWifiAsistentes
     *
     * @return boolean 
     */
    public function getInternetWifiAsistentes()
    {
        return $this->internetWifiAsistentes;
    }

    /**
     * Set viaje
     *
     * @param boolean $viaje
     * @return Servicio
     */
    public function setViaje($viaje)
    {
        $this->viaje = $viaje;
    
        return $this;
    }

    /**
     * Get viaje
     *
     * @return boolean 
     */
    public function getViaje()
    {
        return $this->viaje;
    }

    /**
     * Set transporteLocalAsistentes
     *
     * @param boolean $transporteLocalAsistentes
     * @return Servicio
     */
    public function setTransporteLocalAsistentes($transporteLocalAsistentes)
    {
        $this->transporteLocalAsistentes = $transporteLocalAsistentes;
    
        return $this;
    }

    /**
     * Get transporteLocalAsistentes
     *
     * @return boolean 
     */
    public function getTransporteLocalAsistentes()
    {
        return $this->transporteLocalAsistentes;
    }

    /**
     * Set guiaAcompanianteAsistentes
     *
     * @param boolean $guiaAcompanianteAsistentes
     * @return Servicio
     */
    public function setGuiaAcompanianteAsistentes($guiaAcompanianteAsistentes)
    {
        $this->guiaAcompanianteAsistentes = $guiaAcompanianteAsistentes;
    
        return $this;
    }

    /**
     * Get guiaAcompanianteAsistentes
     *
     * @return boolean 
     */
    public function getGuiaAcompanianteAsistentes()
    {
        return $this->guiaAcompanianteAsistentes;
    }

    /**
     * Set todosImagenCorporativa
     *
     * @param boolean $todosImagenCorporativa
     * @return Servicio
     */
    public function setTodosImagenCorporativa($todosImagenCorporativa)
    {
        $this->todosImagenCorporativa = $todosImagenCorporativa;
    
        return $this;
    }

    /**
     * Get todosImagenCorporativa
     *
     * @return boolean 
     */
    public function getTodosImagenCorporativa()
    {
        return $this->todosImagenCorporativa;
    }

    /**
     * Set logosDocsCorporativos
     *
     * @param boolean $logosDocsCorporativos
     * @return Servicio
     */
    public function setLogosDocsCorporativos($logosDocsCorporativos)
    {
        $this->logosDocsCorporativos = $logosDocsCorporativos;
    
        return $this;
    }

    /**
     * Get logosDocsCorporativos
     *
     * @return boolean 
     */
    public function getLogosDocsCorporativos()
    {
        return $this->logosDocsCorporativos;
    }

    /**
     * Set webEventoSede
     *
     * @param boolean $webEventoSede
     * @return Servicio
     */
    public function setWebEventoSede($webEventoSede)
    {
        $this->webEventoSede = $webEventoSede;
    
        return $this;
    }

    /**
     * Get webEventoSede
     *
     * @return boolean 
     */
    public function getWebEventoSede()
    {
        return $this->webEventoSede;
    }

    /**
     * Set impresionGrabacion
     *
     * @param boolean $impresionGrabacion
     * @return Servicio
     */
    public function setImpresionGrabacion($impresionGrabacion)
    {
        $this->impresionGrabacion = $impresionGrabacion;
    
        return $this;
    }

    /**
     * Get impresionGrabacion
     *
     * @return boolean 
     */
    public function getImpresionGrabacion()
    {
        return $this->impresionGrabacion;
    }

    /**
     * Set repartoPublicitario
     *
     * @param boolean $repartoPublicitario
     * @return Servicio
     */
    public function setRepartoPublicitario($repartoPublicitario)
    {
        $this->repartoPublicitario = $repartoPublicitario;
    
        return $this;
    }

    /**
     * Get repartoPublicitario
     *
     * @return boolean 
     */
    public function getRepartoPublicitario()
    {
        return $this->repartoPublicitario;
    }

    /**
     * Set posicionamiento
     *
     * @param boolean $posicionamiento
     * @return Servicio
     */
    public function setPosicionamiento($posicionamiento)
    {
        $this->posicionamiento = $posicionamiento;
    
        return $this;
    }

    /**
     * Get posicionamiento
     *
     * @return boolean 
     */
    public function getPosicionamiento()
    {
        return $this->posicionamiento;
    }

    /**
     * Set communityManagement
     *
     * @param boolean $communityManagement
     * @return Servicio
     */
    public function setCommunityManagement($communityManagement)
    {
        $this->communityManagement = $communityManagement;
    
        return $this;
    }

    /**
     * Get communityManagement
     *
     * @return boolean 
     */
    public function getCommunityManagement()
    {
        return $this->communityManagement;
    }

    /**
     * Set difusionInternet
     *
     * @param boolean $difusionInternet
     * @return Servicio
     */
    public function setDifusionInternet($difusionInternet)
    {
        $this->difusionInternet = $difusionInternet;
    
        return $this;
    }

    /**
     * Get difusionInternet
     *
     * @return boolean 
     */
    public function getDifusionInternet()
    {
        return $this->difusionInternet;
    }

    /**
     * Set difusionOtrosMedios
     *
     * @param boolean $difusionOtrosMedios
     * @return Servicio
     */
    public function setDifusionOtrosMedios($difusionOtrosMedios)
    {
        $this->difusionOtrosMedios = $difusionOtrosMedios;
    
        return $this;
    }

    /**
     * Get difusionOtrosMedios
     *
     * @return boolean 
     */
    public function getDifusionOtrosMedios()
    {
        return $this->difusionOtrosMedios;
    }

    /**
     * Set emisionOnlinePaginaEvento
     *
     * @param boolean $emisionOnlinePaginaEvento
     * @return Servicio
     */
    public function setEmisionOnlinePaginaEvento($emisionOnlinePaginaEvento)
    {
        $this->emisionOnlinePaginaEvento = $emisionOnlinePaginaEvento;
    
        return $this;
    }

    /**
     * Get emisionOnlinePaginaEvento
     *
     * @return boolean 
     */
    public function getEmisionOnlinePaginaEvento()
    {
        return $this->emisionOnlinePaginaEvento;
    }

    /**
     * Set destacado
     *
     * @param boolean $destacado
     * @return Servicio
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
     * @return Servicio
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
     * @return Servicio
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
     * Set user
     *
     * @param \Proyecto\UserBundle\Entity\User $user
     * @return Servicio
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
