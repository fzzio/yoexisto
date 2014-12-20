<?php

namespace YoExisto\ContenidoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FiltroController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }


    public function getAreaPorMunicipioAction( $municipio ){

        $em = $this->getDoctrine()->getManager();
        $municipio  = $em->getRepository("YoExistoContenidoBundle:Municipio")->find( $municipio );

        return $this->render("YoExistoContenidoBundle:Filtros:areasPorMunicipio.html.twig" , array("municipio" => $municipio ));

    }




    public function getMunicipiosAction(){

        $em = $this->getDoctrine()->getManager();
        $municipio  = $em->getRepository("YoExistoContenidoBundle:Municipio")->findAll( );

       return  $this->render("YoExistoContenidoBundle:Filtros:getMunicipios.html.twig" , array("municipios" => $municipio ));
    }




    public function getActividadPorAreaAction( $area ){

        $em = $this->getDoctrine()->getManager();


        $data = array();

        $query = $em->createQuery("SELECT c FROM YoExistoContenidoBundle:Control c JOIN c.donde d  JOIN c.que  q  WHERE d.area = "  . $area );
        $controles = $query->getResult();





       return  $this->render("YoExistoContenidoBundle:Filtros:getActividadReciente.html.twig" , array("controles" => $controles ));
    }




}
