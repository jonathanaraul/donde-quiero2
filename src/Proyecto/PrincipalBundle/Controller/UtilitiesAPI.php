<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;

use Proyecto\PrincipalBundle\Entity\User;
use Proyecto\PrincipalBundle\Entity\Autores;
use Proyecto\PrincipalBundle\Entity\Sistema;
use Proyecto\PrincipalBundle\Entity\Proyecto;

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
		$user = UtilitiesAPI::getActiveUser($class);
		$rol = null;
		$usuario = null;
		if($user!=NULL){
			$usuario = ucfirst($user->getNombre()).' '.ucfirst($user->getApellido());
			$rol = $user->getRol();
		}

		$datos = array('usuario' => $usuario, 'fecha' => UtilitiesAPI::obtenerFechaSistema($class),'rol'=>$rol);
		$array = array('datos' => $datos );
		return $array;
	}
	public static function removeProject($id,$class){
			
		$object = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Proyecto') -> find($id);
		$em = $class -> getDoctrine() -> getManager();
		$em->remove($object);
		$em->flush();
	}

	public static function saveProject( $tipo, $id, $nombre, $langelier, $rysnar, $puckoris, $informacion, $autoguardado, $ph, $tds, $t, $ca2, $tds, $alcalinidad, $class) {

		$object = null;
		
		if ($id == 0) {
			$object = new Proyecto();
			$object -> setFecha(new \DateTime());
		} else {
			$object = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Proyecto') -> find($id );
			if (!$object) {
				throw $class -> createNotFoundException('No se encontro el proyecto ');
			}
		}

		
		$object -> setNombre($nombre);
		$object -> setLangelier($langelier);
		$object -> setRysnar($rysnar);
		$object -> setPuckorius($puckoris);
		$object -> setInformacion($informacion);
		$object -> setAutoguardado($autoguardado);
		$object -> setUser(UtilitiesAPI::getActiveUser($class));
		$object -> setPh($ph);
		$object -> setTds($tds);
		$object -> setT($t);
		$object -> setCa2($ca2);
		$object -> setAlcalinidad($alcalinidad);

		$em = $class -> getDoctrine() -> getManager();
		$em -> persist($object);
		$em -> flush();
		
		return $object->getId();
		
	}

	/*
	public static function getDefaultContent($item,$info,$class){
		
		$parameters = UtilitiesAPI::getParameters($class);
		$menu = UtilitiesAPI::getMenu($item,$class);
		$user = UtilitiesAPI::getActiveUser($class);
		$notifications = UtilitiesAPI::getNotifications($user);
		$usuario = $user;// UtilidadesAPI::usuarioActual($this);
		if($usuario!=NULL)$usuario = ucfirst($usuario->getNombre()).' '.ucfirst($usuario->getApellido());
		else $usuario = '';
		$datos = array('usuario' => $usuario, 'fecha' => UtilitiesAPI::obtenerFechaSistema($class));
		
		$array = array('parameters' => $parameters,'menu' => $menu,'user' => $user, 
		               'info' => $info, 'notifications' => $notifications,
		               'datos' => $datos
					   );
		
		return $array;
	}*/

	public static function getAutors($class) {
		$autors = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Autores') -> findAll();
		$users = array();
		for ($i = 0; $i < count($autors); $i++) {
			$users[$i] = $autors[$i] -> getUser();
			
		}

		/*
		 * Añadir exception de no encontrar parameters
		 if (!$product) {
		 throw $this->createNotFoundException(
		 'No product found for id '.$id
		 );
		 }
		 *
		 */
		return $users;
	}

	public static function getParameters($class) {
		$parameters = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Sistema') -> find(1);

		/*
		 * Añadir exception de no encontrar parameters
		 if (!$product) {
		 throw $this->createNotFoundException(
		 'No product found for id '.$id
		 );
		 }
		 *
		 */
		return $parameters;
	}

	public static function getMenu($seccion, $this) {
		$menu = array('seccion' => $seccion);
		// = $this->getDoctrine()->getRepository('ProyectoPrincipalBundle:Sistema')->find(1);

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

		$user = $class -> getUser();

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
