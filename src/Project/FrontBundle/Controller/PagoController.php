<?php

namespace Project\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Project\UserBundle\Entity\User;
use Project\BackBundle\Entity\Espacio;
use Project\BackBundle\Entity\Reserva;
use Project\BackBundle\Entity\Confirmacion;
use Project\BackBundle\Entity\ConfirmacionElemento;


class PagoController extends Controller {
    

    public function aprobadoAction($id) {
        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $object = $this -> getDoctrine() -> getRepository('ProjectBackBundle:Confirmacion') -> find($id);

        $object->setPagado(true);
        $object->setCancelado(false);       

        $em = $this -> getDoctrine() -> getManager();
        $em -> persist($object);
        $em -> flush();

        $titulo = '¡Reserva exitosa!';
        $mensaje = 'Su reserva fue procesada con éxito...';
        $direccionBoton = $this -> generateUrl('project_front_homepage');
        $tituloBoton = 'Regresar al home';

        $secondArray = array('titulo'=>$titulo,'mensaje'=>$mensaje,'direccionBoton'=>$direccionBoton,'tituloBoton'=>$tituloBoton);

        $array = array_merge($firstArray, $secondArray);
        return $this -> render('ProjectLayoutBundle:Helpers:mensaje.html.twig', $array);
    }

    public function canceladoAction($id) {
        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $object = $this -> getDoctrine() -> getRepository('ProjectBackBundle:Confirmacion') -> find($id);

        $object->setPagado(false);
        $object->setCancelado(true);       

        $em = $this -> getDoctrine() -> getManager();
        $em -> persist($object);
        $em -> flush();

        $titulo = '¡Reserva cancelada!';
        $mensaje = 'Su reserva fue cancelada, de igual modo ud podrá realizar el pago cuando lo desee...';
        $direccionBoton = $this -> generateUrl('project_front_homepage');
        $tituloBoton = 'Regresar al home';

        $secondArray = array('titulo'=>$titulo,'mensaje'=>$mensaje,'direccionBoton'=>$direccionBoton,'tituloBoton'=>$tituloBoton);


        $array = array_merge($firstArray, $secondArray);
        return $this -> render('ProjectLayoutBundle:Helpers:mensaje.html.twig', $array);
    }

    public function procesarReservaAction() {
        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;
        $em = $this->getDoctrine()->getManager();

        $arreglo = $this->get('request')->request->all();

        $respuesta = PagoController::procesarReserva($arreglo,$this);

        $respuesta = new response(json_encode(array('respuesta' => $respuesta)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }

    public function procesarReserva( $arreglo,$class){

        $user = UtilitiesAPI::getActiveUser($class);
        $em = $class->getDoctrine()->getManager();

        $dql =  'SELECT o1
                 FROM ProjectBackBundle:Reserva o1, 
                      ProjectBackBundle:'.ucfirst(  $arreglo['tipo'] ).' o2
                 WHERE o1.'.strtolower ( $arreglo['tipo'] ).' = o2.id AND
                       o1.user = :idUser AND
                       o2.id = :idTipo AND
                       o1.numeroReservacion = :numeroReservacion';

        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $user->getId());
        $query->setParameter('idTipo', $arreglo['idTipo']);
        $query->setParameter('numeroReservacion', $arreglo['numeroReservacion']);
        $object = $query->getOneOrNullResult();

        if ($object == null) {
            $object = new Reserva();
        } 
        
        $object -> setTitulo($arreglo['titulo']);
        $object -> setNumeroReservacion($arreglo['numeroReservacion']);
        $object -> setUser($user);
        $object -> setPagado(false);
        $object -> setAprobado(false);
        $object -> setCancelado(false);
        $object -> setOculto(false);

        $todoDia = false;
        if($arreglo['todoDia']=='true')$todoDia = true;
        $object -> setTodoDia($todoDia);
      
        $fechaInicio = new \DateTime();
        $fechaInicio->setDate ( intval($arreglo['anioInicio']) , (intval($arreglo['mesInicio'])+1) , intval($arreglo['diaInicio']) );
        $fechaInicio->setTime ( intval($arreglo['horaInicio']) , intval($arreglo['minInicio'] ));
        $object -> setFechaInicio($fechaInicio);
        
        $fechaFin = new \DateTime();
        $fechaFin->setDate ( intval($arreglo['anioFin']) , (intval($arreglo['mesFin'])+1) , intval($arreglo['diaFin']) );
        $fechaFin->setTime ( intval($arreglo['horaFin']) , intval($arreglo['minFin'] ));
        $object -> setFechaFin($fechaFin);

        $auxiliar = null;

        if($arreglo['tipo']=='espacio'){
            $auxiliar = $class -> getDoctrine() -> getRepository('ProjectBackBundle:Espacio') -> find($arreglo['idTipo']);
            $object -> setEspacio( $auxiliar );
        }
        else if($arreglo['tipo']=='servicio'){
            $auxiliar = $class -> getDoctrine() -> getRepository('ProjectBackBundle:Servicio') -> find($arreglo['idTipo']);
            $object -> setServicio( $auxiliar );
        }
        else if($arreglo['tipo']=='sede'){
            $auxiliar = $class -> getDoctrine() -> getRepository('ProjectBackBundle:Sede') -> find($arreglo['idTipo']);
            $object -> setSede( $auxiliar );
        }
        else if($arreglo['tipo']=='evento'){
            $auxiliar = $class -> getDoctrine() -> getRepository('ProjectBackBundle:Evento') -> find($arreglo['idTipo']);
            $object -> setEvento( $auxiliar );
        }

        $em = $class -> getDoctrine() -> getManager();
        $em -> persist($object);
        $em -> flush();
        
        return true;

    }
    public function borrarReservasAction() {
        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;
        $em = $this->getDoctrine()->getManager();

        $idTipo = intval($post -> get("idTipo"));
        $tipo = ucfirst( trim($post -> get("tipo")));
        $user = UtilitiesAPI::getActiveUser($this);
        $idUser = $user->getId();


        $dql =  'SELECT o1
                 FROM ProjectBackBundle:Reserva o1, 
                      ProjectBackBundle:'.$tipo.' o2
                 WHERE o1.'.strtolower ( $tipo ).' = o2.id AND
                       o1.user = :idUser AND
                       o2.id = :idTipo';

        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $idUser);
        $query->setParameter('idTipo', $idTipo);
        $reservas = $query->getResult();

        for ($i=0; $i < count($reservas) ; $i++) { 

            $dql =  'SELECT o1
            FROM ProjectBackBundle:ConfirmacionElemento o1, 
            ProjectBackBundle:Reserva o2
            WHERE o1.reserva = o2.id AND
            o2.id = :id';

            $query = $em->createQuery( $dql );
            $query->setParameter('id', $reservas[$i]->getId());
            $confirmacionElemento = $query->getResult();

            for ($j=0; $j < count($confirmacionElemento) ; $j++) { 
                $em->remove($confirmacionElemento[$j]);
                $em->flush();
            }
        }

        for ($i=0; $i < count($reservas) ; $i++) { 
            $em->remove($reservas[$i]);
            $em->flush();
        }

        $respuesta = new response(json_encode(array('respuesta' => true)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }
    public function confirmacionGuardarAction() {
        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;
        $em = $this -> getDoctrine() -> getManager();

        $arreglo = $this->get('request')->request->all();
            //    var_dump($arreglo);exit;

        $object = new Confirmacion();

        $object -> setInformacionAdicional($arreglo['informacionAdicional']);
        $object -> setHoras($arreglo['horas']);
        $object -> setPrecioTotal($arreglo['precioTotal']);
        $object -> setUser(UtilitiesAPI::getActiveUser($this));
        $object -> setPagado(false);
        $object -> setCancelado(false);
        $object -> setFechaRegistro(new \DateTime());


        if($arreglo['tipo']=='espacio'){
            $auxiliar = $this -> getDoctrine() -> getRepository('ProjectBackBundle:Espacio') -> find($arreglo['idTipo']);
            $object -> setEspacio( $auxiliar );
        }
        else if($arreglo['tipo']=='servicio'){
            $auxiliar = $this -> getDoctrine() -> getRepository('ProjectBackBundle:Servicio') -> find($arreglo['idTipo']);
            $object -> setServicio( $auxiliar );
        }
        else if($arreglo['tipo']=='sede'){
            $auxiliar = $this -> getDoctrine() -> getRepository('ProjectBackBundle:Sede') -> find($arreglo['idTipo']);
            $object -> setSede( $auxiliar );
        }
        else if($arreglo['tipo']=='evento'){
            $auxiliar = $this -> getDoctrine() -> getRepository('ProjectBackBundle:Evento') -> find($arreglo['idTipo']);
            $object -> setEvento( $auxiliar );
        }

        $em -> persist($object);
        $em -> flush();

        $url =  $this -> generateUrl('project_front_pago_cancelado',array('id' => $object->getId()));
        $url =  $this -> generateUrl('project_front_pago_aprobado',array('id' => $object->getId()));


        $cantidadReservas = intval($arreglo['cantidadReservas']);

        for ($i=0; $i < $cantidadReservas ; $i++) { 
        
            $auxiliar = intval($arreglo['reserva_'.($i+1)]);
            $reserva = $this -> getDoctrine() -> getRepository('ProjectBackBundle:Reserva') -> find($auxiliar);
            $element = new ConfirmacionElemento();
            $element -> setConfirmacion( $object );
            $element -> setReserva( $reserva );
            $em -> persist($element);
            $em -> flush();
        }

        $respuesta = new response(json_encode(array('respuesta' => true,'url'=>$url)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }

}