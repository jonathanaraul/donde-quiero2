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
use Proyecto\PrincipalBundle\Entity\Servicio;
use Proyecto\PrincipalBundle\Entity\Reserva;
use Proyecto\PrincipalBundle\Entity\Confirmacion;
use Proyecto\PrincipalBundle\Entity\ConfirmacionElemento;

class ServicioController extends Controller {


	public function individualAction($id) {
        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Servicio') -> find($id);
        $reservas = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Reserva') -> findByServicio($object);

        $user = UtilitiesAPI::getActiveUser($this);
        $secondArray = array('object'=>$object,'reservas'=>$reservas,'userId'=>$user->getId());

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Servicio:individual.html.twig', $array);
	}
	public function grupalAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Servicio:grupal.html.twig', $array);
	}

	public function registrarAction(Request $request) {
		$id = null;
		$url = $this -> generateUrl('proyecto_principal_servicio_registrar');

		return ServicioController::registrarEditar($id ,$url, $request,$this);
	}
	public function editarAction(Request $request,$id) {

		$user = UtilitiesAPI::getActiveUser($this);
        $idUser = $user->getId();
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Servicio') -> find($id);

        if($object->getUser()->getId() != $idUser){
            $titulo = '¡Error 404...!';
            $mensaje = 'Estimado(a) '.ucfirst($user ->getNombre()) . ' '.ucfirst($user ->getApellido()) .' ud no tiene derechos para realizar esta edición.';
            $tituloBoton = 'Ir al inicio';
            $direccionBoton = $this->generateUrl('proyecto_principal_homepage');
            $array = array('titulo' => $titulo, 'mensaje' => $mensaje, 'tituloBoton'=>$tituloBoton, 'direccionBoton'=>$direccionBoton );
            return $this -> render('ProyectoPrincipalBundle:Default:mensaje.html.twig', $array);
        }
		$url = $this -> generateUrl('proyecto_principal_servicio_editar',array('id' => $id));

		return ServicioController::registrarEditar($id ,$url,$request, $this);

	}

	public static function registrarEditar($id ,$url,Request $request,$class) {
		if($id == null )$object = new Servicio();
		else $object = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Servicio') -> find($id);
		
		$firstArray = UtilitiesAPI::getDefaultContent($class);
		$secondArray = array();
		$user = UtilitiesAPI::getActiveUser($class);


        $form = $class->createFormBuilder($object)

            ->add('propietarioEmpleado', 'checkbox',array('required'  => false))
            ->add('agenteComercial', 'checkbox',array('required'  => false))
            ->add('administradorWeb', 'checkbox',array('required'  => false))


            ->add('nombre', 'text')
            ->add('descripcionGeneral', 'textarea')
			->add('file','file') 
            ->add('enlaceVideo', 'text')


            ->add('ofrecidosTodos', 'checkbox',array('required'  => false))
            ->add('sedePropiosEventos', 'checkbox',array('required'  => false))
            ->add('empresaEventosOtros', 'checkbox',array('required'  => false))


            ->add('todosMultimedia', 'checkbox',array('required'  => false))
            ->add('grabacionEdicionVideo', 'checkbox',array('required'  => false))
            ->add('fotografoEvento', 'checkbox',array('required'  => false))
            ->add('alquilerCamaras', 'checkbox',array('required'  => false))
            ->add('alquilerPortatiles', 'checkbox',array('required'  => false))
            ->add('alquilerProyectoresPantallas', 'checkbox',array('required'  => false))
            ->add('sonidoMicrofonoAltavoces', 'checkbox',array('required'  => false))
            ->add('iluminacion', 'checkbox',array('required'  => false))


            ->add('todosMejoraEspacios', 'checkbox',array('required'  => false))
            ->add('decoracionAccesorios', 'checkbox',array('required'  => false))
            ->add('floristeria', 'checkbox',array('required'  => false))
            ->add('disenioExposicionesTemporales', 'checkbox',array('required'  => false))
            ->add('montajeExposicion', 'checkbox',array('required'  => false))
            ->add('escenografia', 'checkbox',array('required'  => false))
            ->add('rehabilitacionArquitectnica', 'checkbox',array('required'  => false))
            ->add('limpiezaNormalIntensivo', 'checkbox',array('required'  => false))
            ->add('seguros', 'checkbox',array('required'  => false))


            ->add('todosMejoradeContenidos', 'checkbox',array('required'  => false))
            ->add('impresionGrabacionDocs', 'checkbox',array('required'  => false))
            ->add('transporteMercancias', 'checkbox',array('required'  => false))
            ->add('envios', 'checkbox',array('required'  => false))
            ->add('mobiliarioAulaTallerRecepcion', 'checkbox',array('required'  => false))
            ->add('accesoriosFormacionPizarras', 'checkbox',array('required'  => false))
            ->add('papeleriaNormalCorporativa', 'checkbox',array('required'  => false))
            ->add('internetCable', 'checkbox',array('required'  => false))
            ->add('internetWifiContenidos', 'checkbox',array('required'  => false))
            ->add('animacion', 'checkbox',array('required'  => false))
            ->add('interpretacionMusical', 'checkbox',array('required'  => false))
            ->add('interpretacionTeatral', 'checkbox',array('required'  => false))


            ->add('todosServicioAsistentes', 'checkbox',array('required'  => false))
            ->add('catering', 'checkbox',array('required'  => false))
            ->add('azafatas', 'checkbox',array('required'  => false))
            ->add('recepcionista', 'checkbox',array('required'  => false))
            ->add('traduccion', 'checkbox',array('required'  => false))
            ->add('interpretes', 'checkbox',array('required'  => false))
            ->add('receptoresAuricularEscucharInterprete', 'checkbox',array('required'  => false))
            ->add('alojamiento', 'checkbox',array('required'  => false))
            ->add('internetWifiAsistentes', 'checkbox',array('required'  => false))
            ->add('viaje', 'checkbox',array('required'  => false))
            ->add('transporteLocalAsistentes', 'checkbox',array('required'  => false))
            ->add('guiaAcompanianteAsistentes', 'checkbox',array('required'  => false))

            ->add('todosImagenCorporativa', 'checkbox',array('required'  => false))
            ->add('logosDocsCorporativos', 'checkbox',array('required'  => false))
            ->add('webEventoSede', 'checkbox',array('required'  => false))
            ->add('impresionGrabacion', 'checkbox',array('required'  => false))
            ->add('repartoPublicitario', 'checkbox',array('required'  => false))
            ->add('posicionamiento', 'checkbox',array('required'  => false))
            ->add('communityManagement', 'checkbox',array('required'  => false))
            ->add('difusionInternet', 'checkbox',array('required'  => false))
            ->add('difusionOtrosMedios', 'checkbox',array('required'  => false))
            ->add('emisionOnlinePaginaEvento', 'checkbox',array('required'  => false))


            ->add('aceptacionReservaAutomatica', 'checkbox',array('required'  => false))
            ->add('tiempoMaximoAceptacionReservaAutomatica24h', 'checkbox',array('required'  => false))
            ->add('tiempoMaximoAceptacionReservaAutomatica48', 'checkbox',array('required'  => false))
            ->add('datosFacturacionPagoDelUsuario', 'checkbox',array('required'  => false))
            ->add('anadirDatosFacturacionPago', 'checkbox',array('required'  => false))
            ->add('aceptoCondicionesUsoPoliticaPrivacidad', 'checkbox',array('required'  => false))
        	->add('precioPorHora','number',array('required'  => true))

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

                return $class->redirect($class->generateUrl('proyecto_principal_servicio_individual',array('id' => $object ->getId())));

    		}
	
	    }

        $secondArray = array('form' => $form->createView(),'url'=>$url);
		$array = array_merge($firstArray, $secondArray);
		return $class -> render('ProyectoPrincipalBundle:Servicio:registrarEditar.html.twig', $array);
	}
    public function destacadosAction($numResults)
    {
        $arreglo = array();
       

        $em = $this->getDoctrine()->getManager();

        $dql =  'SELECT o1.id,o1.nombre,o1.path,o1.precioPorHora FROM ProyectoPrincipalBundle:Servicio o1  WHERE o1.destacado = 1 
                 ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql )
                ->setMaxResults($numResults);

        $arreglo['destacados'] = $query->getResult();


        return $this->render('ProyectoPrincipalBundle:Servicio:destacados.html.twig', $arreglo);
    }
    public function widgetAction($titulo,$numResults,$paginacion,$proveedor,$cliente,$idRelacionado)
    {
        $arreglo = array();
       

        $em = $this->getDoctrine()->getManager();

        if($paginacion==1)$paginacion = true;
        else $paginacion = false;
        $arreglo = ServicioController::consultaBusqueda($numResults,0,null,$paginacion,$proveedor,$cliente,$idRelacionado);

        $arreglo['proveedor']= $proveedor;
        $arreglo['cliente']= $cliente;
        $arreglo['idRelacionado']= $idRelacionado;
        $arreglo['titulo']= $titulo;
        $arreglo['numResults']= $numResults;

        return $this->render('ProyectoPrincipalBundle:Servicio:widget.html.twig', $arreglo);
    }

    public function busquedaAction() {

        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;
        $em = $this->getDoctrine()->getManager();

        $ofrecidosPor = trim($post -> get("ofrecidosPor"));
        $multimedia = trim($post -> get("multimedia"));
        $mejoraEspacios = trim($post -> get("mejoraEspacios"));
        $mejoraContenidos = trim($post -> get("mejoraContenidos"));
        $servicioAsistentes = trim($post -> get("servicioAsistentes"));
        $imagenCorporativa = trim($post -> get("imagenCorporativa"));

        
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

        $parametros = array('ofrecidosPor'=>$ofrecidosPor,'multimedia'=>$multimedia,'mejoraEspacios'=>$mejoraEspacios,
                            'mejoraContenidos'=>$mejoraContenidos,'servicioAsistentes'=>$servicioAsistentes,'imagenCorporativa'=>$imagenCorporativa);

        $arreglo = ServicioController::consultaBusqueda($numResults,$indice,$parametros,$paginacion,$proveedor,$cliente,$idRelacionado);

        $htmlElementos = $this -> renderView('ProyectoPrincipalBundle:Servicio:elementos.html.twig', array('elementos'=>$arreglo['elementos']) );
        $htmlPaginacion = $this -> renderView('ProyectoPrincipalBundle:Servicio:paginacion.html.twig', array('dataPaginacion'=>$arreglo['dataPaginacion']));

        $respuesta = new response(json_encode(array('htmlElementos' => $htmlElementos,'htmlPaginacion' =>$htmlPaginacion)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }
    public function consultaBusqueda($numResults,$indice,$parametros,$paginacion,$proveedor,$cliente,$idRelacionado){

   
    $em = $this->getDoctrine()->getManager();
    $array = array();

    $dql =  'SELECT o1.id,o1.nombre,o1.path,o1.precioPorHora FROM ProyectoPrincipalBundle:Servicio o1';
    $dqlTotales =  'SELECT COUNT(o1.id) FROM ProyectoPrincipalBundle:Servicio o1 ';

    if($proveedor){
        $dql.= ', ProyectoPrincipalBundle:User o3 ';
        $dqlTotales .=  ', ProyectoPrincipalBundle:User o3 ';
    }

    $dql .= '   WHERE o1.id != 103  ';
    $dqlTotales .= '   WHERE o1.id != 103  ';

    $modoA = "";
    $modoB = "";
    $tieneWhere = false;
    $tieneWhereTotales = false;

    if($parametros!=null){
        
        if($parametros['ofrecidosPor']!= null && $parametros['ofrecidosPor']!='0'){
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
            $dql.= ' o1.'.$parametros['ofrecidosPor'].' = :ofrecidosPor';
            $dqlTotales.= ' o1.'.$parametros['ofrecidosPor'].' = :ofrecidosPor';
        }
        if($parametros['multimedia']!= null && $parametros['multimedia']!='0'){
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
            $dql.= ' o1.'.$parametros['multimedia'].' = :multimedia';
            $dqlTotales.= ' o1.'.$parametros['multimedia'].' = :multimedia';
        }
        if($parametros['mejoraEspacios']!= null && $parametros['mejoraEspacios']!='0'){
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
            $dql.= ' o1.'.$parametros['mejoraEspacios'].' = :mejoraEspacios';
            $dqlTotales.= ' o1.'.$parametros['mejoraEspacios'].' = :mejoraEspacios';
        }
        if($parametros['mejoraContenidos']!= null && $parametros['mejoraContenidos']!='0'){
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
            $dql.= ' o1.'.$parametros['mejoraContenidos'].' = :mejoraContenidos';
            $dqlTotales.= ' o1.'.$parametros['mejoraContenidos'].' = :mejoraContenidos';
        }
        if($parametros['servicioAsistentes']!= null && $parametros['servicioAsistentes']!='0'){
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
            $dql.= ' o1.'.$parametros['servicioAsistentes'].' = :servicioAsistentes';
            $dqlTotales.= ' o1.'.$parametros['servicioAsistentes'].' = :servicioAsistentes';
        }
        if($parametros['imagenCorporativa']!= null && $parametros['imagenCorporativa']!='0'){
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
            $dql.= ' o1.'.$parametros['imagenCorporativa'].' = :imagenCorporativa';
            $dqlTotales.= ' o1.'.$parametros['imagenCorporativa'].' = :imagenCorporativa';
        }

    }

    if($proveedor){
        if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
        $dql.= ' o1.user = o3.id and o3.id = :idRelacionado ';
        
        if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
        $dqlTotales .=  ' o1.user = o3.id and o3.id = :idRelacionado ';
    }

    if($cliente){
        if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
        $dql.= ' o1.id IN ( SELECT DISTINCT r2.id FROM ProyectoPrincipalBundle:Reserva r1, 
            ProyectoPrincipalBundle:Servicio r2, ProyectoPrincipalBundle:User r3 WHERE r1.servicio = r2.id and r1.user = r3.id and r3.id = :idRelacionado ) ';
        
        if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
        $dqlTotales .=  ' o1.id IN ( SELECT DISTINCT r2.id FROM ProyectoPrincipalBundle:Reserva r1, 
            ProyectoPrincipalBundle:Servicio r2, ProyectoPrincipalBundle:User r3 WHERE r1.servicio = r2.id and r1.user = r3.id and r3.id = :idRelacionado ) ';

    }

    $dql.= ' ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql )
        ->setMaxResults($numResults)
        ->setFirstResult($indice*$numResults);

        if($parametros['ofrecidosPor']!= null && $parametros['ofrecidosPor']!='0') $query->setParameter('ofrecidosPor', 1);
        if($parametros['multimedia']!= null && $parametros['multimedia']!='0') $query->setParameter('multimedia', 1);
        if($parametros['mejoraEspacios']!= null && $parametros['mejoraEspacios']!='0') $query->setParameter('mejoraEspacios', 1);
        if($parametros['mejoraContenidos']!= null && $parametros['mejoraContenidos']!='0') $query->setParameter('mejoraContenidos', 1);
        if($parametros['servicioAsistentes']!= null && $parametros['servicioAsistentes']!='0') $query->setParameter('servicioAsistentes', 1);
        if($parametros['imagenCorporativa']!= null && $parametros['imagenCorporativa']!='0') $query->setParameter('imagenCorporativa', 1);
        if($proveedor || $cliente)$query->setParameter('idRelacionado', $idRelacionado);

        $array['elementos'] = $query->getResult();
        $array['dataPaginacion']['obtenidos'] = count( $array['elementos']);


        $query = $em->createQuery( $dqlTotales );

        if($parametros['ofrecidosPor']!= null && $parametros['ofrecidosPor']!='0') $query->setParameter('ofrecidosPor', 1);
        if($parametros['multimedia']!= null && $parametros['multimedia']!='0') $query->setParameter('multimedia', 1);
        if($parametros['mejoraEspacios']!= null && $parametros['mejoraEspacios']!='0') $query->setParameter('mejoraEspacios', 1);
        if($parametros['mejoraContenidos']!= null && $parametros['mejoraContenidos']!='0') $query->setParameter('mejoraContenidos', 1);
        if($parametros['servicioAsistentes']!= null && $parametros['servicioAsistentes']!='0') $query->setParameter('servicioAsistentes', 1);
        if($parametros['imagenCorporativa']!= null && $parametros['imagenCorporativa']!='0') $query->setParameter('imagenCorporativa', 1);
        if($proveedor || $cliente)$query->setParameter('idRelacionado', $idRelacionado);
        
        $array['dataPaginacion']['total'] = intval($query->getSingleScalarResult());

        $array['dataPaginacion']['paginacion'] = $paginacion;
        $array['dataPaginacion']['numPaginacion'] = ceil($array['dataPaginacion']['total'] / $numResults);
        $array['dataPaginacion']['numResults'] = $numResults;

        return $array;
    }
    public function reservaAction($id) {
        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Servicio') -> find($id);
        $reservas = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Reserva') -> findByServicio($object);

        $user = UtilitiesAPI::getActiveUser($this);
        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();

        $dql =  'SELECT COUNT(o1.id)
                 FROM ProyectoPrincipalBundle:Reserva o1, 
                      ProyectoPrincipalBundle:Servicio o2
                 WHERE o1.servicio = o2.id AND
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
        
        return $this -> render('ProyectoPrincipalBundle:Servicio:reserva.html.twig', $array);
    }
  
    public function confirmacionAction($id){

        $em = $this->getDoctrine()->getManager();

        $firstArray = UtilitiesAPI::getDefaultContent($this);
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Servicio') -> find($id);

        $user = UtilitiesAPI::getActiveUser($this);
        $idUser = $user->getId();

        $dql =  'SELECT o1.id,o1.fechaInicio, o1.fechaFin, o2.precioPorHora
                 FROM ProyectoPrincipalBundle:Reserva o1, 
                      ProyectoPrincipalBundle:Servicio o2
                 WHERE o1.servicio = o2.id AND
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

        return $this -> render('ProyectoPrincipalBundle:Servicio:confirmacion.html.twig', $array);
    }
}
