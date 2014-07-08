<?php

namespace Project\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjectUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
