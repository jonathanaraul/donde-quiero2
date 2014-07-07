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
use Proyecto\PrincipalBundle\Entity\User;
use Proyecto\PrincipalBundle\Entity\Espacio1;
use Proyecto\PrincipalBundle\Entity\Espacio2;
use Proyecto\PrincipalBundle\Entity\Espacio3;
use Proyecto\PrincipalBundle\Entity\Espacio4;
use Proyecto\PrincipalBundle\Entity\Espacio5;


class HelpersController extends Controller
{
    public function funcionAction() {
        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;
        $em = $this->getDoctrine()->getManager();

        $tipo = trim($post -> get("tipo"));
        $tarea = trim($post -> get("tarea"));
        $identificador = intval($post -> get("identificador"));
        $valor = intval($post -> get("valor"));
        $user = UtilitiesAPI::getActiveUser($this);

        //if($tipo=='usuario')
        //$object = $this -> getDoctrine() -> getRepository('ProyectoUserBundle:User') -> find($identificador);
        if($tipo=='espacio')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Espacio') -> find($identificador);
        else if($tipo=='sede')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Sede') -> find($identificador);
        else if($tipo=='evento')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Evento') -> find($identificador);
        else if($tipo=='servicio')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Servicio') -> find($identificador);
        //else if($tipo=='ingreso')
        //$object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Reserva') -> find($identificador);

        if($tarea=='estado')$object->setEstado($valor);
        //else if($tarea=='rol')$object->setRol($valor);
        //else if($tarea=='destacado')$object->setDestacado($valor);
        //else if($tarea=='suspendido')$object->setSuspendido($valor);
        //else if($tarea=='cancelado')$object->setCancelado($valor);


        $em->persist($object);
        $em->flush();

        $respuesta = new response(json_encode(array('estado' => true)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }
    public function listaNavegacionAction($menu,$user)
    {
        return $this->render('ProyectoPrincipalBundle:Helpers:listaNavegacion.html.twig', array('menu' => $menu,'user'=>$user));
    }
    public function statsAction()
    {
		$secondArray = array();
		
		$secondArray['estudios'] = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Proyecto') -> findAll(  );
		$secondArray['estudios'] = count($secondArray['estudios']);
		
		$secondArray['usuarios'] = $this -> getDoctrine() -> getRepository('ProyectoUserBundle:User') -> findAll(  );
		$secondArray['usuarios'] = count($secondArray['usuarios']);

        return $this->render('ProyectoPrincipalBundle:Helpers:estadisticas.html.twig', $secondArray);
    }
    public static function eliminaHuerfanos($class){

        $em = $class->getDoctrine()->getManager();
        $user = UtilitiesAPI::getActiveUser($class);
        $object = $class-> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Retiro') -> findOneByUser($user);
        $em = $class -> getDoctrine() -> getManager();
        $em->remove($object);
        $em->flush();

    }

    public static function getEspacios($class){

        $em = $class->getDoctrine()->getManager();

        $dql =  'SELECT o1.id,o1.nombre,o1.path, o1.superficie,o1.precioPorHora,o2.nombre localidad
                 FROM ProyectoPrincipalBundle:Espacio o1, ProyectoPrincipalBundle:Localidad o2
                 WHERE o1.localidad = o2.id
                 ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql )->setMaxResults(8);

        $arreglo = $query->getResult();
       // var_dump($arreglo);
        //exit;

        return  $arreglo;
    }

    public static function getEventos($class){

        $em = $class->getDoctrine()->getManager();

        $dql =  'SELECT o1.id,o1.nombre,o1.path, o1.duracionTotal,o1.precioPorHora,o2.nombre localidad
                 FROM ProyectoPrincipalBundle:Evento o1, ProyectoPrincipalBundle:Localidad o2
                 WHERE o1.localidad = o2.id
                 ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql )->setMaxResults(8);

        $arreglo = $query->getResult();
       // var_dump($arreglo);
        //exit;

        return  $arreglo;
    }
    public static function getSedes($proveedor,$cliente,$idRelacionado,$class){

        $em = $class->getDoctrine()->getManager();

        $dql =  'SELECT o1.id,o1.nombre,o1.path,o1.descripcionGeneral, o1.latitud,o1.longitud
                 FROM ProyectoPrincipalBundle:Sede o1 
                ';



        $tieneWhere = false;

        if($proveedor){
            $dql .=  ', ProyectoUserBundle:User o3  WHERE o1.user = o3.id and o3.id = :idRelacionado';
            $tieneWhere = true;
        }
        if($cliente){
            $dql.= ' WHERE o1.id IN ( SELECT DISTINCT r2.id FROM ProyectoPrincipalBundle:Reserva r1, 
            ProyectoPrincipalBundle:Sede r2, ProyectoUserBundle:User r3 WHERE r1.sede = r2.id and r1.user = r3.id and r3.id = :idRelacionado ) ';
            $tieneWhere = true;
        }
        
       if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
        $dql .= ' o1.id != 105  ';

        $dql .=   ' ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql );
        if($proveedor || $cliente)$query->setParameter('idRelacionado', $idRelacionado);
        $arreglo = $query->getResult();

        return  $arreglo;
    }
    public static function getServicios($class){

        $em = $class->getDoctrine()->getManager();

        $dql =  'SELECT o1.id,o1.nombre,o1.path,o1.precioPorHora
                 FROM ProyectoPrincipalBundle:Servicio o1
                 ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql )->setMaxResults(8);

        $arreglo = $query->getResult();
       // var_dump($arreglo);
        //exit;

        return  $arreglo;
    }
    public static function getProvincias($class){

        $em = $class->getDoctrine()->getManager();

        $dql =  'SELECT o1.id,o1.nombre
                 FROM ProyectoPrincipalBundle:Provincia o1
          
                 ORDER BY o1.nombre ASC';

        $query = $em->createQuery( $dql );

        $arreglo = $query->getResult();


        return  $arreglo;
    }
    
}
