<?php

namespace Proyecto\PrincipalBundle\Controller;

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


class UsersController extends Controller {
	
	public function buscarCiudadAction() {
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		$provincia = intval($post -> get("valor"));
		echo'la provincia es'.$provincia;exit;
		
		$em = $this->getDoctrine()->getManager();
		$query = $em->createQuery(
		    'SELECT p.id,p.nombre
		    FROM ProyectoPrincipalBundle:Localidad p
		    WHERE p.provincia = :provincia
		    ORDER BY p.nombre ASC'
		)->setParameter('provincia', $provincia);

		$elementos = $query->getResult();

        $arreglo = array();

        for ($i=0; $i < count($elementos) ; $i++) { 

             $arreglo[$elementos[$i]['id']] = $elementos[$i]['nombre'];
            # code...
        }


        //$htmlElementos = $this -> renderView('ProjectUserBundle:Default:elementos.html.twig', array('elementos'=>$elementos ));
        
        $respuesta = new response(json_encode(array('elementos' => $arreglo)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
	}
	public function registroAction(Request $request) {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();
		$marketing = array( 
						   '1' => 'Mediante un buscador',
						   '2'  => 'Por un enlace en otra Web', 
						   '3'  => 'Ha recibido publicidad', 
						   '4'  => 'Mediante carteles', 
						   '5'  => 'Por un amigo/conocido', 
						   '6'  => 'Otro' 
						   );
		$localidad = array();
	    // crear un objeto usuario
        $object = new User();

        $form = $this->createFormBuilder($object)
            ->add('email', 'email')
            ->add('nombre', 'text')
            ->add('apellido', 'text')
            ->add('telefono', 'text')
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('password', 'password')
            ->add('descripcion', 'textarea')
            ->add('pais', 'text')
            ->add('provincia', 'entity', array(
			    'class' => 'ProyectoPrincipalBundle:Provincia',
			    'property' => 'nombre',
			    'query_builder' => function(EntityRepository $er) {
			        return $er->createQueryBuilder('u')
			            ->orderBy('u.nombre', 'ASC');
			    },
			))
            ->add('localidad', 'entity', array(
			    'class' => 'ProyectoPrincipalBundle:Localidad',
			    'property' => 'nombre',
			    'query_builder' => function(EntityRepository $er) {
			        return $er->createQueryBuilder('u')
			            ->add('where', 'u.provincia = ?1')
			            ->orderBy('u.nombre', 'ASC')
			            ->setParameter(1, 1); // Sustituye ?1 por 100
			    },
			))
            ->add('marketing', 'choice', array('choices'   => $marketing,'required'  => true))
            ->add('eventos', 'checkbox',array('required'  => false))
            -> add('file','file') 
            ->getForm();


	    if ($request->isMethod('POST')) {

        	$form->bind($request);

        	if ($form->isValid()) {


	        	$em = $this->getDoctrine()->getManager();
	        	$factory = $this -> get('security.encoder_factory');
	        	$encoder  = $factory -> getEncoder($object);
				$password = $encoder -> encodePassword($object   -> getPassword(), $object -> getSalt());
				$object -> setPassword($password);

				$object -> setNombre(strtolower($object -> getNombre()));
				$object -> setApellido(strtolower($object -> getApellido()));
				$object -> setEmail(strtolower($object -> getEmail()));
				$object -> setFechaRegistro(new \DateTime());
    			$em->persist($object);
    			$em->flush();

    			$titulo = '¡Registro completado...!';
    			$mensaje = 'Estimado(a) '.ucfirst($object ->getNombre()) . ' '.ucfirst($object ->getApellido()) .' su registro en DONDE-QUIERO, ha sido completado con éxito, lo invitamos a iniciar sesión con su nueva cuenta.';
    			$tituloBoton = 'Iniciar sesión';
    			$direccionBoton = $this->generateUrl('proyecto_principal_acceso');
    			$array = array('titulo' => $titulo, 'mensaje' => $mensaje, 'tituloBoton'=>$tituloBoton, 'direccionBoton'=>$direccionBoton );

    			return $this -> render('ProyectoPrincipalBundle:Default:mensaje.html.twig', $array);
	        }
	    }

        $secondArray = array('form' => $form->createView());
		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:registro.html.twig', $array);
	}
	public function accesoAction() {

		$error = NULL;
		$ultimo_nombreusuario = null;

		$peticion = $this -> getRequest();
		$sesion = $peticion -> getSession();
		// obtiene el error de inicio de sesión si lo hay
		if ($peticion -> attributes -> has(SecurityContext::AUTHENTICATION_ERROR))
			$error = $peticion -> attributes -> get(SecurityContext::AUTHENTICATION_ERROR);
		else
			$error = $sesion -> get(SecurityContext::AUTHENTICATION_ERROR);

		$firstArray = array();//UtilitiesAPI::getDefaultContent('Acceso', 'Ingrese su nombre de usuario y su contraseña', $this);
		$secondArray = array('ultimo_nombreusuario' => $sesion -> get(SecurityContext::LAST_USERNAME), 'error' => $error);

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:acceso.html.twig', $array);


	}
	public function registroConAjaxAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:registro-con-ajax.html.twig', $array);
	}

	public function cuentaGuardarAction() {
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;

		$arreglo = $peticion->request->all();
		$usuario = trim($post -> get("usuario"));

		UtilitiesAPI::procesaUsuario($arreglo, $this);
		$texto = 'Bienvenido '.$usuario.' ya puede ingresar al sistema';

		$respuesta = new response(json_encode(array('estado' => true, 'texto'=>$texto)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
}
