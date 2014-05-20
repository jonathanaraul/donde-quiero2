<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Security\Core\SecurityContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use JMS\SecurityExtraBundle\Annotation\Secure;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Ob\HighchartsBundle\Highcharts\Highchart;

class DefaultController extends Controller {

	public function direccionadorAction() {
		$user = UtilitiesAPI::getActiveUser($this);
        
        $url = '';
		if($user->getRol()==1) $url = 'proyecto_principal_gestion';
		else if($user->getRol()==0)$url = 'proyecto_perfil_privado';

        return $this->redirect($this->generateUrl($url));
	}

	public function indexAction() {
		//HelpersController::eliminaHuerfanos($this);
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();
        $secondArray['sedes']     = HelpersController::getSedes(false,false,0,$this);//caso especial mapas javascript

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:index.html.twig', $array);
	}


	public function eventoAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:evento.html.twig', $array);
	}
	public function servicioAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:servicio.html.twig', $array);
	}
	public function eventosAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:eventos.html.twig', $array);
	}
	public function serviciosAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:servicios.html.twig', $array);
	}
	public function sedesAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:sedes.html.twig', $array);
	}

}
