<?php

namespace Project\FrontBundle\Controller;

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

	public static function getMenu($seccion, $this) {
		$menu = array('seccion' => $seccion);
		/*
		 * Añadir exception de no encontrar parameters
		 if (!$product) {
		 throw $this->createNotFoundException(
		 'No product found for id '.$id
		 );
		 }
		 *
		 */
		 return $menu;
		}

		public static function getActiveUser($class) {

			$userManager = $class->container->get('fos_user.user_manager');
			$user = $class->getUser();
			return $user;
		}

		public static function getNotifications($user) {

			$notifications = null;
			if ($user != NULL) {
				$notifications = array();
				$notifications[0]['texto'] = 'Espacio reducido';
				$notifications[0]['numero'] = '40%';
			}

			return $notifications;
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

		public static function obtenerFechaNormal($class) {
			$hoy = getdate();
			$anio = $hoy['year'];
			$mes = $hoy['mon'];
			$dia = $hoy['mday'];
			$fecha = $dia . "/" . $mes . '/' . $anio;
			return $fecha;
		}
		public static function obtenerFechaNormal2($class) {
			$hoy = getdate();
			$anio = $hoy['year'];
			$mes = $hoy['mon'];
			$dia = $hoy['mday'];
			$fecha =  $anio .'-'. $mes .'-'. $dia. ' 00:00:00';
			return $fecha;
		}

		public static function sumarTiempo($fechaOriginal, $dia, $mes, $anio, $class) {

			$arreglo = explode("/", $fechaOriginal);
			$fecha = new \DateTime();
			$fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
			$fecha -> setTime(0, 0, 0);
			$periodo = 'P' . $anio . 'Y' . $mes . 'M' . $dia . 'D';
			$fecha -> add(new \DateInterval($periodo));
			$fecha = date_format($fecha, 'd/m/Y'); ;
			return $fecha;

		}
		public static function obtenerNombreDia($fechaOriginal, $class) {

			$arreglo = explode("/", $fechaOriginal);
			$fecha = new \DateTime();
			$fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
			$dia = $fecha->format('w');
			$dias = array( 'Domingo' , 'Lunes' , 'Martes', 'Miercoles','Jueves','Viernes','Sabado');
			return $dias[$dia];;
		}
}
