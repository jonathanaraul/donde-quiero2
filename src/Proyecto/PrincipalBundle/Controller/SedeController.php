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
use Proyecto\PrincipalBundle\Entity\Sede;

class SedeController extends Controller {


	public function individualAction($id) {
        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Sede') -> find($id);
        $secondArray = array('object'=>$object);

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Sede:individual.html.twig', $array);
	}
	public function grupalAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Sede:grupal.html.twig', $array);
	}

	public function registrarAction(Request $request) {
		$id = null;
		$url = $this -> generateUrl('proyecto_principal_sede_registrar');

		return SedeController::registrarEditar($id ,$url, $request,$this);
	}
	public function editarAction(Request $request) {

		$user = UtilitiesAPI::getActiveUser($this);
		$id = $user->getId();
		$url = $this -> generateUrl('proyecto_principal_sede_editar');

		return SedeController::registrarEditar($id ,$url,$request, $this);

	}

	public static function registrarEditar($id ,$url,Request $request,$class) {
		if($id == null )$object = new Sede();
		else $object = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Sede') -> find($id);
		
		$firstArray = UtilitiesAPI::getDefaultContent($class);
		$secondArray = array();
		$user = UtilitiesAPI::getActiveUser($class);
		$provincias = HelpersController::getProvincias($class);
		$idProvincia = $user->getProvincia()->getId();

		$parametro = $user->getProvincia()->getId();
		$object->setLocalidad($user->getLocalidad());
		$object->setLatitud($user->getLocalidad()->getLatitud());
		$object->setLongitud($user->getLocalidad()->getLongitud());
		$latitud=$user->getLocalidad()->getLatitud();
		$longitud=$user->getLocalidad()->getLongitud();

        $form = $class->createFormBuilder($object)
            //
            ->add('propietarioEmpleado', 'checkbox',array('required'  => false))
            ->add('agenteComercial', 'checkbox',array('required'  => false))
            ->add('administradorWeb', 'checkbox',array('required'  => false))

            ->add('nombre', 'text')
            ->add('descripcionGeneral', 'textarea')
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
            ->add('latitud', 'hidden')
            ->add('longitud', 'hidden')

			->add('file','file') 
            ->add('enlaceVideo', 'text')

           
            ->add('enCentroCiudad', 'checkbox',array('required'  => false))
            ->add('cercaAutobus', 'checkbox',array('required'  => false))
            ->add('cercaAeropuerto', 'checkbox',array('required'  => false))
            ->add('accesibleMovilidadReducida', 'checkbox',array('required'  => false))

            ->add('colegioInstituto', 'checkbox',array('required'  => false))
            ->add('universidad', 'checkbox',array('required'  => false))
            ->add('otrosCentrosFormacion', 'checkbox',array('required'  => false))
            ->add('coWorking', 'checkbox',array('required'  => false))
            ->add('centroNegocios', 'checkbox',array('required'  => false))
            ->add('oficinaProfesional', 'checkbox',array('required'  => false))
            ->add('hotel', 'checkbox',array('required'  => false))
            ->add('restauranteBarDiscoteca', 'checkbox',array('required'  => false))
            ->add('finca', 'checkbox',array('required'  => false))
            ->add('colegioProfesional', 'checkbox',array('required'  => false))
            ->add('fundacionCentroCultural', 'checkbox',array('required'  => false))
            ->add('clubPrivadoAsociacion', 'checkbox',array('required'  => false))
            ->add('cineTeatro', 'checkbox',array('required'  => false))
            ->add('centroDeportivo', 'checkbox',array('required'  => false))
            ->add('centroFerial', 'checkbox',array('required'  => false))
            ->add('centroRecreativo', 'checkbox',array('required'  => false))
            ->add('centroComercial', 'checkbox',array('required'  => false))

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


				return $class->redirect($class->generateUrl('proyecto_principal_homepage'));

    		}
	
	    }

        $secondArray = array('form' => $form->createView(),'url'=>$url,'idProvincia'=>$idProvincia,
        	'provincias'=>$provincias,'latitud'=>$latitud,'longitud'=>$longitud);
		$array = array_merge($firstArray, $secondArray);
		return $class -> render('ProyectoPrincipalBundle:Sede:registrarEditar.html.twig', $array);
	}
   
    public function widgetAction($titulo,$numResults,$proveedor,$cliente,$idRelacionado)
    {
        $secondArray = array();
        $em = $this->getDoctrine()->getManager();
        $tieneWhere = false;
        $dql =  'SELECT COUNT(o1.id) c,o2.id,o2.nombre 
                 FROM ProyectoPrincipalBundle:Sede o1, 
                      ProyectoPrincipalBundle:Localidad o2 ';

        if($proveedor){
            $dql .=  ', ProyectoPrincipalBundle:User o3  WHERE o1.user = o3.id and o3.id = :idRelacionado';
            $tieneWhere = true;
        }
        if($cliente){
            $dql.= ' WHERE o1.id IN ( SELECT DISTINCT r2.id FROM ProyectoPrincipalBundle:Reserva r1, 
            ProyectoPrincipalBundle:Sede r2, ProyectoPrincipalBundle:User r3 WHERE r1.sede = r2.id and r1.user = r3.id and r3.id = :idRelacionado ) ';
            $tieneWhere = true;
        }

        if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';

        $dql .=  'o1.localidad = o2.id  and o2.id != 8175 GROUP BY  o1.localidad order by c  desc';

        $query = $em->createQuery( $dql );
        if($proveedor || $cliente)$query->setParameter('idRelacionado', $idRelacionado);
        $secondArray['localidades'] = $query->getResult();

        $secondArray['proveedor']= $proveedor;
        $secondArray['cliente']= $cliente;
        $secondArray['idRelacionado']= $idRelacionado;
        $secondArray['titulo']= $titulo;

        return $this->render('ProyectoPrincipalBundle:Sede:widget.html.twig', $secondArray);
    }
    public function busquedaAction() {
        $peticion = $this -> getRequest();
        $doctrine = $this -> getDoctrine();
        $post = $peticion -> request;
        $em = $this->getDoctrine()->getManager();

        //selectores
        $localidad = intval($post -> get("localidad"));
        $accesibilidad = intval($post -> get("accesibilidad"));
        $precioHora = intval($post -> get("precio"));
        $modo = trim($post -> get("modo"));
        $tipoSede = intval($post -> get("tiposede"));
        $actividades = trim($post -> get("actividades"));

        $proveedor = intval($post -> get("proveedor"));
        $cliente = intval($post -> get("cliente"));
        $idRelacionado = intval($post -> get("idRelacionado"));

        if($proveedor==0)$proveedor = false;
        if($cliente==0)$cliente = false;

        $parametros = array('accesibilidad'=>$accesibilidad,'tipoSede'=>$tipoSede,'precioHora'=>$precioHora,'actividades'=>$actividades,'modo'=>$modo,'localidad'=>$localidad);
        //echo 'el indice es'.$indice;
        //exit;
        $arreglo = SedeController::consultaBusqueda($parametros,$paginacion,$proveedor,$cliente,$idRelacionado);



        $respuesta = new response(json_encode(array('arreglo' => $arreglo)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }
    public function consultaBusqueda($parametros){

   
    $em = $this->getDoctrine()->getManager();
    $array = array();

    $dql =  'SELECT o1.id,o1.nombre,o1.path, o1.latitud,o1.longitud,o2.nombre localidad
                 FROM ProyectoPrincipalBundle:Sede o1, ProyectoPrincipalBundle:Localidad o2 ';

    $dqlTotales =  'SELECT COUNT(o1.id) FROM ProyectoPrincipalBundle:Sede o1 ';


    $dql .= '   WHERE o1.id != 105  ';
    $dqlTotales .= '   WHERE o1.id != 105  ';

    $modoA = "";
    $modoB = "";
    $tieneWhere = false;
    $tieneWhereTotales = false;

    if($parametros!=null){


        if($parametros['localidad']!= null && $parametros['localidad']!=0){

            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';

                $dql.= ' o1.localidad = :localidad';
                $dqlTotales.=' o1.localidad = :localidad';
        }
        if($parametros['accesibilidad']!= null && $parametros['accesibilidad']!='0'){
            
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
           
            $dql.= ' o1.'.$parametros['accesibilidad'].' = :accesibilidad';
            $dqlTotales.= ' o1.'.$parametros['accesibilidad'].' = :accesibilidad';
            
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
        if($parametros['tipoSede']!= null && $parametros['tipoSede']!='0'){
            
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
           
            $dql.= ' o1.'.$parametros['tipoSede'].' = :tipoSede';
            $dqlTotales.= ' o1.'.$parametros['tipoSede'].' = :tipoSede';
            
        }
        if($parametros['actividades']!= null && $parametros['actividades']!='0'){
            
            if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
            if(!$tieneWhereTotales){$dqlTotales.= ' WHERE ';$tieneWhereTotales= true; }else $dqlTotales.= ' AND ';
           
            $dql.= ' o1.'.$parametros['actividades'].' = :actividades';
            $dqlTotales.= ' o1.'.$parametros['actividades'].' = :actividades';
            
        }



         
    }

    if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
    $dql.= ' o1.localidad = o2.id ORDER BY o1.id ASC';

        $query = $em->createQuery( $dql );

        if($parametros['accesibilidad']!= null && $parametros['accesibilidad']!='0') $query->setParameter('accesibilidad', 1);
        if($parametros['tipoSede']!= null && $parametros['tipoSede']!='0') $query->setParameter('tipoSede', 1);
        if($parametros['actividades']!= null && $parametros['actividades']!='0') $query->setParameter('actividades', 1);
        if($parametros['precioHora']!= null && $parametros['precioHora']!=0)  $query->setParameter('precioHora', $parametros['precioHora']);
        if($parametros['modo']!= null && $parametros['modo']!='0-0'){
           $query->setParameter('modoA', 1);
           if($modoB != 0)$query->setParameter('modoB', $modoB);
        }
        if($parametros['localidad']!= null && $parametros['localidad']!=0) $query->setParameter('localidad', $parametros['localidad']);


        $array['elementos'] = $query->getResult();
        $array['dataPaginacion']['obtenidos'] = count( $array['elementos']);


        $query = $em->createQuery( $dqlTotales );

        if($parametros['accesibilidad']!= null && $parametros['accesibilidad']!='0') $query->setParameter('accesibilidad', 1);
        if($parametros['tipoSede']!= null && $parametros['tipoSede']!='0') $query->setParameter('tipoSede', 1);
        if($parametros['actividades']!= null && $parametros['actividades']!='0') $query->setParameter('actividades', 1);
        if($parametros['precioHora']!= null && $parametros['precioHora']!=0)  $query->setParameter('precioHora', $parametros['precioHora']);
        if($parametros['modo']!= null && $parametros['modo']!='0-0'){
           $query->setParameter('modoA', 1);
           if($modoB != 0)$query->setParameter('modoB', $modoB);
        }
        if($parametros['localidad']!= null && $parametros['localidad']!=0) $query->setParameter('localidad', $parametros['localidad']);

        $array['dataPaginacion']['total'] = intval($query->getSingleScalarResult());

        //var_dump( $array['dataPaginacion']);
        //exit;

        return $array;
    }
}
