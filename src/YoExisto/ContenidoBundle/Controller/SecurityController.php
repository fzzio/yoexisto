<?php

namespace YoExisto\ContenidoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('YoExistoContenidoBundle:Default:index.html.twig', array('name' => $name));
    }

    public function homeAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:home.html.twig');
    }

    public function registrarAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:registrar.html.twig');
    }

    public function dashboardAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:dashboard.html.twig');
    }
}
