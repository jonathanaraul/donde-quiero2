<?php

namespace Proyecto\PrincipalBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Evento
 *
 * @ORM\Table(name="evento")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity
 */
class Evento
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
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaInicio", type="time", nullable=false)
     */
    private $horaInicio;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="horaFinalizacion", type="time", nullable=false)
     */
    private $horaFinalizacion;


    /**
     * @ORM\Column(type="string", length=60, nullable=false)
     */
    private $nombre;

     /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    public $duracionTotal;

     /**
     * @ORM\Column(type="text")
     */
    public $descripcionGeneral;  

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $enlaceVideo;

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
     * @ORM\Column(name="esPrivado", type="boolean", nullable=true)
     */
    private $esPrivado;

   /**
     * @ORM\Column(name="esGratuito", type="boolean", nullable=true)
     */
    private $esGratuito;

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
     * @ORM\Column(name="precio",type="float", nullable=false)
     */
    private $precio;

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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * Set duracionTotal
     *
     * @param string $duracionTotal
     * @return Evento
     */
    public function setDuracionTotal($duracionTotal)
    {
        $this->duracionTotal = $duracionTotal;
    
        return $this;
    }

    /**
     * Get duracionTotal
     *
     * @return string 
     */
    public function getDuracionTotal()
    {
        return $this->duracionTotal;
    }

    /**
     * Set descripcionGeneral
     *
     * @param string $descripcionGeneral
     * @return Evento
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
     * @return Evento
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
     * Set aceptacionReservaAutomatica
     *
     * @param boolean $aceptacionReservaAutomatica
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * Set formacionTeorica
     *
     * @param boolean $formacionTeorica
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * Set aceptoCondicionesUsoPoliticaPrivacidad
     *
     * @param boolean $aceptoCondicionesUsoPoliticaPrivacidad
     * @return Evento
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
     * Set precio
     *
     * @param float $precio
     * @return Evento
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;
    
        return $this;
    }

    /**
     * Get precio
     *
     * @return float 
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Evento
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
     * @return Evento
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
        return 'uploads/eventos';
    }



    /**
     * Set destacado
     *
     * @param boolean $destacado
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * Set fecha
     *
     * @param \DateTime $fecha
     * @return Evento
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha
     *
     * @return \DateTime 
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set horaInicio
     *
     * @param \DateTime $horaInicio
     * @return Evento
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio
     *
     * @return \DateTime 
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFinalizacion
     *
     * @param \DateTime $horaFinalizacion
     * @return Evento
     */
    public function setHoraFinalizacion($horaFinalizacion)
    {
        $this->horaFinalizacion = $horaFinalizacion;

        return $this;
    }

    /**
     * Get horaFinalizacion
     *
     * @return \DateTime 
     */
    public function getHoraFinalizacion()
    {
        return $this->horaFinalizacion;
    }

    /**
     * Set esGratuito
     *
     * @param boolean $esGratuito
     * @return Evento
     */
    public function setEsGratuito($esGratuito)
    {
        $this->esGratuito = $esGratuito;

        return $this;
    }

    /**
     * Get esGratuito
     *
     * @return boolean 
     */
    public function getEsGratuito()
    {
        return $this->esGratuito;
    }

    /**
     * Set modoAula
     *
     * @param boolean $modoAula
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * @return Evento
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
     * Set esPrivado
     *
     * @param boolean $esPrivado
     * @return Evento
     */
    public function setEsPrivado($esPrivado)
    {
        $this->esPrivado = $esPrivado;

        return $this;
    }

    /**
     * Get esPrivado
     *
     * @return boolean 
     */
    public function getEsPrivado()
    {
        return $this->esPrivado;
    }



    /**
     * Set espacio
     *
     * @param \Proyecto\PrincipalBundle\Entity\Espacio $espacio
     * @return Evento
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
     * Set user
     *
     * @param \Proyecto\UserBundle\Entity\User $user
     * @return Evento
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
