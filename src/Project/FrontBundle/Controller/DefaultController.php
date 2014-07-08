<?php

namespace Project\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller {

	public function direccionadorAction() {

        $userManager = $this->container->get('fos_user.user_manager');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $url = '';

        if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) $url = 'proyecto_perfil_privado';
		else $url = 'proyecto_principal_gestion';

		if($user->isEnabled()===false)$url = 'proyecto_principal_suspendida';

        return $this->redirect($this->generateUrl($url));
	}
    public function cuentaSuspendidaAction(){

        $session = new Session();
        $userManager = $this->container->get('fos_user.user_manager');
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
    	$titulo = '¡Su cuenta fue suspendida...!';
    	$mensaje = 'Estimado(a) '.ucfirst($user ->getNombre()) . ' '.ucfirst($user ->getApellido()) .' su cuenta fue suspendida en DONDE-QUIERO, lamentamos la situación.';
    	$tituloBoton = 'Ir al inicio';
    	$direccionBoton = $this->generateUrl('proyecto_principal_homepage');
    	$array = array('titulo' => $titulo, 'mensaje' => $mensaje, 'tituloBoton'=>$tituloBoton, 'direccionBoton'=>$direccionBoton );
    	
    	$session->invalidate();
    	return $this -> render('ProjectFrontBundle:Default:mensaje.html.twig', $array);
    }
	public function indexAction() {
		//HelpersController::eliminaHuerfanos($this);
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();
		//$secondArray['sedes'] = array();
        $secondArray['sedes']     = HelpersController::getSedes(false,false,0,$this);//caso especial mapas javascript

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:index.html.twig', $array);
	}


	public function eventoAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:evento.html.twig', $array);
	}
	public function servicioAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:servicio.html.twig', $array);
	}
	public function eventosAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:eventos.html.twig', $array);
	}
	public function serviciosAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:servicios.html.twig', $array);
	}
	public function sedesAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProjectFrontBundle:Default:sedes.html.twig', $array);
	}

}
