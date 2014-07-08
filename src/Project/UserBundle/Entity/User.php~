<?php
// src/Acme/UserBundle/Entity/User.php

namespace Project\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="El nombre es muy corto.",
     *     maxMessage="El nombre es muy largo.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="Please enter your name.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max="255",
     *     minMessage="El apellido es muy corto.",
     *     maxMessage="El apellido es muy largo.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $apellido;


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="Por favor ingrese su path de perfil", groups={"Registration", "Profile"})
     */
    public $path;

    /**
     * @Assert\File(maxSize="6000000",groups={"Registration", "Profile"})
     * @Assert\NotBlank(message="Por favor su imagen de perfil.", groups={"Registration", "Profile"})
     */
    private $file;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaRegistro", type="datetime", nullable=false)
     */
    private $fechaRegistro;

    /**
     * @ORM\Column(type="text")
     *
     * @Assert\NotBlank(message="Por favor ingrese su descripcion.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=0,
     *     max="1000",
     *     minMessage="Su descripcion es muy corta.",
     *     maxMessage="Su descripcion es muy larga.",
     *     groups={"Registration", "Profile"}
     * )
     */
    public $descripcion;
    /**
     * @var \Provincia
     * @Assert\NotBlank(message="Por favor espacifique su provincia.", groups={"Registration"})
     * @ORM\ManyToOne(targetEntity="\Project\BackBundle\Entity\Provincia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="provincia", referencedColumnName="id", nullable=false)
     * })
     */
    private $provincia;


    /**
     * @ORM\Column(type="integer", nullable=true)
     * @Assert\NotBlank(message="Por favor espacifique su localidad", groups={"Registration"})
     */
    private $idLocalidad;

    /**
     * @ORM\Column(name="aceptoCondiciones", type="boolean", nullable=true)
     */
    private $aceptoCondiciones;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $telefono;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $profesion;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     */
    private $pais;


    /**
     * @ORM\Column(type="integer", length=300, nullable=false)
     */
    private $marketing;

    /**
     * @ORM\Column(name="eventos", type="boolean", nullable=true)
     */
    private $eventos;


    private $temp;


    public function __construct()
    {
        parent::__construct();
        // your own logic
        $this -> setFechaRegistro(new \DateTime());
    }



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
     * @return User
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
     * Set apellido
     *
     * @param string $apellido
     * @return User
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;

        return $this;
    }

    /**
     * Get apellido
     *
     * @return string 
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return User
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
     * Set fechaRegistro
     *
     * @param \DateTime $fechaRegistro
     * @return User
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
     * Set descripcion
     *
     * @param string $descripcion
     * @return User
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set idLocalidad
     *
     * @param integer $idLocalidad
     * @return User
     */
    public function setIdLocalidad($idLocalidad)
    {
        $this->idLocalidad = $idLocalidad;

        return $this;
    }

    /**
     * Get idLocalidad
     *
     * @return integer 
     */
    public function getIdLocalidad()
    {
        return $this->idLocalidad;
    }

    /**
     * Set aceptoCondiciones
     *
     * @param boolean $aceptoCondiciones
     * @return User
     */
    public function setAceptoCondiciones($aceptoCondiciones)
    {
        $this->aceptoCondiciones = $aceptoCondiciones;

        return $this;
    }

    /**
     * Get aceptoCondiciones
     *
     * @return boolean 
     */
    public function getAceptoCondiciones()
    {
        return $this->aceptoCondiciones;
    }

    /**
     * Set telefono
     *
     * @param string $telefono
     * @return User
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string 
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * Set profesion
     *
     * @param string $profesion
     * @return User
     */
    public function setProfesion($profesion)
    {
        $this->profesion = $profesion;

        return $this;
    }

    /**
     * Get profesion
     *
     * @return string 
     */
    public function getProfesion()
    {
        return $this->profesion;
    }

    /**
     * Set pais
     *
     * @param string $pais
     * @return User
     */
    public function setPais($pais)
    {
        $this->pais = $pais;

        return $this;
    }

    /**
     * Get pais
     *
     * @return string 
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * Set marketing
     *
     * @param integer $marketing
     * @return User
     */
    public function setMarketing($marketing)
    {
        $this->marketing = $marketing;

        return $this;
    }

    /**
     * Get marketing
     *
     * @return integer 
     */
    public function getMarketing()
    {
        return $this->marketing;
    }

    /**
     * Set eventos
     *
     * @param boolean $eventos
     * @return User
     */
    public function setEventos($eventos)
    {
        $this->eventos = $eventos;

        return $this;
    }

    /**
     * Get eventos
     *
     * @return boolean 
     */
    public function getEventos()
    {
        return $this->eventos;
    }

    /**
     * Set estado
     *
     * @param boolean $estado
     * @return User
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }


    /**
     * Agrega un rol al usuario.
     * @throws Exception
     * @param Rol $rol 
     */
    public function addRole( $rol )
    {
    if($rol == 1) {
      array_push($this->roles, 'ROLE_ADMIN');
    }
    else if($rol == 2) {
      array_push($this->roles, 'ROLE_USER');
    }
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
        return 'uploads/users';
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
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
     * Set provincia
     *
     * @param \Project\BackBundle\Entity\Provincia $provincia
     * @return User
     */
    public function setProvincia(\Project\BackBundle\Entity\Provincia $provincia)
    {
        $this->provincia = $provincia;

        return $this;
    }

    /**
     * Get provincia
     *
     * @return \Project\BackBundle\Entity\Provincia 
     */
    public function getProvincia()
    {
        return $this->provincia;
    }
}
