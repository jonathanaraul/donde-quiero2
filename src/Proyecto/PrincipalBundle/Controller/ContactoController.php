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
use Proyecto\PrincipalBundle\Entity\Contacto;


class ContactoController extends Controller {



	public function enviarMensajeAction() {
		$peticion = $this -> getRequest();
		$doctrine = $this -> getDoctrine();
		$post = $peticion -> request;
		$em = $this->getDoctrine()->getManager();

		$mensaje = trim($post -> get("mensaje-mensaje"));
		$email = trim($post -> get("email-mensaje"));
		$nombre = trim($post -> get("nombre-mensaje"));
		$user = UtilitiesAPI::getActiveUser($this);

		$object = new Contacto();

		$object -> setUser($user);
		$object -> setEmail($email);
		$object -> setMensaje($mensaje);
		$object -> setNombre($nombre);
		$object -> setFechaRegistro(new \DateTime());
    	$em->persist($object);
    	$em->flush();

		$respuesta = new response(json_encode(array('estado' => true)));
		$respuesta -> headers -> set('content_type', 'aplication/json');
		return $respuesta;
	}
}