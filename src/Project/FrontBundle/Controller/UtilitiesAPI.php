<?php

namespace Project\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;



class UtilitiesAPI extends Controller {
	

	public static function procesaUsuario( $arreglo, $class) {

		$factory = $class -> get('security.encoder_factory');
		$object = null;

		$object   = new User();
		$encoder  = $factory -> getEncoder($object);
		$password = $encoder -> encodePassword($arreglo['contrasenia'], $object -> getSalt());
		$object   -> setPassword($password);
		
		$object -> setNombre(strtolower($arreglo['nombre']));
		$object -> setApellido(strtolower($arreglo['apellidos']));
		$object -> setUsername($arreglo['usuario']);
		$object -> setEmail(strtolower($arreglo['email']));
		$object -> setDescripcion($arreglo['descripcion']);
		$object -> setEventos($arreglo['eventos']);
		$object -> setEmail(strtolower($arreglo['email']));
		$object -> setTelefono($arreglo['telefono']);
		$object -> setPais($arreglo['pais']);
		$object -> setCiudad($arreglo['ciudad']);
		$object -> setMarketing($arreglo['marketing']);
		$object -> setFechaRegistro(new \DateTime());

		$em = $class -> getDoctrine() -> getManager();
		$em -> persist($object);
		$em -> flush();
	}

	public static function getDefaultContent($class){
		
		//$parameters = UtilitiesAPI::getParameters($class);
		//$menu = UtilitiesAPI::getMenu($item,$class);
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
		// 

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


		//if ($user != NULL && false === $class -> get('security.context') -> isGranted('ROLE_ADMIN')) {
		//	$user = null;
		//}

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
	 //.' - '.$hora.':'.$minuto;
	 return $fecha;
	 }

	 public static function obtenerFechaNormal($class) {
	 $hoy = getdate();
	 $anio = $hoy['year'];
	 $mes = $hoy['mon'];
	 $dia = $hoy['mday'];
	 $fecha = $dia . "/" . $mes . '/' . $anio;
	 //.' - '.$hora.':'.$minuto;
	 return $fecha;
	 }
	 public static function obtenerFechaNormal2($class) {
	 $hoy = getdate();
	 $anio = $hoy['year'];
	 $mes = $hoy['mon'];
	 $dia = $hoy['mday'];
	 $fecha =  $anio .'-'. $mes .'-'. $dia. ' 00:00:00';
	 //.' - '.$hora.':'.$minuto;
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
	/*
	 public static function obtenerFechaCastellanizada($class) {
	 $hoy = getdate();
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	 $anio = $hoy['year'];
	 $mes = intval($hoy['mon']) - 1;
	 $dia = $hoy['mday'];
	 $hora = $hoy['hours'];
	 $minuto = $hoy['minutes'];
	 $fecha = $dia . " de " . $meses[$mes] . ' del ' . $anio;
	 //.' - '.$hora.':'.$minuto;
	 return $fecha;
	 }

	 public static function obtenerFechaCastellanizada2($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	 $mes = intval($arreglo[1]) - 1;
	 $fecha = $arreglo[0] . " de " . $meses[$mes] . ' del ' . $arreglo[2];

	 return $fecha;
	 }

	 public static function obtenerFechaCastellanizada3($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	 $mes = intval($arreglo[1]) - 1;
	 $fecha = $meses[$mes] . ' del ' . $arreglo[2];

	 return $fecha;
	 }

	 public static function obtenerFechaCastellanizada4($fechaOriginal, $class) {

	 $arreglo = explode("/", $fechaOriginal);
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
	 $mes = intval($arreglo[1]) - 1;
	 $fecha = $arreglo[0] . " de " . $meses[$mes] . ' del ' . $arreglo[2];

	 return $fecha;
	 }

	 public static function obtenerNombreMes($fecha, $class) {
	 $hoy = getdate();
	 $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

	 $mes = intval($fecha['mon']) - 1;
	 return $mes;
	 }




	 public static function obtenerFechaNormal3($class) {
	 $hoy = getdate();
	 $anio = $hoy['year'];
	 $mes = $hoy['mon'];
	 $dia = $hoy['mday'];
	 $fecha = $anio . "-" . $mes . '-' . $dia;
	 //.' - '.$hora.':'.$minuto;
	 return $fecha;
	 }

	 public static function obtenerMesYAnio($class) {
	 $hoy = getdate();
	 return array($hoy['year'], $hoy['mon']);
	 }



	 public static function convertirFechaNormal3($fechaOriginal, $class) {
	 $arreglo = explode("/", $fechaOriginal);
	 $fecha = new \DateTime();
	 $fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
	 return $fecha;
	 }

	 public static function convertirFechaNormal2($fechaOriginal, $class) {
	 $fechaOriginal = trim($fechaOriginal);
	 $arreglo1 = explode(" ", $fechaOriginal);
	 $arreglo = explode("-", $arreglo1[0]);
	 $fecha = new \DateTime();
	 $fecha -> setDate($arreglo[2], $arreglo[1], $arreglo[0]);
	 return $fecha;
	 }

	 public static function convertirAFechaNormal($fechaOriginal, $class) {

	 $fechaOriginal = new \DateTime($fechaOriginal);
	 return date_format($fechaOriginal, 'd/m/Y'); ;
	 }

	 public static function convertirAFormatoSQL($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 if ($arreglo[1] < 10)
	 $arreglo[1] = '0' . $arreglo[1];
	 if ($arreglo[0] < 10)
	 $arreglo[0] = '0' . $arreglo[0];
	 $fecha = $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0] . ' 00:00:00';

	 return $fecha;

	 }

	 public static function obtenerFechasFormatoSQL($anio, $mes, $class) {

	 if ($mes < 10)
	 $mes = '0' . $mes;
	 $dia = '01';

	 $fechaInicial = $anio . '-' . $mes . '-' . $dia . ' 00:00:00';
	 $dia = '31';
	 $fechaFinal = $anio . '-' . $mes . '-' . $dia . ' 00:00:00';

	 $arreglo = array($fechaInicial, $fechaFinal);

	 return $arreglo;

	 }

	 public static function convertirAFormatoSQL2($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 if ($arreglo[1] < 10)
	 $arreglo[1] = '0' . $arreglo[1];
	 if ($arreglo[0] < 10)
	 $arreglo[0] = '0' . $arreglo[0];
	 $fecha = $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0];

	 return $fecha;

	 }

	 public static function convertirAFormatoSQL3($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);

	 $fecha = $arreglo[2] . '/' . $arreglo[1] . '/' . $arreglo[0];

	 return $fecha;

	 }

	 public static function convertirAFormatoSQL4($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $fecha = $arreglo[2] . '-' . $arreglo[1] . '-' . $arreglo[0] . ' 00:00:00';

	 return $fecha;

	 }

	 public static function primerDiaMes($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $fecha = $arreglo[2] . '-' . $arreglo[1] . '-01 00:00:00';

	 return $fecha;

	 }

	 public static function primerDiaMesSiguiente($fechaOriginal, $class) {

	 $arreglo = explode("-", $fechaOriginal);
	 $mes = intval($arreglo[1]);
	 $anio = intval($arreglo[2]);

	 if ($mes == 12) {
	 $mes = "01";
	 $anio++;
	 } else {
	 $mes++;
	 if ($mes < 9)
	 $mes = "0" . $mes;
	 }

	 $fecha = $anio . '-' . $mes . '-01 00:00:00';

	 return $fecha;

	 }


	 */
}
