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
use Ob\HighchartsBundle\Highcharts\Highchart;

class DefaultController extends Controller {

    public function chartAction()
    {
        // Chart
        $series = array(
            array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
        );

        $ob = new Highchart();
        $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
        $ob->title->text('Chart Title');
        $ob->xAxis->title(array('text'  => "Horizontal axis title"));
        $ob->yAxis->title(array('text'  => "Vertical axis title"));
        $ob->series($series);


        return $this->render('ProyectoPrincipalBundle:Default:grafico.html.twig', array(
            'chart' => $ob
        ));
    }

	public function indexAction() {
		//HelpersController::eliminaHuerfanos($this);
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();
        $secondArray['sedes']     = HelpersController::getSedes(false,false,0,$this);//caso especial mapas javascript

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:index.html.twig', $array);
	}


	public function eventoAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:evento.html.twig', $array);
	}
	public function servicioAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:servicio.html.twig', $array);
	}
	public function eventosAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:eventos.html.twig', $array);
	}
	public function serviciosAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:servicios.html.twig', $array);
	}
	public function sedesAction() {
		$firstArray = UtilitiesAPI::getDefaultContent($this);
		$secondArray = array();

		$array = array_merge($firstArray, $secondArray);
		return $this -> render('ProyectoPrincipalBundle:Default:sedes.html.twig', $array);
	}

}
