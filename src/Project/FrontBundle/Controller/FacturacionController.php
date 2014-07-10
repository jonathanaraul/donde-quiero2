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
use Project\UserBundle\Entity\User;
use Project\BackBundle\Entity\Provincia;
use Project\BackBundle\Entity\Localidad;
use Project\BackBundle\Entity\Facturacion;


class FacturacionController extends Controller {

	public function indexAction(Request $request) {
		
		$user = UtilitiesAPI::getActiveUser($this);
		$id = $user->getId();
		$url = $this -> generateUrl('project_front_perfil_facturacion');

		return FacturacionController::procesar($id ,$url,$user, $request,$this);
	}

	public static function procesar($id ,$url,$user,Request $request,$class) {


		$object = $class -> getDoctrine() -> getRepository('ProjectBackBundle:Facturacion') -> findOneByUser($id);
		if($object==null)$id=null;
		else $id=$object->getId();

		if($id == null )$object = new Facturacion();
        $localidad =  $class -> getDoctrine() -> getRepository('ProjectBackBundle:Localidad') -> find($user->getIdLocalidad());

		$object->setLocalidad($localidad);
		
		$idProvinciaDefecto = $localidad->getProvincia()->getId();
		$idLocalidadDefecto= $localidad->getId();
		$firstArray = UtilitiesAPI::getDefaultContent($class);
		$secondArray = array();

		$em = $class->getDoctrine()->getManager();
		$query = $em->createQuery(
		    'SELECT p.id,p.nombre
		    FROM ProjectBackBundle:Provincia p
		    ORDER BY p.nombre ASC'
		);
		$provincias = $query->getResult();

        $form = $class->createFormBuilder($object)
            ->add('empresa', 'text')
            ->add('identificador', 'text')
            ->add('direccion', 'textarea')
            ->add('localidad', 'entity', array(
			    'class' => 'ProjectBackBundle:Localidad',
			    'property' => 'nombre',
			    'query_builder' => function(EntityRepository $er)use ( $idProvinciaDefecto ) {


			        return $er->createQueryBuilder('u')
			            ->add('where', 'u.provincia = ?1')
			            ->orderBy('u.nombre', 'ASC')
			            ->setParameter(1, $idProvinciaDefecto); 
			    },
			))
			->add('aceptoTerminos', 'checkbox',array('required'  => true))
            ->getForm();
			


	    if ($request->isMethod('POST')) {

        	$form->bind($request);
        	

        	if ($form->isValid()) {

	        	$em = $class->getDoctrine()->getManager();

				$object -> setUser($user);

				if($id == null) {$object -> setFechaRegistro(new \DateTime());
    			$em->persist($object);}
    			$em->flush();

    			 return  $class->redirect($class->generateUrl('project_front_perfil_privado'));
	        }
	        	
	    }

        $secondArray = array('form' => $form->createView(),'url'=>$url,'provincias'=>$provincias,'idProvinciaDefecto'=>$idProvinciaDefecto);
		$array = array_merge($firstArray, $secondArray);
		return $class -> render('ProjectFrontBundle:Default:facturacion.html.twig', $array);
	}
	
	
}
