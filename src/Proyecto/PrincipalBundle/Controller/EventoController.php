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
use Proyecto\PrincipalBundle\Entity\Evento;
use Proyecto\PrincipalBundle\Entity\Reserva;
use Proyecto\PrincipalBundle\Entity\Confirmacion;
use Proyecto\PrincipalBundle\Entity\ConfirmacionElemento;

class EventoController extends Controller {


	public function individualAction($id) {
        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Evento') -> find($id);
        $reservas = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Reserva') -> findByEvento($object);
        
        $user = UtilitiesAPI::getActiveUser($this);
        $secondArray = array('object'=>$object,'reservas'=>$reservas,'userId'=>$user->getId());

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Evento:individual.html.twig', $array);
	}
	public function grupalAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Evento:grupal.html.twig', $array);
	}

	public function registrarAction(Request $request) {
		$id = null;
		$url = $this -> generateUrl('proyecto_principal_evento_registrar');

		return EventoController::registrarEditar($id ,$url, $request,$this);
	}
	public function editarAction(Request $request,$id) {

		$user = UtilitiesAPI::getActiveUser($this);
		$idUser = $user->getId();
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Evento') -> find($id);

        if($object->getUser()->getId() != $idUser){
            $titulo = '¡Error 404...!';
            $mensaje = 'Estimado(a) '.ucfirst($user ->getNombre()) . ' '.ucfirst($user ->getApellido()) .' ud no tiene derechos para realizar esta edición.';
            $tituloBoton = 'Ir al inicio';
            $direccionBoton = $this->generateUrl('proyecto_principal_homepage');
            $array = array('titulo' => $titulo, 'mensaje' => $mensaje, 'tituloBoton'=>$tituloBoton, 'direccionBoton'=>$direccionBoton );
            return $this -> render('ProyectoPrincipalBundle:Default:mensaje.html.twig', $array);
        }

		$url = $this -> generateUrl('proyecto_principal_evento_editar',array('id' => $id));

		return EventoController::registrarEditar($id ,$url,$request, $this);

	}

	public static function registrarEditar($id ,$url,Request $request,$class) {
		if($id == null )$object = new Evento();
		else $object = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Evento') -> find($id);
		
		$firstArray = UtilitiesAPI::getDefaultContent($class);
		$secondArray = array();
		$user = UtilitiesAPI::getActiveUser($class);
		$provincias = HelpersController::getProvincias($class);
		$idProvincia = $user->getProvincia()->getId();

		$parametro = $user->getProvincia()->getId();
		$object->setLocalidad($user->getLocalidad());

        $form = $class->createFormBuilder($object)

            ->add('propietarioEmpleado', 'checkbox',array('required'  => false))
            ->add('agenteComercial', 'checkbox',array('required'  => false))
            ->add('administradorWeb', 'checkbox',array('required'  => false))

            ->add('nombre', 'text')
            ->add('descripcionGeneral', 'textarea')
            ->add('espacio', 'entity', array(
			    'class' => 'ProyectoPrincipalBundle:Espacio',
			    'property' => 'nombre',
			    'required'  => false,
			    'query_builder' => function(EntityRepository $er) {
			        return $er->createQueryBuilder('u')
			            ->orderBy('u.nombre', 'ASC');
			    },
			))
            ->add('localidad', 'entity', array(
			    'class' => 'ProyectoPrincipalBundle:Localidad',
			    'property' => 'nombre',
			    'query_builder' => function(EntityRepository $er)use ( $parametro ) {


			        return $er->createQueryBuilder('u')
			            ->add('where', 'u.provincia = ?1')
			            ->orderBy('u.nombre', 'ASC')
			            ->setParameter(1, $parametro); // Sustituye ?1 por 100
			    },

			))
			->add('duracionTotal', 'text')
			->add('file','file') 
            ->add('enlaceVideo', 'text')

            ->add('esPrivado', 'checkbox',array('required'  => false))
            ->add('esGratuito', 'checkbox',array('required'  => false))


            ->add('modoAula', 'checkbox',array('required'  => false))
            ->add('modoAulaCapacidad')
            ->add('modoBanquete', 'checkbox',array('required'  => false))
            ->add('modoBanqueteCapacidad')
            ->add('modoCocktail', 'checkbox',array('required'  => false))
            ->add('modoCocktailCapacidad')
            ->add('modoEscenario', 'checkbox',array('required'  => false))
            ->add('modoEscenarioCapacidad')
            ->add('modoExposicion', 'checkbox',array('required'  => false))
            ->add('modoExposicionCapacidad')


            ->add('aceptacionReservaAutomatica', 'checkbox',array('required'  => false))
            ->add('tiempoMaximoAceptacionReservaAutomatica24h', 'checkbox',array('required'  => false))
            ->add('tiempoMaximoAceptacionReservaAutomatica48', 'checkbox',array('required'  => false))
            ->add('datosFacturacionPagoDelUsuario', 'checkbox',array('required'  => false))
            ->add('anadirDatosFacturacionPago', 'checkbox',array('required'  => false))

            ->add('formacionTeorica', 'checkbox',array('required'  => false))
            ->add('formacionInformatica', 'checkbox',array('required'  => false))
            ->add('formacionTaller', 'checkbox',array('required'  => false))
            ->add('exposicion', 'checkbox',array('required'  => false))
            ->add('ventaFeria', 'checkbox',array('required'  => false))
            ->add('deporte', 'checkbox',array('required'  => false))
            ->add('espectaculo', 'checkbox',array('required'  => false))
            ->add('reunionAsamblea', 'checkbox',array('required'  => false))
            ->add('boda', 'checkbox',array('required'  => false))
            ->add('fiesta', 'checkbox',array('required'  => false))
            ->add('jardineria', 'checkbox',array('required'  => false))


            ->add('aceptoCondicionesUsoPoliticaPrivacidad', 'checkbox',array('required'  => false))
            ->add('precio','number',array('required'  => true))

            ->add('fecha', 'date', array(
                'empty_value' => array('year' => 'Año', 'month' => 'Mes', 'day' => 'Dia')
                ))

            ->add('horaInicio', 'time', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                ))
             ->add('horaFinalizacion', 'time', array(
                'input'  => 'datetime',
                'widget' => 'choice',
                ))           

            ->getForm();




	    if ($request->isMethod('POST')) {

        	$form->bind($request);

        	if ($form->isValid()) {


	        	$em = $class->getDoctrine()->getManager();
	        	

				if($id == null) {
					$object -> setFechaRegistro(new \DateTime());
				}
				
				//Casos especiales
				if($object->getEnlaceVideo()=='Añadir enlace a Video') $object->setEnlaceVideo(null);
				


				$object -> setUser($user);	
    			
                $object -> setDestacado(0);
                $object -> setEstado(1);  
                $object -> setSuspendido(0);  


                $em->persist($object);
                $em->flush();

                $fechaInicio = new \DateTime();
                $fechaInicio->setDate($object->getFecha()->format('Y'),$object->getFecha()->format('m'),$object->getFecha()->format('d'));
                $fechaInicio->setTime($object->getHoraInicio()->format('h'),$object->getHoraInicio()->format('i'),$object->getHoraInicio()->format('s'));

                $fechaFin = new \DateTime();
                $fechaFin->setDate($object->getFecha()->format('Y'),$object->getFecha()->format('m'),$object->getFecha()->format('d'));
                $fechaFin->setTime($object->getHoraFinalizacion()->format('h'),$object->getHoraFinalizacion()->format('i'),$object->getHoraFinalizacion()->format('s'));

                $reserva = new Reserva();
                $reserva->setFechaInicio($fechaInicio);
                $reserva->setFechaFin($fechaFin);
                $reserva->setUser($user);
                $reserva->setEvento($object);
                $reserva->setNumeroReservacion(1);
                $reserva->setTitulo('Mi evento');
                $reserva->setTodoDia(true);
                $reserva->setPagado(false);
                $reserva->setCancelado(false);
                $reserva->setAprobado(true);
                $reserva->setOculto(false);

                $em->persist($reserva);
                $em->flush();

                return $class->redirect($class->generateUrl('proyecto_principal_evento_individual',array('id' => $object ->getId())));

    		}
	
	    }

        $secondArray = array('form' => $form->createView(),'url'=>$url,'idProvincia'=>$idProvincia,'provincias'=>$provincias);
		$array = array_merge($firstArray, $secondArray);

		return $class -> render('ProyectoPrincipalBundle:Evento:registrarEditar.html.twig', $array);
	}
    public function destacadosAction($numResults)
    {
        $arreglo = array();
       

        $em = $this->getDoctrine()->getManager();

        $dql =  'SELECT o1.id,o1.nombre,o1.path,o1.duracionTotal,o1.precio as precioPorHora,o2.nombre localidad
                 FROM ProyectoPrincipalBundle:Evento o1, ProyectoPrincipalBundle:Localidad o2 
                 WHERE o1.localidad = o2.id  and o1.destacado = 1 ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql )
                ->setMaxResults($numResults);

        $arreglo['destacados'] = $query->getResult();

        return $this->render('ProyectoPrincipalBundle:Evento:destacados.html.twig', $arreglo);
    }
    public function widgetAction($titulo,$numResults,$paginacion,$proveedor,$cliente,$idRelacionado)
    {
		$arreglo = array();
        $em = $this->getDoctrine()->getManager();

        if($paginacion==1)$paginacion = true;
        else $paginacion = false;
        $arreglo = EventoController::consultaBusqueda($numResults,0,null,$paginacion,$proveedor,$cliente,$idRelacionado);

        $dql =  'SELECT COUNT(o1.id) c,o2.id,o2.nombre 
                 FROM ProyectoPrincipalBundle:Evento o1, 
                      ProyectoPrincipalBundle:Localidad o2
                 WHERE o1.localidad = o2.id  and o2.id != 8175

        GROUP BY  o1.localidad order by c  desc';

        $query = $em->createQuery( $dql );
        $arreglo['localidades'] = $query->getResult();

        $arreglo['proveedor']= $proveedor;
        $arreglo['cliente']= $cliente;
        $arreglo['idRelacionado']= $idRelacionado;
        $arreglo['titulo']= $titulo;
        $arreglo['numResults']= $numResults;

        return $this->render('ProyectoPrincipalBundle:Evento:widget.html.twig', $arreglo);
    }

    public function busquedaAction() {

        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;
        $em = $this->getDoctrine()->getManager();

        $localidad = intval($post -> get("localidad"));
        $precioHora = intval($post -> get("precioHora"));
        $precio = intval($post -> get("precio"));
        $duracionTotal = intval($post -> get("duracionTotal"));
        $actividades = trim($post -> get("actividades"));

        $paginacion = intval($post -> get("paginacion"));
        $numResults = intval($post -> get("numResults"));
        $indice = intval($post -> get("indice"));

        if($paginacion==1)$paginacion = true;
        else $paginacion = false;

        $proveedor = intval($post -> get("proveedor"));
        $cliente = intval($post -> get("cliente"));
        $idRelacionado = intval($post -> get("idRelacionado"));

        if($proveedor==0)$proveedor = false;
        if($cliente==0)$cliente = false;

        $parametros = array('localidad'=>$localidad,'precioHora'=>$precioHora,'precio'=>$precio,
                            'duracionTotal'=>$duracionTotal,'actividades'=>$actividades);

        $arreglo = EventoController::consultaBusqueda($numResults,$indice,$parametros,$paginacion,$proveedor,$cliente,$idRelacionado);

        $htmlElementos = $this -> renderView('ProyectoPrincipalBundle:Evento:elementos.html.twig', array('elementos'=>$arreglo['elementos']) );
        $htmlPaginacion = $this -> renderView('ProyectoPrincipalBundle:Evento:paginacion.html.twig', array('dataPaginacion'=>$arreglo['dataPaginacion']));

        $respuesta = new response(json_encode(array('htmlElementos' => $htmlElementos,'htmlPaginacion' =>$htmlPaginacion)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }
    public function consultaBusqueda($numResults,$indice,$parametros,$paginacion,$proveedor,$cliente,$idRelacionado){

   
    $em = $this->getDoctrine()->getManager();
    $array = array();

    $dql =  'SELECT o1.id,o1.nombre,o1.path,o1.duracionTotal,o1.precio,o2.nombre localidad
                 FROM ProyectoPrincipalBundle:Evento o1, ProyectoPrincipalBundle:Localidad o2 ';

    $dqlTotales =  'SELECT COUNT(o1.id) FROM ProyectoPrincipalBundle:Evento o1 ';

    if($proveedor){
        $dql.= ', ProyectoPrincipalBundle:User o3 ';
        $dqlTotales .=  ', ProyectoPrincipalBundle:User o3 ';
    }

    $dql .= '   WHERE o1.id != 103  ';
    $dqlTotales .= '   WHERE o1.id != 103  ';

    $modoA = "";
    $modoB = "";
    $tieneWhere = true;
    $tieneWhereTotales = true;

    if($parametros!=null){

        if($parametros['localidad']!= null && $parametros['localidad']!=0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
            
                $dql.= ' o1.localidad = :localidad';
                $dqlTotales.=' o1.localidad = :localidad';
        }
        /*if($parametros['precioHora']!= null && $parametros['precioHora']!=0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';

            if($parametros['precioHora']>1 && $parametros['precioHora']<=1000){
                $dql.= ' o1.precioPorHora <= :precioHora';
                $dqlTotales.= ' o1.precioPorHora <= :precioHora';
            }
            else if($parametros['precioHora']>1000){
                $dql.= ' o1.precioPorHora > :precioHora';
                $dqlTotales.=' o1.precioPorHora > :precioHora';
            }
            else if($parametros['precioHora']==1){
                $dql.= ' o1.precioPorHora = :precioHora';
                $dqlTotales.=' o1.precioPorHora = :precioHora';
            }
        }*/
        if($parametros['precio']!= null && $parametros['precio']!=0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';

            if($parametros['precio']>1 && $parametros['precio']<=10000){
                $dql.= ' o1.precio <= :precio';
                $dqlTotales.= ' o1.precio <= :precio';
            }
            else if($parametros['precio']>10000){
                $dql.= ' o1.precio > :precio';
                $dqlTotales.=' o1.precio > :precio';
            }
            else if($parametros['precio']==1){
                $dql.= ' o1.precio = :precio';
                $dqlTotales.=' o1.precio = :precio';
            }
        }
        if($parametros['duracionTotal']!= null && $parametros['duracionTotal']!=0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';

            if($parametros['duracionTotal']>1 && $parametros['duracionTotal']<=300){
                $dql.= ' o1.duracionTotal <= :duracionTotal';
                $dqlTotales.= ' o1.duracionTotal <= :duracionTotal';
            }
            else if($parametros['duracionTotal']>300){
                $dql.= ' o1.duracionTotal > :duracionTotal';
                $dqlTotales.=' o1.duracionTotal > :duracionTotal';
            }
            else if($parametros['duracionTotal']==1){
                $dql.= ' o1.duracionTotal = :duracionTotal';
                $dqlTotales.=' o1.duracionTotal = :duracionTotal';
            }
        }
        if($parametros['actividades']!= null && $parametros['actividades']!='0'){
            
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
           
            $dql.= ' o1.'.$parametros['actividades'].' = :actividades';
            $dqlTotales.= ' o1.'.$parametros['actividades'].' = :actividades';
            
        }
    }

    if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
    $dql.= ' o1.localidad = o2.id ';

    if($proveedor){
        if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
        $dql.= ' o1.user = o3.id and o3.id = :idRelacionado ';
        
        if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
        $dqlTotales .=  ' o1.user = o3.id and o3.id = :idRelacionado ';
    }

    if($cliente){
        if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
        $dql.= ' o1.id IN ( SELECT DISTINCT r2.id FROM ProyectoPrincipalBundle:Reserva r1, 
            ProyectoPrincipalBundle:Evento r2, ProyectoPrincipalBundle:User r3 WHERE r1.evento = r2.id and r1.user = r3.id and r3.id = :idRelacionado ) ';
        
        if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
        $dqlTotales .=  ' o1.id IN ( SELECT DISTINCT r2.id FROM ProyectoPrincipalBundle:Reserva r1, 
            ProyectoPrincipalBundle:Evento r2, ProyectoPrincipalBundle:User r3 WHERE r1.evento = r2.id and r1.user = r3.id and r3.id = :idRelacionado ) ';

    }

    $dql.= ' ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql )
        ->setMaxResults($numResults)
        ->setFirstResult($indice*$numResults);

        if($parametros['localidad']!= null && $parametros['localidad']!=0) $query->setParameter('localidad', $parametros['localidad']);
        if($parametros['precioHora']!= null && $parametros['precioHora']!=0){
            if($parametros['precioHora']!=1)$query->setParameter('precioHora', $parametros['precioHora']);
            else $query->setParameter('precioHora',0);
        }
        if($parametros['precio']!= null && $parametros['precio']!=0){
            if($parametros['precio']!=1)$query->setParameter('precio', $parametros['precio']);
            else $query->setParameter('precio',0);
        }
        if($parametros['duracionTotal']!= null && $parametros['duracionTotal']!=0)$query->setParameter('duracionTotal', $parametros['duracionTotal']);
        if($parametros['actividades']!= null && $parametros['actividades']!='0') $query->setParameter('actividades', 1);      
        if($proveedor || $cliente)$query->setParameter('idRelacionado', $idRelacionado);
        
        $array['elementos'] = $query->getResult();
        $array['dataPaginacion']['obtenidos'] = count( $array['elementos']);


        $query = $em->createQuery( $dqlTotales );

        if($parametros['localidad']!= null && $parametros['localidad']!=0) $query->setParameter('localidad', $parametros['localidad']);
        if($parametros['precioHora']!= null && $parametros['precioHora']!=0){
            if($parametros['precioHora']!=1)$query->setParameter('precioHora', $parametros['precioHora']);
            else $query->setParameter('precioHora',0);
        }
        if($parametros['precio']!= null && $parametros['precio']!=0){
            if($parametros['precio']!=1)$query->setParameter('precio', $parametros['precio']);
            else $query->setParameter('precio',0);
        }
        if($parametros['duracionTotal']!= null && $parametros['duracionTotal']!=0)$query->setParameter('duracionTotal', $parametros['duracionTotal']);
        if($parametros['actividades']!= null && $parametros['actividades']!='0') $query->setParameter('actividades', 1);      
        if($proveedor || $cliente)$query->setParameter('idRelacionado', $idRelacionado);

        $array['dataPaginacion']['total'] = intval($query->getSingleScalarResult());
        $array['dataPaginacion']['paginacion'] = $paginacion;
        $array['dataPaginacion']['numPaginacion'] = ceil($array['dataPaginacion']['total'] / $numResults);
        $array['dataPaginacion']['numResults'] = $numResults;

        return $array;
    }
    public function reservaAction($id) {
        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Evento') -> find($id);
        $reservas = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Reserva') -> findByEvento($object);

        $user = UtilitiesAPI::getActiveUser($this);
        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();

        $dql =  'SELECT COUNT(o1.id)
                 FROM ProyectoPrincipalBundle:Reserva o1, 
                      ProyectoPrincipalBundle:Evento o2
                 WHERE o1.evento = o2.id AND
                       o1.user = :idUser AND
                       o2.id = :id AND
                       o1.cancelado = :cancelado AND
                       o1.pagado = :pagado
                       ';

        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $idUser);
        $query->setParameter('id', $id);
        $query->setParameter('cancelado', false);
        $query->setParameter('pagado', false);
        $numeroReservacion = intval($query->getSingleScalarResult()) + 1;

        $secondArray = array('object'=>$object,'usuario'=>UtilitiesAPI::getActiveUser($this),'numeroReservacion'=>$numeroReservacion,'reservas'=>$reservas);

        $array = array_merge($firstArray, $secondArray);
        
        return $this -> render('ProyectoPrincipalBundle:Evento:reserva.html.twig', $array);
    }
  
    public function confirmacionAction($id){

        $em = $this->getDoctrine()->getManager();

        $firstArray = UtilitiesAPI::getDefaultContent($this);
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Evento') -> find($id);

        $user = UtilitiesAPI::getActiveUser($this);
        $idUser = $user->getId();

        $dql =  'SELECT o1.id,o1.fechaInicio, o1.fechaFin, o2.precioPorHora
                 FROM ProyectoPrincipalBundle:Reserva o1, 
                      ProyectoPrincipalBundle:Evento o2
                 WHERE o1.evento = o2.id AND
                       o1.user = :idUser AND
                       o2.id = :id AND
                       o1.cancelado = :cancelado AND
                       o1.pagado = :pagado
                       ';

        $query = $em->createQuery( $dql );
        $query->setParameter('idUser', $idUser);
        $query->setParameter('id', $id);
        $query->setParameter('cancelado', false);
        $query->setParameter('pagado', false);
        $reservas = $query->getResult();

        $data = array();
        $total = array('horas'=>0,'precio'=>0);

        for ($i=0; $i < count($reservas) ; $i++) { 
            # code...
            $data[$i]['id']= $reservas[$i]['id'];
            $data[$i]['fecha']= $reservas[$i]['fechaInicio']->format('d/m/Y');
            $data[$i]['horaComienzo']= $reservas[$i]['fechaInicio']->format('H:i');
            $data[$i]['horaFinalización']= $reservas[$i]['fechaFin']->format('H:i');
            $data[$i]['horas'] = intval($reservas[$i]['fechaFin']->format('H')) - intval($reservas[$i]['fechaInicio']->format('H'));

            if(intval($reservas[$i]['fechaInicio']->format('i'))!=0 || intval($reservas[$i]['fechaFin']->format('i'))!=0  ){
               $data[$i]['horas'] = $data[$i]['horas'] +1;
            }

            if($data[$i]['horas']==0)$data[$i]['horas']=24;

            $total['horas'] += $data[$i]['horas'];

            $data[$i]['precio'] = $data[$i]['horas'] * $reservas[$i]['precioPorHora'];

            $total['precio'] += $data[$i]['precio'];

        }

        $secondArray = array('object'=>$object,'reservas'=>$reservas,'data'=>$data,'total'=>$total);

        $array = array_merge($firstArray, $secondArray);

        return $this -> render('ProyectoPrincipalBundle:Evento:confirmacion.html.twig', $array);
    }
}
