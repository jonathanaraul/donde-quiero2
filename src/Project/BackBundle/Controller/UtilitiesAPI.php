<?php

namespace Project\BackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

class UtilitiesAPI extends Controller {
	
	public static function getDefaultContent($class){
		
		$userManager = $class->container->get('fos_user.user_manager');
		$user = $class->getUser();
		$rol = null;
		$usuario = null;
		if($user!=NULL){
			$usuario = ucfirst($user->getNombre()).' '.ucfirst($user->getApellido());
			if (false === $class->get('security.context')->isGranted('ROLE_ADMIN')) $rol = 0;
			else $rol = 1;
		}
		$datos = array('usuario' => $usuario, 'fecha' => UtilitiesAPI::obtenerFechaSistema($class),'rol'=>$rol);
		$array = array('datos' => $datos );
		return $array;
	}

	public static function getActiveUser($class) {

		$userManager = $class->container->get('fos_user.user_manager');
		$user = $class->getUser();
		return $user;
	}

	public static function obtenerFechaSistema($class) {
		$hoy = getdate();
		$meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$anio = $hoy['year'];
		$mes = intval($hoy['mon']) - 1;
		$dia = $hoy['mday'];
		$hora = $hoy['hours'];
		$minuto = $hoy['minutes'];
		$dias = array('Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado');
		$dsemana = $hoy['wday'];
		$fecha = $dias[$dsemana] . ", " . $dia . " de " . $meses[$mes] . ' de ' . $anio;
		return $fecha;
	}

	
}
