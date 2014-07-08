<?php

namespace Project\LayoutBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjectLayoutBundle:Default:index.html.twig', array('name' => $name));
    }
}
