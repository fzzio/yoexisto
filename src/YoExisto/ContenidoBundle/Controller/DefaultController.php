<?php

namespace YoExisto\ContenidoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;
use YoExisto\ContenidoBundle\Entity\Control;
use YoExisto\ContenidoBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use YoExisto\ContenidoBundle\Entity\Voto;


class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('YoExistoContenidoBundle:Default:index.html.twig', array('name' => $name));
    }




    public function readyAction()
    {

//        $usuario = $this->getDoctrine()->getManager()->getRepository("YoExistoContenidoBundle:Usuario")->find(20);
//
//        return $this->render('YoExistoContenidoBundle:Templates:ready.html.twig', array("usuario" => $usuario ));
    }





    public function activacionErroneaAction(){

        return $this->render('YoExistoContenidoBundle:Templates:activacionerror.html.twig');
    }





    public function dashboardAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:dashboard.html.twig');
    }

    public function recienteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $this->get('security.context')->getToken()->getUser()->getUsername();
        $controles = $em->getRepository("YoExistoContenidoBundle:Control")->findBy(array("estado" => 1 , "usuario" => $usuario ));

        return $this->render('YoExistoContenidoBundle:Templates:reciente.html.twig' , array("controles" => $controles ));
    }




    public function getControlesAction(){

        $em = $this->getDoctrine()->getManager();
        $usuario = $this->get('security.context')->getToken()->getUser()->getUsername();
        $controles = $em->getRepository("YoExistoContenidoBundle:Control")->findBy(array("estado" => 1 , "usuario" => $usuario ));

        return $this->render('YoExistoContenidoBundle:Blocks:controles.html.twig' , array("controles" => $controles) );
    }


    public function getActividadRecienteAction(){

        $em = $this->getDoctrine()->getManager();
        $usuario = $this->get('security.context')->getToken()->getUser()->getUsername();
        $controles = $em->getRepository("YoExistoContenidoBundle:Control")->findBy(
            array("estado" => 1 ),
            array('updated_at' => 'DESC')
        );

        return $this->render('YoExistoContenidoBundle:Blocks:actividad_reciente.html.twig' , array("controles" => $controles) );
    }




    /* Esta sección es para los 3 pasos al generar un reporte */
    public function dondeAction(Request $request)
    {

        $control = $this->getCurrentControl();

        $donde = $control->getDonde();
        if(  !$donde ){
            $donde = new \YoExisto\ContenidoBundle\Entity\Donde();
            $donde->setLongitud("0");
            $donde->setLatitud("0");

        }




        $form = $this->createFormBuilder($donde)
            ->add('municipio', null , array('required' => true))
            ->add('area', null , array('required' => true))
            ->add('descripcion', 'text')
            ->add('latitud', 'hidden')
            ->add('longitud', 'hidden')
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $donde->setNombre("");


            $control->setDonde($donde);


            $em = $this->getDoctrine()->getManager();
            $em->flush();


            return $this->redirect($this->generateUrl('yoexisto_que'));
        }


        return $this->render('YoExistoContenidoBundle:Templates:donde.html.twig' , array("form" =>  $form->createView() ));
    }

    public function queAction( Request $request  )
    {


        $control = $this->getCurrentControl();

        $que = $control->getQue();
        if(  !$que ){
            $que = new \YoExisto\ContenidoBundle\Entity\Que();
        }




        $form = $this->createFormBuilder($que)
            ->add('titulo', null , array('required' => true))
            ->add('descripcion', null , array('required' => true))
            ->add('file', 'file' , array('required' => true))


            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {

            $que->upload( $this->get('kernel')->getRootDir().'/../web/');
            $control->setQue($que);


            $em = $this->getDoctrine()->getManager();
            $em->flush();


            return $this->redirect($this->generateUrl('yoexisto_resumen'));
        }


        return $this->render('YoExistoContenidoBundle:Templates:que.html.twig' , array("form" => $form->createView()));
    }

    public function resumenAction(  Request $request  )
    {
        $em = $this->getDoctrine()->getManager();

        $control = $this->getCurrentControl();



        if($this->getRequest()->isMethod('POST')){

            $control->setEstado(1);
            $em->flush();
            return $this->redirect($this->generateUrl('yoexisto_reciente'));
        }


        return $this->render('YoExistoContenidoBundle:Templates:resumen.html.twig' , array("control"  => $control));
    }

    public function generadoAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:generado.html.twig');
    }




    function getCurrentControl(){

        $usuario = $this->get('security.context')->getToken()->getUser()->getUsername();
        $em = $this->getDoctrine()->getManager();

        $control = $em->getRepository("YoExistoContenidoBundle:Control")->findOneBy(array("usuario" => $usuario , "estado" => 0 ));

        if(!$control){
            $control = new Control();
            $control->setUsuario($usuario);
            $control->setEstado(0);
            $control->setPositivos(0);
            $control->setNegativos(0);

            $em->persist($control);
            $em->flush();
        }

        return $control;

    }


    public function votarControlAction($id_control){

        $currentUser  = $this->get('security.context')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();


        $control = $em->getRepository("YoExistoContenidoBundle:Control")->find($id_control);

        foreach(   $control->getVotos() as $votoBuscar ){

            if( $votoBuscar->getUsuario() == $currentUser->getUsername() ){
                return new JsonResponse(array(
                    'codigo' => 0,
                    'Mensaje' => "Voto ya registrado "
                ), 200); //codigo de error diferente
            }
        }


        $voto = new Voto();
        $voto->setUsuario( $currentUser->getUsername()  );
        $voto->setDescripcion("ok");
        $voto->setValor(1);

        $control->addVoto($voto);

        $em->flush();


        return new JsonResponse(array(
            'codigo' => 1,
            'votos'  => "" . $control->getVotos()->count(),
            'mensaje' => "Ok"
        ), 200); //codigo de error diferente

    }



    public function getDetalleReporteAction(Request $request){


        $currentUser  = $this->get('security.context')->getToken()->getUser();



        if ($request->isMethod('POST')) {
            $id_control = intval($request->request->get('idReporte'));


            $controlRecibido = $this->getDoctrine()->getRepository("YoExistoContenidoBundle:Control")->findOneBy(
                array(
                    "id" => $id_control,
                    "estado" => 1 
                )
            );

            if ($controlRecibido) {

                $voto_registrado = "no";

                if(  $currentUser )
                foreach(   $controlRecibido->getVotos() as $voto ){

                    if( $voto->getUsuario() == $currentUser->getUsername() ){
                        $voto_registrado = "si";
                    }
                }

                $arrayContol = array(
                    'idcontol' => $controlRecibido->getId(),
                    'idcontolRecibido' => $id_control,
                    'titulo' => $controlRecibido->getQue()->getTitulo(),
                    'autor'=> $controlRecibido->getUsuario(),
                    'municipio'=> $controlRecibido->getDonde()->getMunicipio()->getNombre(),
                    'area'=> $controlRecibido->getDonde()->getArea()->getNombre(),
                    'direccion'=> $controlRecibido->getDonde()->getDescripcion(),
                    'institucion'=> "",
                    'descripcion'=> $controlRecibido->getQue()->getDescripcion(),
                    'imagen'=> $controlRecibido->getQue()->getArchivo(),
                    'votos'=>  $controlRecibido->getVotos()->count(),
                    'voto_registrado'=>  $voto_registrado,
                );
                
                return new JsonResponse(array(
                    'codigo' => 1,
                    'Mensaje' => "Se ha encontrado el control",
                    'control' => $arrayContol
                ), 200); //codigo de error diferente
            }else{
                return new JsonResponse(array(
                    'codigo' => 1,
                    'Mensaje' => "Control no encontrado",
                    'idcontolRecibido' => $id_control
                ), 200); //codigo de error diferente
            }

        }

        return new JsonResponse(array(
            'codigo' => 0,
            'Mensaje' => "Error al recibir"
        ), 200); //codigo de error diferente
    }

}
