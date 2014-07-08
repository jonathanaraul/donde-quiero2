<?php

namespace Project\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityRepository;

use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Proyecto\PrincipalBundle\Entity\User;
use Proyecto\PrincipalBundle\Entity\Provincia;
use Proyecto\PrincipalBundle\Entity\Localidad;
use Proyecto\PrincipalBundle\Entity\Retiro;


class PerfilController extends Controller {
	public static $parametro =0;

	public function privadoAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$user = UtilitiesAPI::getActiveUser($this);
		$facturacion =  $this -> getDoctrine() -> getRepository('ProjectBackBundle:Facturacion') -> findOneByUser($user);
		$retiro =  $this -> getDoctrine() -> getRepository('ProjectBackBundle:Retiro') -> findOneByUser($user);
        $localidad =  $this -> getDoctrine() -> getRepository('ProjectBackBundle:Localidad') -> find($user->getIdLocalidad());

        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();

        $dql =  'SELECT o1
                 FROM ProjectBackBundle:Reserva o1, 
                      ProjectUserBundle:User o2
                 WHERE 
                       o1.user = o2.id AND
                       o2.id = :idUser 
                 ORDER BY o1.id desc
                       ';

        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $idUser);
        $query->setMaxResults(3);
        $reservas = $query->getResult();



        $dql =  'SELECT o1
                 FROM ProjectBackBundle:Reserva o1, 
                      ProjectUserBundle:User o2
                 WHERE 
                       o1.espacio  IN (SELECT s1.id FROM ProjectBackBundle:Espacio  s1,  ProjectUserBundle:User s2  WHERE s1.user = s2.id and s2.id = :idUser)
                    or o1.evento   IN (SELECT e1.id FROM ProjectBackBundle:Evento   e1,  ProjectUserBundle:User e2  WHERE e1.user = e2.id and e2.id = :idUser)
                    or o1.servicio IN (SELECT d1.id FROM ProjectBackBundle:Servicio d1,  ProjectUserBundle:User d2  WHERE d1.user = d2.id and d2.id = :idUser)
                    
                 ORDER BY o1.id desc
                       ';

        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $idUser);
        $notificaciones = $query->getResult();
        $auxiliar = array();
        if($notificaciones!=null){
          for ($i=0; $i < 3 ; $i++) { 
            $auxiliar[$i] = $notificaciones[$i];
                                    }
        $notificaciones = $auxiliar;
        }


        //var_dump($notificaciones);exit;

		$secondArray = array('user'=>$user,'facturacion'=>$facturacion,'retiro'=>$retiro,'reservas'=>$reservas,'notificaciones'=>$notificaciones,'localidad'=>$localidad );

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectBackBundle:Perfil:privado.html.twig', $array);
	}
	public function notificacionesAction(){
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$user = UtilitiesAPI::getActiveUser($this);

        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();

        $dql =  'SELECT o1
                 FROM ProjectBackBundle:Reserva o1
                 WHERE 
                       o1.espacio  IN (SELECT s1.id FROM ProjectBackBundle:Espacio  s1,  ProjectUserBundle:User s2  WHERE s1.user = s2.id and s2.id = :idUser)
                    or o1.evento   IN (SELECT e1.id FROM ProjectBackBundle:Evento   e1,  ProjectUserBundle:User e2  WHERE e1.user = e2.id and e2.id = :idUser)
                    or o1.servicio IN (SELECT d1.id FROM ProjectBackBundle:Servicio d1,  ProjectUserBundle:User d2  WHERE d1.user = d2.id and d2.id = :idUser)
                    or o1.sede     IN (SELECT x1.id FROM ProjectBackBundle:Sede x1,  ProjectUserBundle:User x2  WHERE x1.user = x2.id and x2.id = :idUser)
                    and o1.fechaFin >= :fechaFin
                    
                 ORDER BY o1.fechaFin desc
                       ';

        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $idUser);
        $query->setParameter('fechaFin', UtilitiesAPI::obtenerFechaNormal2($this));

        $activas = $query->getResult();

        $dql =  'SELECT o1
                 FROM ProjectBackBundle:Reserva o1
                 WHERE 
                       o1.espacio  IN (SELECT s1.id FROM ProjectBackBundle:Espacio  s1,  ProjectUserBundle:User s2  WHERE s1.user = s2.id and s2.id = :idUser)
                    or o1.evento   IN (SELECT e1.id FROM ProjectBackBundle:Evento   e1,  ProjectUserBundle:User e2  WHERE e1.user = e2.id and e2.id = :idUser)
                    or o1.servicio IN (SELECT d1.id FROM ProjectBackBundle:Servicio d1,  ProjectUserBundle:User d2  WHERE d1.user = d2.id and d2.id = :idUser)
                    or o1.sede     IN (SELECT x1.id FROM ProjectBackBundle:Sede x1,  ProjectUserBundle:User x2  WHERE x1.user = x2.id and x2.id = :idUser)
                    and o1.fechaFin < :fechaFin
                    
                 ORDER BY o1.fechaFin desc
                       ';
        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $idUser);
        $query->setParameter('fechaFin', UtilitiesAPI::obtenerFechaNormal2($this));

        $pasadas = $query->getResult();

        $secondArray = array('activas'=>$activas,'pasadas'=>$pasadas,'user'=>$user);
        $secondArray['sedes']     = HelpersController::getSedes(true,false,$idUser,$this);//caso especial mapas javascript
		$array = array_merge($firstArray, $secondArray);
        return $this -> render('ProjectBackBundle:Perfil:notificaciones.html.twig', $array);
	}
	public function reservasAction(){
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$user = UtilitiesAPI::getActiveUser($this);

        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();

        $dql =  'SELECT o1
                 FROM ProjectBackBundle:Reserva o1, 
                      ProjectUserBundle:User o2
                 WHERE 
                       o1.user = o2.id AND
                       o2.id = :idUser AND
                       o1.fechaFin >= :fechaFin
                 ORDER BY o1.fechaFin desc
                       ';

        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $idUser);
        $query->setParameter('fechaFin', UtilitiesAPI::obtenerFechaNormal2($this));

        $activas = $query->getResult();

        $dql =  'SELECT o1
                 FROM ProjectBackBundle:Reserva o1, 
                      ProjectUserBundle:User o2
                 WHERE 
                       o1.user = o2.id AND
                       o2.id = :idUser AND
                       o1.fechaFin < :fechaFin
                 ORDER BY o1.fechaFin desc
                       ';

        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $idUser);
        $query->setParameter('fechaFin', UtilitiesAPI::obtenerFechaNormal2($this));

        $pasadas = $query->getResult();

        $secondArray = array('activas'=>$activas,'pasadas'=>$pasadas,'user'=>$user);
        $secondArray['sedes']     = HelpersController::getSedes(false,true,$idUser,$this);//caso especial mapas javascript
		$array = array_merge($firstArray, $secondArray);

		return $this -> render('ProjectBackBundle:Perfil:reservas.html.twig', $array);
	}
    public function notificacionReservaAction(){
        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;
        $em = $this->getDoctrine()->getManager();

        $tarea = trim($post -> get("tarea"));
        $id = intval($post -> get("id"));

        $object = $this -> getDoctrine() -> getRepository('ProjectBackBundle:Reserva') -> find($id);

        if($tarea=='aprobar'){
        $object -> setAprobado(true);
        }
        else if($tarea=='cancelar'){
        $object -> setCancelado(true);
        }
        else if($tarea=='borrar'){
        $object -> setOculto(true);
        }

        $em->persist($object);
        $em->flush();

        $respuesta = new response(json_encode(array('estado' => true)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }
	public function publicoAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$user = UtilitiesAPI::getActiveUser($this);
        $localidad =  $this -> getDoctrine() -> getRepository('ProjectBackBundle:Localidad') -> find($user->getIdLocalidad());
		$secondArray = array('user'=>$user,'localidad'=>$localidad);

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectBackBundle:Perfil:publico.html.twig', $array);
	}
	public function editarAction(Request $request) {

		$user = UtilitiesAPI::getActiveUser($this);
		$id = $user->getId();
		$url = $this -> generateUrl('proyecto_perfil_editar');

		return PerfilController::procesar($id ,$url,$request, $this);

	}
	public function crearCuentaAction(Request $request) {
		$id = null;
		$url = $this -> generateUrl('proyecto_perfil_crearcuenta');

		return PerfilController::procesar($id ,$url, $request,$this);
	}

	public static function procesar($id ,$url,Request $request,$class) {
		$accion = ''; 
        if($id == null ){
           $accion = 'nuevo'; 
           $object = new User();
                        }
		else{
           $object = $class -> getDoctrine() -> getRepository('ProjectUserBundle:User') -> find($id);
           $accion = 'editar'; 

        } 
		
		$firstArray = UtilitiesAPI::getDefaultContent($class);
		$secondArray = array();
		$marketing = array( 
						   '1' => 'Mediante un buscador',
						   '2'  => 'Por un enlace en otra Web', 
						   '3'  => 'Ha recibido publicidad', 
						   '4'  => 'Mediante carteles', 
						   '5'  => 'Por un amigo/conocido', 
						   '6'  => 'Otro' 
						   );
		

		$parametro =1;
		if($id != null)$parametro=$object->getProvincia()->getId();

        $form = $class->createFormBuilder($object)
            ->add('email', 'email')
            ->add('nombre', 'text')
            ->add('apellido', 'text')
            ->add('telefono', 'text')
            ->add('username', 'text')
            ->add('profesion', 'text')
            ->add('password', 'password')
            ->add('descripcion', 'textarea')
            ->add('pais', 'text')
            ->add('provincia', 'entity', array(
			    'class' => 'ProjectBackBundle:Provincia',
			    'property' => 'nombre',
			    'query_builder' => function(EntityRepository $er) {
			        return $er->createQueryBuilder('u')
			            ->orderBy('u.nombre', 'ASC');
			    },
			))
            ->add('localidad', 'entity', array(
			    'class' => 'ProjectBackBundle:Localidad',
			    'property' => 'nombre',
			    'query_builder' => function(EntityRepository $er)use ( $parametro ) {


			        return $er->createQueryBuilder('u')
			            ->add('where', 'u.provincia = ?1')
			            ->orderBy('u.nombre', 'ASC')
			            ->setParameter(1, $parametro); // Sustituye ?1 por 100
			    },
			))
            ->add('marketing', 'choice', array('choices'   => $marketing,'required'  => true))
            ->add('eventos', 'checkbox',array('required'  => false))
            -> add('file','file') 
            ->getForm();


	    if ($request->isMethod('POST')) {

        	$form->bind($request);

        	if ($form->isValid()) {


	        	$em = $class->getDoctrine()->getManager();
	        	$factory = $class -> get('security.encoder_factory');
	        	$encoder  = $factory -> getEncoder($object);
				$password = $encoder -> encodePassword($object   -> getPassword(), $object -> getSalt());
				$object -> setPassword($password);

				$object -> setNombre(strtolower($object -> getNombre()));
				$object -> setApellido(strtolower($object -> getApellido()));
				$object -> setEmail(strtolower($object -> getEmail()));
                $object -> setEstado(1);
                $object -> setRol(0);
				if($id == null) {$object -> setFechaRegistro(new \DateTime());
    			$em->persist($object);}
    			$em->flush();

    			if($id == null){
    				$titulo = '¡Registro completado...!';
    				$mensaje = 'Estimado(a) '.ucfirst($object ->getNombre()) . ' '.ucfirst($object ->getApellido()) .' su registro en DONDE-QUIERO, ha sido completado con éxito, lo invitamos a iniciar sesión con su nueva cuenta.';
    				$tituloBoton = 'Iniciar sesión';
    				$direccionBoton = $class->generateUrl('proyecto_principal_acceso');
    			}
    			else{
    				$titulo = '¡Perfil actualizado...!';
    				$mensaje = 'Estimado(a) '.ucfirst($object ->getNombre()) . ' '.ucfirst($object ->getApellido()) .' su perfil ha sido actualizado con éxito.';
    				$tituloBoton = 'Perfil privado';
    				$direccionBoton = $class->generateUrl('proyecto_perfil_privado');

    			}

    			$array = array('titulo' => $titulo, 'mensaje' => $mensaje, 'tituloBoton'=>$tituloBoton, 'direccionBoton'=>$direccionBoton );

    			return $class -> render('ProjectBackBundle:Default:mensaje.html.twig', $array);
	        }
	    }

        $secondArray = array('form' => $form->createView(),'url'=>$url,'accion'=> $accion);
		$array = array_merge($firstArray, $secondArray);
		return $class -> render('ProjectBackBundle:Default:registro.html.twig', $array);
	}
	
	public function enviarSolicitudBajaAction() {
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$em = $this->getDoctrine()->getManager();

		$razon = trim($post -> get("razon"));
		$user = UtilitiesAPI::getActiveUser($this);

		$object = new Retiro();

		$object -> setUser($user);
		$object -> setRazon($razon);
		$object -> setFechaRegistro(new \DateTime());
    	$em->persist($object);
    	$em->flush();

		$respuesta = new response(json_encode(array('estado' => true)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
	public function cancelarSolicitudBajaAction() {
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$em = $this->getDoctrine()->getManager();

		$user = UtilitiesAPI::getActiveUser($this);

		$object = $this-> getDoctrine() -> getRepository('ProjectBackBundle:Retiro') -> findOneByUser($user);
		$em = $this -> getDoctrine() -> getManager();
		$em->remove($object);
		$em->flush();

		$respuesta = new response(json_encode(array('estado' => true)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
}
