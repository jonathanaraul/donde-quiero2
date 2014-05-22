<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Doctrine\ORM\EntityRepository;

use Proyecto\PrincipalBundle\Entity\User;
use Proyecto\PrincipalBundle\Entity\Espacio;
use Proyecto\PrincipalBundle\Entity\Servicio;
use Proyecto\PrincipalBundle\Entity\Evento;
use Proyecto\PrincipalBundle\Entity\Sede;
use Proyecto\PrincipalBundle\Entity\Reserva;
use Proyecto\PrincipalBundle\Entity\Localidad;
use Proyecto\PrincipalBundle\Entity\Confirmacion;
use Proyecto\PrincipalBundle\Entity\ConfirmacionElemento;


class GestionController extends Controller {

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

        if($tipo=='usuario')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:User') -> find($identificador);
        else if($tipo=='espacio')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Espacio') -> find($identificador);
        else if($tipo=='sede')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Sede') -> find($identificador);
        else if($tipo=='evento')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Evento') -> find($identificador);
        else if($tipo=='servicio')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Servicio') -> find($identificador);
        else if($tipo=='ingreso')
        $object = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Reserva') -> find($identificador);

        if($tarea=='estado')$object->setEstado($valor);
        else if($tarea=='rol')$object->setRol($valor);
        else if($tarea=='destacado')$object->setDestacado($valor);
        else if($tarea=='suspendido')$object->setSuspendido($valor);
        else if($tarea=='cancelado')$object->setCancelado($valor);


        $em->persist($object);
        $em->flush();

        $respuesta = new response(json_encode(array('estado' => true)));
        $respuesta -> headers -> set('content_type', 'aplication/json');
        return $respuesta;
    }
    public static function dqlFiltro($tipo,$dql,$elemento,$nombre,$tieneWhere, $class){

        if($tipo=='objeto'){
            if (!($elemento==null)) {
                if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
                $dql .= " o.".$nombre." = :".$nombre." ";
            }
        }
        else if($tipo=='texto'){
            if (!(trim($elemento) == false)) {
                if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
                $dql .= " o.".$nombre." like :".$nombre." ";

            }
        }
        else if($tipo=='booleano'){
            if (is_numeric($elemento) && intval($elemento)>0) {
                if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';
                $dql .= " o.".$nombre." = :".$nombre." ";
            }
        }

        return array('dql' => $dql, 'tieneWhere'=>$tieneWhere);

    } 
    public static function dqlArreglo($EntidadExtraer,$endidadRelacionada,$idProhibido, $class){
        $em = $class->getDoctrine()->getManager();

        /////////////////////USUARIOS///////////////////////////////////////////////////////
        $dql =  'SELECT distinct o1
                 FROM ProyectoPrincipalBundle:'.$EntidadExtraer.' o1, ProyectoPrincipalBundle:'.$endidadRelacionada.' o2
                 WHERE o2.'.strtolower($EntidadExtraer).' = o1.id
                 ORDER BY o1.nombre ASC';

        $query = $em->createQuery( $dql );

        $arreglo = $query->getResult();

       // var_dump($arregloUsuarios);exit;

        $auxiliar = $class -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:'.$EntidadExtraer) -> find($idProhibido);
        $auxiliar = array( $auxiliar );
        for ($i=0; $i <count($arreglo) ; $i++) { 
            $auxiliar[$i+1] =$arreglo[$i];
        }
        $arreglo =  $auxiliar;

        return $arreglo;

    } 
	public function ingresosAction(Request $request) {

		$firstArray = UtilitiesAPI::getDefaultContent($this);


        $em = $this->getDoctrine()->getManager();

        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $connection = $em->getConnection();
        $sql ="SELECT MONTH( o1.fechaRegistro ) AS mes, SUM( o1.precioTotal ) AS cantidad FROM  Confirmacion o1  GROUP BY MONTH( o1.fechaRegistro )";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();

        $grafico =  array();
        $sumatoria = 0;

        for ($i=0; $i < count($results) ; $i++) { 
        	# code...
        	$grafico['data'][$i] = intval($results[$i]['cantidad']);
        	$sumatoria +=  $grafico['data'][$i];
        	$grafico['mes'][$i] = $meses[intval($results[$i]['mes'])-1];
        }
		// Chart
        $series = array(
        	array("name" => "Sumatoria de montos por mes €",    "data" => $grafico['data'])
        	);
        $categories = $grafico['mes'];

		$ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Variación de las confirmaciones de reservas en el tiempo - Total: '.$sumatoria.' €');
        $ob->xAxis->title(array('text'  => "Fechas"));
        $ob->yAxis->title(array('text'  => "Montos procesados de confirmaciones  €"));
        $ob->xAxis->categories($categories);
        $ob->series($series);
        
        //WIDGET
        $url = $this -> generateUrl('proyecto_perfil_reservas');
        //$form = null;       
        $filtros = null;
        $filtros['pagado'] = array(0=> 'Pagado',1 => 'Si', 2 => 'No');
        $filtros['aprobado'] = array(0=> 'Aprobado',1 => 'Si', 2 => 'No');
        $filtros['cancelado'] = array(0=> 'Cancelado',1 => 'Si', 2 => 'No');

        $arregloUsuarios = GestionController::dqlArreglo('User','Reserva',39, $this);
        $arregloEspacios = GestionController::dqlArreglo('Espacio','Reserva',109, $this);
        $arregloSedes = GestionController::dqlArreglo('Sede','Reserva',105, $this);
        $arregloEventos = GestionController::dqlArreglo('Evento','Reserva',103, $this);
        $arregloServicios = GestionController::dqlArreglo('Servicio','Reserva',103, $this);

        $data = new Reserva();
        $form = $this -> createFormBuilder($data) 
        -> setAction($this->generateUrl('proyecto_principal_gestion'))
        -> setMethod('POST')
        -> add('user', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:User',
            'choices' => $arregloUsuarios,
            'property' => 'nombre',
            ))
        -> add('espacio', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Espacio',
            'choices' => $arregloEspacios,
            'property' => 'nombre',
            ))
        -> add('sede', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Sede',
            'choices' => $arregloSedes,
            'property' => 'nombre',
            ))
        -> add('servicio', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Servicio',
            'choices' => $arregloServicios,
            'property' => 'nombre',
            ))
        -> add('evento', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Evento',
            'choices' => $arregloEventos,
            'property' => 'nombre',
            ))
        -> add('pagado', 'choice', array('choices' => $filtros['pagado'], 'required' => true, ))
        -> getForm();


        $form->handleRequest($request);

        if ($form->isValid()) {

            $dql = "SELECT o FROM ProyectoPrincipalBundle:Reserva o ";
            $tieneWhere = false;
            
            if($data -> getUser()->getId()!=39){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getUser(),'user',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }
            if($data -> getEspacio()->getId()!=109){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getEspacio(),'espacio',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }
            if($data -> getSede()->getId()!=105){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getSede(),'sede',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }
            if($data -> getServicio()->getId()!=103){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getServicio(),'servicio',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }
            if($data -> getEvento()->getId()!=103){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getEvento(),'evento',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getPagado(),'pagado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            
            $dql .= ' ORDER BY o.id  ASC  ';
            $query = $em -> createQuery($dql);
            
            if (!($data -> getUser()==null) && $data -> getUser()->getId()!=39) {
                $query -> setParameter('user',$data -> getUser()->getId());
            }
            if (!($data -> getEspacio()==null) && $data -> getEspacio()->getId()!=109) {
                $query -> setParameter('espacio',$data -> getEspacio()->getId());
            }
            if (!($data -> getSede()==null) && $data -> getSede()->getId()!=105) {
                $query -> setParameter('sede',$data -> getSede()->getId());
            }
            if (!($data -> getServicio()==null) && $data -> getServicio()->getId()!=103) {
                $query -> setParameter('servicio',$data -> getServicio()->getId());
            }
            if (!($data -> getEvento()==null) && $data -> getEvento()->getId()!=103) {
                $query -> setParameter('evento',$data -> getEvento()->getId());
            }
            if (is_numeric ($data -> getPagado()) && intval($data -> getPagado())>0) {
                $pagado = intval($data -> getPagado());
                if($pagado == 2) $pagado =0;
                else if($pagado == 1) $pagado= 1;
                $query -> setParameter('pagado', $pagado);
            }
        }
        else {
            $dql = "SELECT o FROM ProyectoPrincipalBundle:Reserva o ORDER BY o.id  ASC ";
            $query = $em -> createQuery($dql);
        }

        $paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$this->get('request')->query->get('page', 1)/*page number*/,
			10/*limit per page*/
		);

        $gestion['titulo'] = 'Administración de ingresos';
        $gestion['mensaje'] = 'Aqui ud podra estudiar la variacion de los ingresos y las reservas en DondeQuiero';
        $gestion['grafica'] = 'Confirmaciones';
        $gestion['widget'] = 'Reservas';
        $gestion['urlCrear'] = $this -> generateUrl('proyecto_perfil_reservas');

		$secondArray = array('chart' => $ob,'pagination' => $pagination, 'color'=>'verdeazul','gestion'=>$gestion);
        $secondArray['form'] =  $form -> createView();

		$array = array_merge($firstArray, $secondArray);
        return $this->render('ProyectoPrincipalBundle:Gestion:ingresos.html.twig', $array);
    }
    public function usuariosAction(Request $request) {
        
        $firstArray = UtilitiesAPI::getDefaultContent($this);


        $em = $this->getDoctrine()->getManager();

        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        
        $connection = $em->getConnection();
        $sql ="SELECT MONTH( o1.fechaRegistro ) AS mes, COUNT( o1.id ) AS cantidad FROM  User o1  where o1.id != 39  GROUP BY MONTH( o1.fechaRegistro )";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();

        $grafico =  array();
        $sumatoria = 0;

        for ($i=0; $i < count($results) ; $i++) { 
            # code...
            $grafico['data'][$i] = intval($results[$i]['cantidad']);
            $sumatoria +=  $grafico['data'][$i];
            $grafico['mes'][$i] = $meses[intval($results[$i]['mes'])-1];
        }
        // Chart
        $series = array(
            array("name" => "Cantidad Registros",    "data" => $grafico['data'])
            );
        $categories = $grafico['mes'];



        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Variación del registro de usuarios en el tiempo - Total: '.$sumatoria);
        $ob->xAxis->title(array('text'  => "Fechas"));
        $ob->yAxis->title(array('text'  => "Numero de registros"));
        $ob->xAxis->categories($categories);
        $ob->series($series);

        
        //Consulta de elementos
        //$form = null;       
        $filtros = null;
        $filtros['estado'] = array(0=> 'Estado',1 => 'Activo', 2 => 'Inactivo');
        $filtros['rol'] = array(0=> 'Rol',1 => 'Administrador', 2 => 'Usuario');

        $arregloLocalidades = GestionController::dqlArreglo('Localidad','User',8175, $this);

        $data = new User();
        $form = $this -> createFormBuilder($data) 
        -> setAction($this->generateUrl('proyecto_principal_gestion_usuarios'))
        -> setMethod('POST')
        -> add('username', 'text', array('required' => false)) 
        -> add('email', 'text', array('required' => false)) 
        -> add('localidad', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Localidad',
            'choices' => $arregloLocalidades,
            'property' => 'nombre',
            ))
        -> add('estado', 'choice', array('choices' => $filtros['estado'], 'required' => true, ))
        -> add('rol', 'choice', array('choices' => $filtros['rol'], 'required' => true, ))
        -> getForm();


        $form->handleRequest($request);

        if ($form->isValid()) {

            $dql = "SELECT o FROM ProyectoPrincipalBundle:User o WHERE o.id != 39 ";
            $tieneWhere = true;
            
            if($data -> getLocalidad()->getId()!=8175){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getLocalidad(),'localidad',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }

            $filtroResultado = GestionController::dqlFiltro('texto',$dql,$data -> getUsername(),'username',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('texto',$dql,$data -> getEmail(),'email',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getEstado(),'estado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getRol(),'rol',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            
            $dql .= ' ORDER BY o.id  ASC  ';
            $query = $em -> createQuery($dql);
            
            if (!($data -> getLocalidad()==null) && $data -> getLocalidad()->getId()!=8175) {
                $query -> setParameter('localidad',$data -> getLocalidad()->getId());
            }
            if (!(trim($data -> getUsername()) == false)) {
                $query -> setParameter('username', '%'.$data -> getUsername().'%');
            }
            if (!(trim($data -> getEmail()) == false)) {
                $query -> setParameter('email', '%'.$data -> getEmail().'%');
            }
            if (is_numeric ($data -> getEstado()) && intval($data -> getEstado())>0) {
                $estado = intval($data -> getEstado());
                if($estado == 2) $estado =0;
                else if($estado == 1) $estado= 1;
                $query -> setParameter('estado', $estado);
            }
            if (is_numeric ($data -> getRol()) && intval($data -> getRol())>0) {
                $rol = intval($data -> getRol());
                if($rol == 2) $rol =0;
                else if($rol == 1) $rol= 1;
                $query -> setParameter('rol', $rol);
            }
        }
        else {
            $dql = "SELECT o FROM ProyectoPrincipalBundle:User o  WHERE o.id != 39 ORDER BY o.id  ASC ";
            $query = $em -> createQuery($dql);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );

        $gestion['titulo'] = 'Administración de usuarios';
        $gestion['mensaje'] = 'Aqui ud podra estudiar y acceder a los usuarios de DondeQuiero';
        $gestion['grafica'] = 'Registros de usuarios';
        $gestion['widget'] = 'Usuarios';
        $gestion['urlCrear'] = $this -> generateUrl('proyecto_perfil_crearcuenta');

        $secondArray = array('chart' => $ob,'pagination' => $pagination, 'color'=>'rojo','gestion'=>$gestion);
        $secondArray['form'] =  $form -> createView();

        $array = array_merge($firstArray, $secondArray);
        return $this->render('ProyectoPrincipalBundle:Gestion:usuarios.html.twig', $array);

    }
    public function espaciosAction(Request $request) {

        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $em = $this->getDoctrine()->getManager();

        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        
        $connection = $em->getConnection();
        $sql ="SELECT MONTH( o1.fechaRegistro ) AS mes, COUNT( o1.id ) AS cantidad FROM  Espacio o1  WHERE o1.id != 109   GROUP BY MONTH( o1.fechaRegistro )";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();

        $grafico =  array();
        $sumatoria = 0;

        for ($i=0; $i < count($results) ; $i++) { 
            # code...
            $grafico['data'][$i] = intval($results[$i]['cantidad']);
            $sumatoria +=  $grafico['data'][$i];
            $grafico['mes'][$i] = $meses[intval($results[$i]['mes'])-1];
        }
        // Chart
        $series = array(
            array("name" => "Cantidad Registros",    "data" => $grafico['data'])
            );
        $categories = $grafico['mes'];

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Variación del registro de espacios en el tiempo - Total: '.$sumatoria.' Espacios');
        $ob->xAxis->title(array('text'  => "Fechas"));
        $ob->yAxis->title(array('text'  => "Numero de registros"));
        $ob->xAxis->categories($categories);
        $ob->series($series);

        
        //WIDGET DE RESULTADOS    
        $filtros = null;
        $filtros['estado'] = array(0=> 'Estado',1 => 'Activo', 2 => 'Inactivo');
        $filtros['destacado'] = array(0=> 'Destacado',1 => 'Si', 2 => 'No');
        $filtros['suspendido'] = array(0=> 'Suspendido',1 => 'Si', 2 => 'No');

        $arregloLocalidades = GestionController::dqlArreglo('Localidad','Espacio',8175, $this);
        $arregloUsuarios = GestionController::dqlArreglo('User','Espacio',39, $this);

        $data = new Espacio();
        $form = $this -> createFormBuilder($data) 
        -> setAction($this->generateUrl('proyecto_principal_gestion_espacios'))
        -> setMethod('POST')
        -> add('nombre', 'text', array('required' => false)) 
        //-> add('email', 'text', array('required' => false)) 
        -> add('localidad', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Localidad',
            'choices' => $arregloLocalidades,
            'property' => 'nombre',
            ))
        -> add('user', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:User',
            'choices' => $arregloUsuarios,
            'property' => 'nombre',
            ))
        -> add('estado', 'choice', array('choices' => $filtros['estado'], 'required' => true, ))
        -> add('suspendido', 'choice', array('choices' => $filtros['suspendido'], 'required' => true, ))
        -> add('destacado', 'choice', array('choices' => $filtros['destacado'], 'required' => true, ))
        -> getForm();


        $form->handleRequest($request);

        if ($form->isValid()) {

            $dql = "SELECT o FROM ProyectoPrincipalBundle:Espacio o  WHERE o.id != 109  ";
            $tieneWhere = true;
            
            if($data -> getLocalidad()->getId()!=8175){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getLocalidad(),'localidad',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }
            if($data -> getUser()->getId()!=39){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getUser(),'user',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }

            $filtroResultado = GestionController::dqlFiltro('texto',$dql,$data -> getNombre(),'nombre',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];


            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getEstado(),'estado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getDestacado(),'destacado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getSuspendido(),'suspendido',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            
            $dql .= ' ORDER BY o.id  ASC  ';
            $query = $em -> createQuery($dql);
            
            if (!($data -> getLocalidad()==null) && $data -> getLocalidad()->getId()!=8175) {
                $query -> setParameter('localidad',$data -> getLocalidad()->getId());
            }
            if (!($data -> getUser()==null) && $data -> getUser()->getId()!=39) {
                $query -> setParameter('user',$data -> getUser()->getId());
            }
            if (!(trim($data -> getNombre()) == false)) {
                $query -> setParameter('nombre', '%'.$data -> getNombre().'%');
            }

            if (is_numeric ($data -> getEstado()) && intval($data -> getEstado())>0) {
                $estado = intval($data -> getEstado());
                if($estado == 2) $estado =0;
                else if($estado == 1) $estado= 1;
                $query -> setParameter('estado', $estado);
            }
            if (is_numeric ($data -> getSuspendido()) && intval($data -> getSuspendido())>0) {
                $suspendido = intval($data -> getSuspendido());
                if($suspendido == 2) $suspendido =0;
                else if($suspendido == 1) $suspendido= 1;
                $query -> setParameter('suspendido', $suspendido);
            }
            if (is_numeric ($data -> getDestacado()) && intval($data -> getDestacado())>0) {
                $destacado = intval($data -> getDestacado());
                if($destacado == 2) $destacado =0;
                else if($destacado == 1) $destacado= 1;
                $query -> setParameter('destacado', $destacado);
            }

        }
        else {
            $dql = "SELECT o FROM ProyectoPrincipalBundle:Espacio o  WHERE o.id != 109  ORDER BY o.id  ASC ";
            $query = $em -> createQuery($dql);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        $gestion['urlCrear'] = $this -> generateUrl('proyecto_principal_espacio_registrar');
        $gestion['titulo'] = 'Administración de espacios';
        $gestion['mensaje'] = 'Aqui ud podra estudiar y acceder a los espacios de DondeQuiero';
        $gestion['grafica'] = 'Registros de espacios';
        $gestion['widget'] = 'Espacios';


        $secondArray = array('chart' => $ob,'pagination' => $pagination, 'color'=>'verde','gestion'=>$gestion);
        $secondArray['form'] =  $form -> createView();

        $array = array_merge($firstArray, $secondArray);
        return $this->render('ProyectoPrincipalBundle:Gestion:espacios.html.twig', $array);

    }
    public function eventosAction(Request $request) {

        $firstArray = UtilitiesAPI::getDefaultContent($this);


        $em = $this->getDoctrine()->getManager();

        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        
        $connection = $em->getConnection();
        $sql ="SELECT MONTH( o1.fechaRegistro ) AS mes, COUNT( o1.id ) AS cantidad FROM  Evento o1  WHERE o1.id != 103   GROUP BY MONTH( o1.fechaRegistro )";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();

        $grafico =  array();
        $sumatoria = 0;

        for ($i=0; $i < count($results) ; $i++) { 
            # code...
            $grafico['data'][$i] = intval($results[$i]['cantidad']);
            $sumatoria +=  $grafico['data'][$i];
            $grafico['mes'][$i] = $meses[intval($results[$i]['mes'])-1];
        }
        // Chart
        $series = array(
            array("name" => "Cantidad Registros",    "data" => $grafico['data'])
            );
        $categories = $grafico['mes'];



        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Variación del registro de eventos en el tiempo - Total: '.$sumatoria.' Eventos');
        $ob->xAxis->title(array('text'  => "Fechas"));
        $ob->yAxis->title(array('text'  => "Numero de registros"));
        $ob->xAxis->categories($categories);
        $ob->series($series);

        
        //WIDGET DE RESULTADOS    
        $filtros = null;
        $filtros['estado'] = array(0=> 'Estado',1 => 'Activo', 2 => 'Inactivo');
        $filtros['destacado'] = array(0=> 'Destacado',1 => 'Si', 2 => 'No');
        $filtros['suspendido'] = array(0=> 'Suspendido',1 => 'Si', 2 => 'No');

        $arregloLocalidades = GestionController::dqlArreglo('Localidad','Evento',8175, $this);
        $arregloUsuarios = GestionController::dqlArreglo('User','Evento',39, $this);

        $data = new Evento();
        $form = $this -> createFormBuilder($data) 
        -> setAction($this->generateUrl('proyecto_principal_gestion_eventos'))
        -> setMethod('POST')
        -> add('nombre', 'text', array('required' => false)) 
        //-> add('email', 'text', array('required' => false)) 
        -> add('localidad', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Localidad',
            'choices' => $arregloLocalidades,
            'property' => 'nombre',
            ))
        -> add('user', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:User',
            'choices' => $arregloUsuarios,
            'property' => 'nombre',
            ))
        -> add('estado', 'choice', array('choices' => $filtros['estado'], 'required' => true, ))
        -> add('suspendido', 'choice', array('choices' => $filtros['suspendido'], 'required' => true, ))
        -> add('destacado', 'choice', array('choices' => $filtros['destacado'], 'required' => true, ))
        -> getForm();


        $form->handleRequest($request);

        if ($form->isValid()) {

            $dql = "SELECT o FROM ProyectoPrincipalBundle:Evento o  WHERE o.id != 103  ";
            $tieneWhere = true;
            
            if($data -> getLocalidad()->getId()!=8175){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getLocalidad(),'localidad',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }
            if($data -> getUser()->getId()!=39){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getUser(),'user',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }

            $filtroResultado = GestionController::dqlFiltro('texto',$dql,$data -> getNombre(),'nombre',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];


            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getEstado(),'estado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getDestacado(),'destacado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getSuspendido(),'suspendido',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            
            $dql .= ' ORDER BY o.id  ASC  ';
            $query = $em -> createQuery($dql);
            
            if (!($data -> getLocalidad()==null) && $data -> getLocalidad()->getId()!=8175) {
                $query -> setParameter('localidad',$data -> getLocalidad()->getId());
            }
            if (!($data -> getUser()==null) && $data -> getUser()->getId()!=39) {
                $query -> setParameter('user',$data -> getUser()->getId());
            }
            if (!(trim($data -> getNombre()) == false)) {
                $query -> setParameter('nombre', '%'.$data -> getNombre().'%');
            }

            if (is_numeric ($data -> getEstado()) && intval($data -> getEstado())>0) {
                $estado = intval($data -> getEstado());
                if($estado == 2) $estado =0;
                else if($estado == 1) $estado= 1;
                $query -> setParameter('estado', $estado);
            }
            if (is_numeric ($data -> getSuspendido()) && intval($data -> getSuspendido())>0) {
                $suspendido = intval($data -> getSuspendido());
                if($suspendido == 2) $suspendido =0;
                else if($suspendido == 1) $suspendido= 1;
                $query -> setParameter('suspendido', $suspendido);
            }
            if (is_numeric ($data -> getDestacado()) && intval($data -> getDestacado())>0) {
                $destacado = intval($data -> getDestacado());
                if($destacado == 2) $destacado =0;
                else if($destacado == 1) $destacado= 1;
                $query -> setParameter('destacado', $destacado);
            }

        }
        else {
            $dql = "SELECT o FROM ProyectoPrincipalBundle:Evento o  WHERE o.id != 103  ORDER BY o.id  ASC ";
            $query = $em -> createQuery($dql);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        $gestion['urlCrear'] = $this -> generateUrl('proyecto_principal_evento_registrar');
        $gestion['titulo'] = 'Administración de eventos';
        $gestion['mensaje'] = 'Aqui ud podra estudiar y acceder a los eventos de DondeQuiero';
        $gestion['grafica'] = 'Registros de eventos';
        $gestion['widget'] = 'Eventos';

        $secondArray = array('chart' => $ob,'pagination' => $pagination, 'color'=>'rosa','gestion'=>$gestion);
        $secondArray['form'] =  $form -> createView();

        $array = array_merge($firstArray, $secondArray);
        return $this->render('ProyectoPrincipalBundle:Gestion:eventos.html.twig', $array);

    }

    public function serviciosAction(Request $request) {

        $firstArray = UtilitiesAPI::getDefaultContent($this);


        $em = $this->getDoctrine()->getManager();

        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        
        $connection = $em->getConnection();
        $sql ="SELECT MONTH( o1.fechaRegistro ) AS mes, COUNT( o1.id ) AS cantidad FROM  Servicio o1  WHERE o1.id != 103   GROUP BY MONTH( o1.fechaRegistro )";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();

        $grafico =  array();
        $sumatoria = 0;

        for ($i=0; $i < count($results) ; $i++) { 
            # code...
            $grafico['data'][$i] = intval($results[$i]['cantidad']);
            $sumatoria +=  $grafico['data'][$i];
            $grafico['mes'][$i] = $meses[intval($results[$i]['mes'])-1];
        }
        // Chart
        $series = array(
            array("name" => "Cantidad Registros",    "data" => $grafico['data'])
            );
        $categories = $grafico['mes'];



        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Variación del registro de servicios en el tiempo - Total: '.$sumatoria.' Servicios');
        $ob->xAxis->title(array('text'  => "Fechas"));
        $ob->yAxis->title(array('text'  => "Numero de registros"));
        $ob->xAxis->categories($categories);
        $ob->series($series);

        
        //WIDGET DE RESULTADOS    
        $filtros = null;
        $filtros['estado'] = array(0=> 'Estado',1 => 'Activo', 2 => 'Inactivo');
        $filtros['destacado'] = array(0=> 'Destacado',1 => 'Si', 2 => 'No');
        $filtros['suspendido'] = array(0=> 'Suspendido',1 => 'Si', 2 => 'No');

        
        $arregloUsuarios = GestionController::dqlArreglo('User','Servicio',39, $this);

        $data = new Servicio();
        $form = $this -> createFormBuilder($data) 
        -> setAction($this->generateUrl('proyecto_principal_gestion_servicios'))
        -> setMethod('POST')
        -> add('nombre', 'text', array('required' => false)) 
        //-> add('email', 'text', array('required' => false)) 

        -> add('user', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:User',
            'choices' => $arregloUsuarios,
            'property' => 'nombre',
            ))
        -> add('estado', 'choice', array('choices' => $filtros['estado'], 'required' => true, ))
        -> add('suspendido', 'choice', array('choices' => $filtros['suspendido'], 'required' => true, ))
        -> add('destacado', 'choice', array('choices' => $filtros['destacado'], 'required' => true, ))
        -> getForm();


        $form->handleRequest($request);

        if ($form->isValid()) {

            $dql = "SELECT o FROM ProyectoPrincipalBundle:Servicio o  WHERE o.id != 103 ";
            $tieneWhere = true;
            

            if($data -> getUser()->getId()!=39){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getUser(),'user',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }

            $filtroResultado = GestionController::dqlFiltro('texto',$dql,$data -> getNombre(),'nombre',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];


            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getEstado(),'estado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getDestacado(),'destacado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getSuspendido(),'suspendido',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            
            $dql .= ' ORDER BY o.id  ASC  ';
            $query = $em -> createQuery($dql);
            
  
            if (!($data -> getUser()==null) && $data -> getUser()->getId()!=39) {
                $query -> setParameter('user',$data -> getUser()->getId());
            }
            if (!(trim($data -> getNombre()) == false)) {
                $query -> setParameter('nombre', '%'.$data -> getNombre().'%');
            }

            if (is_numeric ($data -> getEstado()) && intval($data -> getEstado())>0) {
                $estado = intval($data -> getEstado());
                if($estado == 2) $estado =0;
                else if($estado == 1) $estado= 1;
                $query -> setParameter('estado', $estado);
            }
            if (is_numeric ($data -> getSuspendido()) && intval($data -> getSuspendido())>0) {
                $suspendido = intval($data -> getSuspendido());
                if($suspendido == 2) $suspendido =0;
                else if($suspendido == 1) $suspendido= 1;
                $query -> setParameter('suspendido', $suspendido);
            }
            if (is_numeric ($data -> getDestacado()) && intval($data -> getDestacado())>0) {
                $destacado = intval($data -> getDestacado());
                if($destacado == 2) $destacado =0;
                else if($destacado == 1) $destacado= 1;
                $query -> setParameter('destacado', $destacado);
            }

        }
        else {
            $dql = "SELECT o FROM ProyectoPrincipalBundle:Servicio o  WHERE o.id != 103  ORDER BY o.id  ASC ";
            $query = $em -> createQuery($dql);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        $gestion['urlCrear'] = $this -> generateUrl('proyecto_principal_servicio_registrar');
        $gestion['titulo'] = 'Administración de servicios';
        $gestion['mensaje'] = 'Aqui ud podra estudiar y acceder a los servicios de DondeQuiero';
        $gestion['grafica'] = 'Registros de servicios';
        $gestion['widget'] = 'Servicios';

        $secondArray = array('chart' => $ob,'pagination' => $pagination, 'color'=>'azul','gestion'=>$gestion);
        $secondArray['form'] =  $form -> createView();

        $array = array_merge($firstArray, $secondArray);
        return $this->render('ProyectoPrincipalBundle:Gestion:servicios.html.twig', $array);

    }
    public function sedesAction(Request $request) {

        $firstArray = UtilitiesAPI::getDefaultContent($this);

        $em = $this->getDoctrine()->getManager();

        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $connection = $em->getConnection();
        $sql ="SELECT MONTH( o1.fechaRegistro ) AS mes, COUNT( o1.id ) AS cantidad FROM  Sede o1  WHERE o1.id != 105   GROUP BY MONTH( o1.fechaRegistro )";
        $statement = $connection->prepare($sql);
        $statement->execute();
        $results = $statement->fetchAll();

        $grafico =  array();
        $sumatoria = 0;

        for ($i=0; $i < count($results) ; $i++) { 
            # code...
            $grafico['data'][$i] = intval($results[$i]['cantidad']);
            $sumatoria +=  $grafico['data'][$i];
            $grafico['mes'][$i] = $meses[intval($results[$i]['mes'])-1];
        }
        // Chart
        $series = array(
            array("name" => "Cantidad Registros",    "data" => $grafico['data'])
            );
        $categories = $grafico['mes'];



        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Variación del registro de sedes en el tiempo - Total: '.$sumatoria);
        $ob->xAxis->title(array('text'  => "Fechas"));
        $ob->yAxis->title(array('text'  => "Numero de registros"));
        $ob->xAxis->categories($categories);
        $ob->series($series);

        
        //WIDGET DE RESULTADOS    
        $filtros = null;
        $filtros['estado'] = array(0=> 'Estado',1 => 'Activo', 2 => 'Inactivo');
        $filtros['destacado'] = array(0=> 'Destacado',1 => 'Si', 2 => 'No');
        $filtros['suspendido'] = array(0=> 'Suspendido',1 => 'Si', 2 => 'No');

        $arregloLocalidades = GestionController::dqlArreglo('Localidad','Sede',8175, $this);
        $arregloUsuarios = GestionController::dqlArreglo('User','Sede',39, $this);

        $data = new Sede();
        $form = $this -> createFormBuilder($data) 
        -> setAction($this->generateUrl('proyecto_principal_gestion_sedes'))
        -> setMethod('POST')
        -> add('nombre', 'text', array('required' => false)) 
        //-> add('email', 'text', array('required' => false)) 
        -> add('localidad', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:Localidad',
            'choices' => $arregloLocalidades,
            'property' => 'nombre',
            ))
        -> add('user', 'entity', array(
            'class' => 'ProyectoPrincipalBundle:User',
            'choices' => $arregloUsuarios,
            'property' => 'nombre',
            ))
        -> add('estado', 'choice', array('choices' => $filtros['estado'], 'required' => true, ))
        -> add('suspendido', 'choice', array('choices' => $filtros['suspendido'], 'required' => true, ))
        -> add('destacado', 'choice', array('choices' => $filtros['destacado'], 'required' => true, ))
        -> getForm();


        $form->handleRequest($request);

        if ($form->isValid()) {

            $dql = "SELECT o FROM ProyectoPrincipalBundle:Sede o  WHERE o.id != 105  ";
            $tieneWhere = true;
            
            if($data -> getLocalidad()->getId()!=8175){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getLocalidad(),'localidad',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }
            if($data -> getUser()->getId()!=39){
            $filtroResultado = GestionController::dqlFiltro('objeto',$dql,$data -> getUser(),'user',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            }

            $filtroResultado = GestionController::dqlFiltro('texto',$dql,$data -> getNombre(),'nombre',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];


            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getEstado(),'estado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getDestacado(),'destacado',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];

            $filtroResultado = GestionController::dqlFiltro('booleano',$dql,$data -> getSuspendido(),'suspendido',$tieneWhere, $this);
            $dql =  $filtroResultado['dql'];
            $tieneWhere =  $filtroResultado['tieneWhere'];
            
            $dql .= ' ORDER BY o.id  ASC  ';
            $query = $em -> createQuery($dql);
            
            if (!($data -> getLocalidad()==null) && $data -> getLocalidad()->getId()!=8175) {
                $query -> setParameter('localidad',$data -> getLocalidad()->getId());
            }
            if (!($data -> getUser()==null) && $data -> getUser()->getId()!=39) {
                $query -> setParameter('user',$data -> getUser()->getId());
            }
            if (!(trim($data -> getNombre()) == false)) {
                $query -> setParameter('nombre', '%'.$data -> getNombre().'%');
            }

            if (is_numeric ($data -> getEstado()) && intval($data -> getEstado())>0) {
                $estado = intval($data -> getEstado());
                if($estado == 2) $estado =0;
                else if($estado == 1) $estado= 1;
                $query -> setParameter('estado', $estado);
            }
            if (is_numeric ($data -> getSuspendido()) && intval($data -> getSuspendido())>0) {
                $suspendido = intval($data -> getSuspendido());
                if($suspendido == 2) $suspendido =0;
                else if($suspendido == 1) $suspendido= 1;
                $query -> setParameter('suspendido', $suspendido);
            }
            if (is_numeric ($data -> getDestacado()) && intval($data -> getDestacado())>0) {
                $destacado = intval($data -> getDestacado());
                if($destacado == 2) $destacado =0;
                else if($destacado == 1) $destacado= 1;
                $query -> setParameter('destacado', $destacado);
            }

        }
        else {
            $dql = "SELECT o FROM ProyectoPrincipalBundle:Sede o  WHERE o.id != 105  ORDER BY o.id  ASC ";
            $query = $em -> createQuery($dql);
        }

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        $gestion['urlCrear'] = $this -> generateUrl('proyecto_principal_sede_registrar');
        $gestion['titulo'] = 'Administración de sedes';
        $gestion['mensaje'] = 'Aqui ud podra estudiar y acceder a las sedes de DondeQuiero';
        $gestion['grafica'] = 'Registros de sedes';
        $gestion['widget'] = 'Sedes';

        $secondArray = array('chart' => $ob,'pagination' => $pagination, 'color'=>'amarillo','gestion'=>$gestion);
        $secondArray['form'] =  $form -> createView();

        $array = array_merge($firstArray, $secondArray);
        return $this->render('ProyectoPrincipalBundle:Gestion:sedes.html.twig', $array);

    }

}
