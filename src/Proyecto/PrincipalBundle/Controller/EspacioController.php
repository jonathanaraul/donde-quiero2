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
use Proyecto\PrincipalBundle\Entity\Espacio;
use Proyecto\PrincipalBundle\Entity\Reserva;
use Proyecto\PrincipalBundle\Entity\Confirmacion;
use Proyecto\PrincipalBundle\Entity\ConfirmacionElemento;

class EspacioController extends Controller {


	public function individualAction($id) {
		$firstArray = UtilitiesAPI::getDefaultContent($this);

        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Espacio') -> find($id);
        $reservas = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Reserva') -> findByEspacio($object);
       
        $user = UtilitiesAPI::getActiveUser($this);
        if($user==null)$userId= 0;
        else $userId = $user->getId(); 
        $secondArray = array('object'=>$object,'reservas'=>$reservas,'userId'=>$userId);

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Espacio:individual.html.twig', $array);
	}
	public function grupalAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Espacio:grupal.html.twig', $array);
	}

	public function registrarAction(Request $request) {
		$id = null;
		$url = $this -> generateUrl('proyecto_principal_espacio_registrar');

		return EspacioController::registrarEditar($id ,$url, $request,$this);
	}
	public function editarAction(Request $request,$id) {

		$user = UtilitiesAPI::getActiveUser($this);
        $idUser = $user->getId();
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Espacio') -> find($id);

        if($object->getUser()->getId() != $idUser){
            $titulo = '¡Error 404...!';
            $mensaje = 'Estimado(a) '.ucfirst($user ->getNombre()) . ' '.ucfirst($user ->getApellido()) .' ud no tiene derechos para realizar esta edición.';
            $tituloBoton = 'Ir al inicio';
            $direccionBoton = $this->generateUrl('proyecto_principal_homepage');
            $array = array('titulo' => $titulo, 'mensaje' => $mensaje, 'tituloBoton'=>$tituloBoton, 'direccionBoton'=>$direccionBoton );
            return $this -> render('ProyectoPrincipalBundle:Default:mensaje.html.twig', $array);
        }
		$url = $this -> generateUrl('proyecto_principal_espacio_editar',array('id' => $id));

		return EspacioController::registrarEditar($id ,$url,$request, $this);

	}

	public static function registrarEditar($id ,$url,Request $request,$class) {
		if($id == null )$object = new Espacio();
		else $object = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Espacio') -> find($id);
		
		$firstArray = UtilitiesAPI::getDefaultContent($class);
		$secondArray = array();
		$user = UtilitiesAPI::getActiveUser($class);
		$provincias = HelpersController::getProvincias($class);
		$idProvincia = $user->getProvincia()->getId();

        $arregloSedes = GestionController::dqlArregloDoble('Sede',105,106, $class);


		$parametro = $user->getProvincia()->getId();
        $localidad =  $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Localidad') -> find($user->getIdLocalidad());

		$object->setLocalidad($localidad);


        $form = $class->createFormBuilder($object)
            ->add('jardineria', 'checkbox',array('required'  => false))
            ->add('propietarioEmpleado', 'checkbox',array('required'  => false))
            ->add('agenteComercial', 'checkbox',array('required'  => false))
            ->add('administradorWeb', 'checkbox',array('required'  => false))

            ->add('nombre', 'text')
            ->add('descripcionGeneral', 'textarea')
            -> add('sede', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Sede',
            'choices' => $arregloSedes,
            'property' => 'nombre',
            ))
			->add('file','file') 
            ->add('enlaceVideo', 'text')

            ->add('superficie')
            ->add('anchoMinimoLibre')
            ->add('largoMinimoLibre')
            ->add('alturaMinimaLibre')
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
            
            ->add('pilaresSueltos', 'checkbox',array('required'  => false))
            ->add('entradaAseosMovilidadReducida', 'checkbox',array('required'  => false))
            ->add('ventanasExterior', 'checkbox',array('required'  => false))
            ->add('ventanasPatioInterior', 'checkbox',array('required'  => false))
            ->add('posibilidadOscurecerSala', 'checkbox',array('required'  => false))
            
            ->add('otrasCaracteristicas', 'text')

            ->add('proyectorPantallaSala', 'checkbox',array('required'  => false))
            ->add('microfonoAltavoces', 'checkbox',array('required'  => false))
            ->add('videocamara', 'checkbox',array('required'  => false))
            ->add('wifi', 'checkbox',array('required'  => false))
            ->add('internetCable', 'checkbox',array('required'  => false))
            ->add('maquinaBebidas', 'checkbox',array('required'  => false))
            ->add('pizarra', 'checkbox',array('required'  => false))
            ->add('conserjeria', 'checkbox',array('required'  => false))
            ->add('aireAcondicionado', 'checkbox',array('required'  => false))
            ->add('calefaccion', 'checkbox',array('required'  => false))
            ->add('otrosServicios', 'text')

        	->add('precioPorHora','number',array('required'  => true))
            ->add('aceptacionReservaAutomatica', 'checkbox',array('required'  => false))
            ->add('tiempoMaximoAceptacionReservaAutomatica24h', 'checkbox',array('required'  => false))
            ->add('tiempoMaximoAceptacionReservaAutomatica48', 'checkbox',array('required'  => false))
            ->add('datosFacturacionPagoDelUsuario', 'checkbox',array('required'  => false))
            ->add('anadirDatosFacturacionPago', 'checkbox',array('required'  => false))
            ->add('todas', 'checkbox',array('required'  => false))
            ->add('similaresCentroRealiza', 'checkbox',array('required'  => false))
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

            ->add('aceptoCondicionesUsoPoliticaPrivacidad', 'checkbox',array('required'  => false))


            ->add('localidad', 'entity', array(
			    'class' => 'ProyectoPrincipalBundle:Localidad',
			    'property' => 'nombre',
			    'query_builder' => function(EntityRepository $er)use ( $parametro ) {


			        return $er->createQueryBuilder('u')
			            ->add('where', 'u.provincia = ?1')
			            ->orderBy('u.nombre', 'ASC')
			            ->setParameter(1, $parametro); // Sustituye ?1 por 100
			    },

			)

            )          

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
				if($object->getOtrasCaracteristicas()=='Otros...') $object->setOtrasCaracteristicas(null);
				if($object->getOtrosServicios()=='Otros...') $object->setOtrosServicios(null);
                if($object->getSede()->getId()==106) $object->setSede(null);

				$object -> setUser($user);	
                
                $object -> setDestacado(0);
                $object -> setEstado(1);  
                $object -> setSuspendido(0);  
    			
    			$em->persist($object);
				$em->flush();

				return $class->redirect($class->generateUrl('proyecto_principal_espacio_individual',array('id' => $object ->getId())));

    		}
	
	    }

        $secondArray = array('form' => $form->createView(),'url'=>$url,'idProvincia'=>$idProvincia,'provincias'=>$provincias);
		$array = array_merge($firstArray, $secondArray);

		return $class -> render('ProyectoPrincipalBundle:Espacio:registrarEditar.html.twig', $array);
	}
    public function destacadosAction($numResults)
    {
        $arreglo = array();
       

        $em = $this->getDoctrine()->getManager();

        $dql =  'SELECT o1.id,o1.nombre,o1.path, o1.superficie,o1.precioPorHora,o2.nombre localidad
                 FROM ProyectoPrincipalBundle:Espacio o1, ProyectoPrincipalBundle:Localidad o2 WHERE o1.localidad = o2.id and o1.destacado = 1 ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql )
                ->setMaxResults($numResults);

        $arreglo['destacados'] = $query->getResult();

        return $this->render('ProyectoPrincipalBundle:Espacio:destacados.html.twig', $arreglo);
    }
    public function widgetAction($titulo,$numResults,$paginacion,$proveedor,$cliente,$idRelacionado)
    {
		$arreglo = array();
       
        $em = $this->getDoctrine()->getManager();

        if($paginacion==1)$paginacion = true;
        else $paginacion = false;
        $arreglo = EspacioController::consultaBusqueda($numResults,0,null,$paginacion,$proveedor,$cliente,$idRelacionado);

        $dql =  'SELECT COUNT(o1.id) c,o2.id,o2.nombre 
                 FROM ProyectoPrincipalBundle:Espacio o1, 
                      ProyectoPrincipalBundle:Localidad o2
                 WHERE o1.localidad = o2.id and o2.id != 8175

        GROUP BY  o1.localidad order by c  desc';

        $query = $em->createQuery( $dql );
        $arreglo['localidades'] = $query->getResult();
       
        $fechaActual = UtilitiesAPI::obtenerFechaNormal($this);
        $arreglo['disponibilidad'][0] = array(  'valor'=> $fechaActual, 'dia'=> UtilitiesAPI::obtenerNombreDia($fechaActual,$this));
  
        for ($i=1; $i <= 6; $i++) { 
            $nuevaFecha = UtilitiesAPI::sumarTiempo($arreglo['disponibilidad'][$i-1]['valor'], 1, 0, 0, $this);
             $arreglo['disponibilidad'][$i] =   array(  
                'valor'=> $nuevaFecha,
                'dia'  =>UtilitiesAPI::obtenerNombreDia( $nuevaFecha,$this)
                                                      );
        }
        $arreglo['proveedor']= $proveedor;
        $arreglo['cliente']= $cliente;
        $arreglo['idRelacionado']= $idRelacionado;
        $arreglo['titulo']= $titulo;
        $arreglo['numResults']= $numResults;


        return $this->render('ProyectoPrincipalBundle:Espacio:widget.html.twig', $arreglo);
    }

    public function busquedaAction() {

        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;
        $em = $this->getDoctrine()->getManager();

        $precioHora = intval($post -> get("precio"));
        $actividades = trim($post -> get("actividades"));
        $disponibilidad = trim($post -> get("disponibilidad"));
        $superficie = intval($post -> get("superficie"));
        $modo = trim($post -> get("modo"));
        $localidad = intval($post -> get("localidad"));
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

        $parametros = array('precioHora'=>$precioHora,'actividades'=>$actividades,'superficie'=>$superficie,'modo'=>$modo,'localidad'=>$localidad, 'disponibilidad'=>$disponibilidad);

        $arreglo = EspacioController::consultaBusqueda($numResults,$indice,$parametros,$paginacion,$proveedor,$cliente,$idRelacionado);

        $htmlElementos = $this -> renderView('ProyectoPrincipalBundle:Espacio:elementos.html.twig', array('elementos'=>$arreglo['elementos']) );
        $htmlPaginacion = $this -> renderView('ProyectoPrincipalBundle:Espacio:paginacion.html.twig', array('dataPaginacion'=>$arreglo['dataPaginacion']));

        $respuesta = new response(json_encode(array('htmlElementos' => $htmlElementos,'htmlPaginacion' =>$htmlPaginacion)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }
    public function consultaBusqueda($numResults,$indice,$parametros,$paginacion,$proveedor,$cliente,$idRelacionado){

   
    $em = $this->getDoctrine()->getManager();
    $array = array();

    $dql =  'SELECT DISTINCT  o1.id,o1.nombre,o1.path, o1.superficie,o1.precioPorHora,o2.nombre localidad
                 FROM ProyectoPrincipalBundle:Espacio o1, ProyectoPrincipalBundle:Localidad o2 ';

    $dqlTotales =  'SELECT DISTINCT COUNT(DISTINCT o1.id) FROM ProyectoPrincipalBundle:Espacio o1 ';

    if($proveedor){
        $dql.= ', ProyectoUserBundle:User o3 ';
        $dqlTotales .=  ', ProyectoUserBundle:User o3 ';
    }

    $dql .= '   WHERE o1.id != 109  ';
    $dqlTotales .= '   WHERE o1.id != 109  ';

    $modoA = "";
    $modoB = "";
    $tieneWhere = true;
    $tieneWhereTotales = true;
    $fechaInicio = '';
    $fechaFin = '';

    if($parametros!=null){

        if($parametros['actividades']!= null && $parametros['actividades']!='0'){
            
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
           
            $dql.= ' o1.'.$parametros['actividades'].' = :actividades';
            $dqlTotales.= ' o1.'.$parametros['actividades'].' = :actividades';
            
        }
        if($parametros['precioHora']!= null && $parametros['precioHora']!=0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';

            if($parametros['precioHora']>1 && $parametros['precioHora']<=10000){
                $dql.= ' o1.precioPorHora <= :precioHora';
                $dqlTotales.= ' o1.precioPorHora <= :precioHora';
            }
            else if($parametros['precioHora']>10000){
                $dql.= ' o1.precioPorHora > :precioHora';
                $dqlTotales.=' o1.precioPorHora > :precioHora';
            }

        }
        if($parametros['superficie']!= null && $parametros['superficie']!=0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';

            if($parametros['superficie']>2000){
                $dql.= ' o1.superficie > :superficie';
                $dqlTotales.=' o1.superficie > :superficie';
            }
            else{
                $dql.= ' o1.superficie <= :superficie';
                $dqlTotales.= ' o1.superficie <= :superficie';
            }

        }
        if($parametros['modo']!= null && $parametros['modo']!='0-0'){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';

            $modoA = explode('-', $parametros['modo']);
            $modoB = intval($modoA[1]);
            $modoA = $modoA[0];

            $dql.= ' o1.'.$modoA.' >= :modoA ';
            $dqlTotales.= ' o1.'.$modoA.' >= :modoA ';
            
            if($modoB != 0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';


                if( $modoB==101){
                    $dql.= ' o1.'.$modoA.'Capacidad >= :modoB';
                    $dqlTotales.= ' o1.'.$modoA.'Capacidad >= :modoB';
                }
                else{
                    $dql.= ' o1.'.$modoA.'Capacidad <= :modoB';
                    $dqlTotales.= ' o1.'.$modoA.'Capacidad <= :modoB';
                }
            }
        }
        if($parametros['localidad']!= null && $parametros['localidad']!=0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';

            $dql.= ' o1.localidad = :localidad';
            $dqlTotales.=' o1.localidad = :localidad';

        }
        if($parametros['disponibilidad']!= null && $parametros['disponibilidad']!=0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';

            $auxiliar =  explode(' ', $parametros['disponibilidad']);
            $auxiliarFecha = explode('/', $auxiliar[0]);
            $dia =  $auxiliarFecha[0];
            $mes =  $auxiliarFecha[1];
            $anio =  $auxiliarFecha[2];
            $auxiliarHora = null;

            if(count($auxiliar)==1){
               $fechaInicio = $anio.'-'.$mes.'-'.$dia;
               $fechaFin = $anio.'-'.$mes.'-'.$dia;
               $fechaInicio .= ' 00:00:00';
               $fechaFin .= ' 23:59:59';
            }
            else{
               $fechaInicio = $anio.'-'.$mes.'-'.$dia;
               $fechaFin = $anio.'-'.$mes.'-';
               $auxiliarHora = explode('/', $auxiliar[1]);
               $fechaFin .= ($auxiliarHora[1]=='08') ? (intval($dia)+1) : $dia;
               $fechaInicio .= ' '.$auxiliarHora[0].':00:00';
               $fechaFin .= ' '.$auxiliarHora[1].':00:00';               
            }
            $dql.= ' o1.id NOT IN ( SELECT DISTINCT s1.id FROM ProyectoPrincipalBundle:Espacio s1, ProyectoPrincipalBundle:Reserva s3 WHERE s1.id = s3.espacio and s3.fechaInicio BETWEEN  :fechaInicio AND :fechaFin  or  s3.fechaFin BETWEEN  :fechaInicio AND :fechaFin AND s1.id = s3.espacio ) ';
            $dqlTotales.= ' o1.id NOT IN ( SELECT DISTINCT s1.id FROM ProyectoPrincipalBundle:Espacio s1, ProyectoPrincipalBundle:Reserva s3 WHERE s1.id = s3.espacio and s3.fechaInicio BETWEEN  :fechaInicio AND :fechaFin or s3.fechaFin BETWEEN  :fechaInicio AND :fechaFin AND s1.id = s3.espacio  ) ';

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
            ProyectoPrincipalBundle:Espacio r2, ProyectoUserBundle:User r3 WHERE r1.espacio = r2.id and r1.user = r3.id and r3.id = :idRelacionado ) ';
        
        if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
        $dqlTotales .=  ' o1.id IN ( SELECT DISTINCT r2.id FROM ProyectoPrincipalBundle:Reserva r1, 
            ProyectoPrincipalBundle:Espacio r2, ProyectoUserBundle:User r3 WHERE r1.espacio = r2.id and r1.user = r3.id and r3.id = :idRelacionado ) ';

    }

    $dql.= ' ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql )
        ->setMaxResults($numResults)
        ->setFirstResult($indice*$numResults);

        if($parametros['disponibilidad']!= null && $parametros['disponibilidad']!='0'){
            $query->setParameter('fechaInicio', $fechaInicio);
            $query->setParameter('fechaFin', $fechaFin);
        } 
        if($parametros['actividades']!= null && $parametros['actividades']!='0') $query->setParameter('actividades', 1);
        if($parametros['precioHora']!= null && $parametros['precioHora']!=0)  $query->setParameter('precioHora', $parametros['precioHora']);
        if($parametros['superficie']!= null && $parametros['superficie']!=0)  $query->setParameter('superficie', $parametros['superficie']);
        if($parametros['modo']!= null && $parametros['modo']!='0-0'){
           $query->setParameter('modoA', 1);
           if($modoB != 0)$query->setParameter('modoB', $modoB);
        }
        if($parametros['localidad']!= null && $parametros['localidad']!=0) $query->setParameter('localidad', $parametros['localidad']);
        if($proveedor || $cliente)$query->setParameter('idRelacionado', $idRelacionado);
        
        $array['elementos'] = $query->getResult();
        $array['dataPaginacion']['obtenidos'] = count( $array['elementos']);

        $query = $em->createQuery( $dqlTotales );

        if($parametros['disponibilidad']!= null && $parametros['disponibilidad']!='0'){
            $query->setParameter('fechaInicio', $fechaInicio);
            $query->setParameter('fechaFin', $fechaFin);
        } 
        if($parametros['actividades']!= null && $parametros['actividades']!='0') $query->setParameter('actividades', 1);
        if($parametros['precioHora']!= null && $parametros['precioHora']!=0)  $query->setParameter('precioHora', $parametros['precioHora']);
        if($parametros['superficie']!= null && $parametros['superficie']!=0)  $query->setParameter('superficie', $parametros['superficie']);
        if($parametros['modo']!= null && $parametros['modo']!='0-0'){
           $query->setParameter('modoA', 1);
           if($modoB != 0)$query->setParameter('modoB', $modoB);
        }
        if($parametros['localidad']!= null && $parametros['localidad']!=0) $query->setParameter('localidad', $parametros['localidad']);
        if($proveedor || $cliente)$query->setParameter('idRelacionado', $idRelacionado);

        $array['dataPaginacion']['total'] = intval($query->getSingleScalarResult());

        $array['dataPaginacion']['paginacion'] = $paginacion;
        $array['dataPaginacion']['numPaginacion'] = ceil($array['dataPaginacion']['total'] / $numResults);
        $array['dataPaginacion']['numResults'] = $numResults;


        return $array;
    }
    public function reservaAction($id) {
        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Espacio') -> find($id);
        $reservas = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Reserva') -> findByEspacio($object);

        $user = UtilitiesAPI::getActiveUser($this);
        $idUser = $user->getId();
        $em = $this->getDoctrine()->getManager();

        $dql =  'SELECT COUNT(o1.id)
                 FROM ProyectoPrincipalBundle:Reserva o1, 
                      ProyectoPrincipalBundle:Espacio o2
                 WHERE o1.espacio = o2.id AND
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
        
        return $this -> render('ProyectoPrincipalBundle:Espacio:reserva.html.twig', $array);
    }
  
    public function confirmacionAction($id){

        $em = $this->getDoctrine()->getManager();

        $firstArray = UtilitiesAPI::getDefaultContent($this);
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Espacio') -> find($id);

        $user = UtilitiesAPI::getActiveUser($this);
        $idUser = $user->getId();

        $dql =  'SELECT o1.id,o1.fechaInicio, o1.fechaFin, o2.precioPorHora
                 FROM ProyectoPrincipalBundle:Reserva o1, 
                      ProyectoPrincipalBundle:Espacio o2
                 WHERE o1.espacio = o2.id AND
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

        return $this -> render('ProyectoPrincipalBundle:Espacio:confirmacion.html.twig', $array);
    }

}
