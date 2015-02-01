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




    public function getActividadPorAreaAction( $area  , $estado){


//        <option value="0" >Todos los estados</option>
//        <option value="1" >Solucionado</option>
//        <option value="2"  >En Proceso </option>
//        <option value="3" >Sin Atencion</option>
//        <option value="4" >En Votacion</option>
//


        $em = $this->getDoctrine()->getManager();


        $data = array();


        if ($estado == 0 )
        $query = $em->createQuery("SELECT c FROM YoExistoContenidoBundle:Control c JOIN c.donde d  JOIN c.que  q  WHERE d.area = "  . $area );

        if ($estado == 1 )/// ya fueron solucionados desde el admin
        $query = $em->createQuery("SELECT c FROM YoExistoContenidoBundle:Control c JOIN c.donde d  JOIN c.que  q  WHERE  c.estado = 4  AND  d.area = "  . $area    );

        if ($estado == 2 )/// ya fueron revisado por el admin
        $query = $em->createQuery("SELECT c FROM YoExistoContenidoBundle:Control c JOIN c.donde d  JOIN c.que  q  WHERE c.estado = 3 AND d.area = "  . $area );

        if ($estado == 3 ) //// sin atencion son los que tienen 20 votos y no los han despachado desde el admin
        $query = $em->createQuery("SELECT c FROM YoExistoContenidoBundle:Control c JOIN c.donde d  JOIN c.que  q  WHERE c.positivos >  20  AND d.area = "  . $area );

        if ($estado == 4 )/// cuando recien se ingresa
        $query = $em->createQuery("SELECT c FROM YoExistoContenidoBundle:Control c JOIN c.donde d  JOIN c.que  q  WHERE c.positivos <  20  AND c.estado = 1   AND   d.area = "  . $area );



        $controles = $query->getResult();

       return  $this->render("YoExistoContenidoBundle:Filtros:getActividadReciente.html.twig" , array("controles" => $controles ));
    }





}
