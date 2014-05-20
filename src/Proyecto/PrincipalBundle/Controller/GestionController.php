<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;
use Doctrine\ORM\EntityRepository;

use Proyecto\PrincipalBundle\Entity\User;
use Proyecto\PrincipalBundle\Entity\Espacio;
use Proyecto\PrincipalBundle\Entity\Reserva;
use Proyecto\PrincipalBundle\Entity\Localidad;
use Proyecto\PrincipalBundle\Entity\Confirmacion;
use Proyecto\PrincipalBundle\Entity\ConfirmacionElemento;


class GestionController extends Controller {


	public function indexAction(Request $request) {

		$firstArray = UtilitiesAPI::getDefaultContent($this);
        $em = $this->getDoctrine()->getManager();

        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        
        $connection = $em->getConnection();
        $sql ="SELECT MONTH( o1.fechaRegistro ) AS mes, COUNT( o1.id ) AS cantidad FROM  User o1  GROUP BY MONTH( o1.fechaRegistro )";
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
        $url = $this -> generateUrl('proyecto_principal_gestion_usuarios');
        //$form = null;       
        $filtros = null;
        $filtros['estado'] = array(0=> 'Estado',1 => 'Activo', 2 => 'Inactivo');
        $filtros['rol'] = array(0=> 'Rol',1 => 'Administrador', 2 => 'Usuario');

        $arraylocalidades = $this -> getDoctrine() -> getRepository('ProyectoPrincipalBundle:Localidad') -> findAll();
        $localidades = array();
        for ($i=0; $i < 5; $i++) { 
            # code...
             $localidades[$i] = $arraylocalidades[$i];
        }

        $dql =  'SELECT distinct o1
                 FROM ProyectoPrincipalBundle:Localidad o1, ProyectoPrincipalBundle:User o2
                 WHERE o2.localidad = o1.id
                 ORDER BY o1.nombre ASC';

        $query = $em->createQuery( $dql );

        $arregloLocalidades = $query->getResult();
   
        $data = new User();
        $form = $this -> createFormBuilder($data) 
        -> setAction($this->generateUrl('proyecto_principal_gestion'))
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

        if ($request->isMethod('POST')) {


            $dql = "SELECT o FROM ProyectoPrincipalBundle:User o ";
            $tieneWhere = false;
            

            if (!($data -> getLocalidad()==null)) {

                if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';

                $dql .= " o.localidad = :localidad ";

            }
            if (!(trim($data -> getUsername()) == false)) {

                if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';

                $dql .= " o.username like :username ";

            }
            if (!(trim($data -> getEmail()) == false)) {

                if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';

                $dql .= " o.email like :email ";

            }
            if (is_numeric($data -> getEstado()) && intval($data -> getEstado())>0) {

                if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';

                $dql .= ' o.estado = :estado ';
                $estado = intval($data -> getEstado());
                if($estado == 2) $estado =0;
                else if($estado == 1) $estado= 1;
            }
            if (is_numeric($data -> getRol()) && intval($data -> getRol())>0) {

                if(!$tieneWhere){$dql.= ' WHERE ';$tieneWhere= true; }else $dql.= ' AND ';

                $dql .= ' o.rol = :rol ';
                $rol = intval($data -> getRol());
                if($rol == 2) $rol =0;
                else if($rol == 1) $rol= 1;
            }

            $dql .= ' ORDER BY o.id  ASC  ';
            $query = $em -> createQuery($dql);
            
            if (!($data -> getLocalidad()==null)) {
                $query -> setParameter('localidad',$data -> getLocalidad()->getId());
            }
            if (!(trim($data -> getUsername()) == false)) {
                $query -> setParameter('username', '%'.$data -> getUsername().'%');
            }
            if (!(trim($data -> getEmail()) == false)) {
                $query -> setParameter('email', '%'.$data -> getEmail().'%');
            }
            if (is_numeric ($data -> getEstado()) && intval($data -> getEstado())>0) {
                $query -> setParameter('estado', $estado);
            }
            if (is_numeric ($data -> getRol()) && intval($data -> getRol())>0) {
                $query -> setParameter('rol', $rol);
            }
            
        }
        else {
            $dql = "SELECT o FROM ProyectoPrincipalBundle:User o ORDER BY o.id  ASC ";
            $query = $em -> createQuery($dql);
        }

        $paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$this->get('request')->query->get('page', 1)/*page number*/,
			10/*limit per page*/
		);

		$secondArray = array('chart' => $ob,'pagination' => $pagination, 'color'=>'rojo');
        $secondArray['form'] =  $form -> createView();

		$array = array_merge($firstArray, $secondArray);
        return $this->render('ProyectoPrincipalBundle:Gestion:index.html.twig', $array);


    }
    public function usuariosAction(Request $request) {
        $firstArray = UtilitiesAPI::getDefaultContent($this);
        $meses = array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');

        $em = $this->getDoctrine()->getEntityManager();
        $connection = $em->getConnection();
        $sql ="SELECT MONTH( o1.fechaRegistro ) AS mes, COUNT( o1.id ) AS cantidad FROM  User o1  GROUP BY MONTH( o1.fechaRegistro )";
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
        $em = $this->getDoctrine()->getManager();
        $dql   = "SELECT o FROM ProyectoPrincipalBundle:User o ORDER BY o.id  ASC";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $this->get('request')->query->get('page', 1)/*page number*/,
            3/*limit per page*/
        );

        $secondArray = array('chart' => $ob,'pagination' => $pagination, 'color'=>'rojo');

        $array = array_merge($firstArray, $secondArray);
        return $this->render('ProyectoPrincipalBundle:Gestion:index.html.twig', $array);


    }
    public function eventosAction(Request $request) {


    }
    public function espaciosAction(Request $request) {


    }
    public function serviciosAction(Request $request) {


    }
    public function sedesAction(Request $request) {


    }

}
