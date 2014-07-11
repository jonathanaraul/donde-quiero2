<?php

namespace Project\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjectUserBundle:Default:index.html.twig', array('name' => $name));
    }
    public function promoverAction()
    {
    	$userManager = $this->container->get('fos_user.user_manager');
        $user = $this->getUser();
        $session = new Session();
        if($user){ 
            if (false === $this->get('security.context')->isGranted('ROLE_ADMIN')) {
                $em = $this->getDoctrine()->getManager();
                $user->addRole('ROLE_ADMIN');
                $em->persist($user);
                $em->flush();
            }
        }
        $titulo = '¡Rol de administraor...!';
        $mensaje = 'Estimado(a) '.ucfirst($user ->getNombre()) . ' '.ucfirst($user ->getApellido()) .' ahora posee derechos de administrador en DONDE-QUIERO, por favor inicie de nuevo su sesión para acceder al panel de administración.';
        $tituloBoton = 'Iniciar sesión';
        $direccionBoton = $this->generateUrl('fos_user_security_login');
        $array = array('titulo' => $titulo, 'mensaje' => $mensaje, 'tituloBoton'=>$tituloBoton, 'direccionBoton'=>$direccionBoton );
        $session->invalidate();
        
        return $this -> render('ProjectLayoutBundle:Helpers:mensaje.html.twig', $array);
    }
    public function degradarAction()
    {
    	$userManager = $this->container->get('fos_user.user_manager');
        $user = $this->getUser();
        $session = new Session();
        if($user){
            if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
                $em = $this->getDoctrine()->getManager();
                $user->removeRole( 'ROLE_ADMIN' );
                $em->persist($user);
                $em->flush(); 
            }
        } 
        
        $titulo = '¡Rol de usuario...!';
        $mensaje = 'Estimado(a) '.ucfirst($user ->getNombre()) . ' '.ucfirst($user ->getApellido()) .' ahora solo posee derechos de usuario en DONDE-QUIERO, por favor inicie de nuevo su sesión.';
        $tituloBoton = 'Iniciar sesión';
        $direccionBoton = $this->generateUrl('fos_user_security_login');
        $array = array('titulo' => $titulo, 'mensaje' => $mensaje, 'tituloBoton'=>$tituloBoton, 'direccionBoton'=>$direccionBoton );
        $session->invalidate();
        
        return $this -> render('ProjectLayoutBundle:Helpers:mensaje.html.twig', $array);
    }
}
