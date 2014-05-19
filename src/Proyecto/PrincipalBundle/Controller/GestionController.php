<?php

namespace Proyecto\PrincipalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Ob\HighchartsBundle\Highcharts\Highchart;

class GestionController extends Controller {

	public function listAction()
	{   

		$em = $this->getDoctrine()->getManager();
		$dql   = "SELECT o1 FROM ProyectoPrincipalBundle:Espacio o1 ORDER BY o1.id  desc";
		$query = $em->createQuery($dql);

		$paginator  = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$this->get('request')->query->get('page', 1)/*page number*/,
			10/*limit per page*/
	        );

    // parameters to template
		return $this->render('AcmeMainBundle:Article:list.html.twig', array('pagination' => $pagination));
	}
	public function indexAction() {

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

		$secondArray = array('chart' => $ob,'pagination' => $pagination);

		$array = array_merge($firstArray, $secondArray);
        return $this->render('ProyectoPrincipalBundle:Gestion:index.html.twig', $array);


    }

}
