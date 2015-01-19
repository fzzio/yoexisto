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



class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('YoExistoContenidoBundle:Default:index.html.twig', array('name' => $name));
    }

    public function readyAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:ready.html.twig');
    }



    public function activacionErroneaAction(){

        return $this->render('YoExistoContenidoBundle:Templates:activacionerror.html.twig');
    }

    public function enviaMail(  $usuario  )
    {




        $message = \Swift_Message::newInstance()
            ->setSubject('Codigo de activacion')
            ->setFrom(array('admin@yoexisto.com' => 'demo'))
            ->setTo(  $usuario->getEmail() )
            ->setBody(
               'active su codigo aqui <a  href="'. $url = $this->generateUrl('yoexisto_activar', array('codigo' => $usuario->getActivacion()), true) .'" > Activar '

            )
            ->setContentType("text/html");


        if ($this->get('mailer')->send($message)) {
            return true;
        } else {
            return false;
        }
    }


    public function loginAction()
    {


        $request = $this->getRequest();
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        }



        return $this->render('YoExistoContenidoBundle:Templates:login.html.twig'  , array(
            'last_username' => $session->get(SecurityContext::LAST_USERNAME),
            'error'         => $error
        ));
    }


    public function activarAction($codigo)
    {

        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository("YoExistoContenidoBundle:Usuario")->findOneBy(array("activacion"=> $codigo ));

        if(!$usuario){
            return new RedirectResponse($this->generateUrl('activacion_erronea'));
        }else{

            $usuario->setLocked(0);
            $usuario->setEnabled(1);

            $em->flush();
            return new RedirectResponse($this->generateUrl('yoexisto_home'));
        }

    }










    public function registrarAction(Request $request)
    {

        $session = $this->container->get('session');
        $em = $this->getDoctrine()->getManager();

        $usuario = new Usuario();
        $form = $this->createFormBuilder($usuario)
            ->add('username', 'text')
            ->add('password', 'password')
            ->add('email', 'text')
            ->add('cedula', 'text')
            ->add('foto', 'file' , array('required' => true))
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();


        $form->handleRequest($request);




        $existe_username  =  $em->getRepository('YoExistoContenidoBundle:Usuario')->findOneBy(array("username" => $usuario->getUsername()  ));
        $existe_correo    =  $em->getRepository('YoExistoContenidoBundle:Usuario')->findOneBy(array("email"    => $usuario->getEmail()  ));
        $existe_cedula    =  $em->getRepository('YoExistoContenidoBundle:Usuario')->findOneBy(array("cedula"    => $usuario->getCedula() ));


        if ($form->isValid()  ) {


            if (!$existe_correo) {
                $session->getFlashBag()->add(
                    'error',
                    'El correo ya existe'
                );
            }

            if (!$existe_username) {
                $session->getFlashBag()->add(
                    'error',
                    'El Usuario ya existe'
                );
            }

            if (!$existe_cedula) {
                $session->getFlashBag()->add(
                    'error',
                    'La cedula ya ha diso registrada'
                );
            }



            if( !$existe_username && !$existe_correo && !$existe_cedula){
                
                $usuario->upload( $this->get('kernel')->getRootDir().'/../web/');

                $userManager = $this->get('fos_user.user_manager');
                $user = $userManager->createUser();
                $user->setUsername(  $usuario->getUsername() );
                $user->setEmail($usuario->getEmail());
                $user->setCedula($usuario->getCedula());



                $user->setPassword($usuario->getPassword());
                $user->setPlainPassword($usuario->getPassword());






                $factory = $this->get('security.encoder_factory');

                $encoder = $factory->getEncoder($user);

                $pass = $encoder->encodePassword($usuario->getPassword(), $usuario->getSalt());
                $user->setPassword(  $pass );
                $user->setEnabled(  0 );
                $user->setLocked(  1 );

                $generatedKey = sha1(mt_rand(10000,99999).time().$usuario->getEmail());

                $user->setActivacion( $generatedKey );




                $user->setFoto($usuario->getFoto());
                $user->setEnabled(true);

                $userManager->updateUser($user);


                $session->getFlashBag()->add(
                    'success',
                    'Usuario Registrado Correctamente'
                );


                $this->enviaMail(  $usuario );


                return $this->redirect($this->generateUrl('yoexisto_ready'));
            }


        }


        return $this->render('YoExistoContenidoBundle:Templates:registrar.html.twig' , array(
            'form' => $form->createView()
        ));
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

    public function getDetalleReporteAction(Request $request){

        if ($request->isMethod('POST')) {
            $id_control = intval($request->request->get('idReporte'));


            $controlRecibido = $this->getDoctrine()->getRepository("YoExistoContenidoBundle:Control")->findOneBy(
                array(
                    "id" => $id_control,
                    "estado" => 1 
                )
            );

            if ($controlRecibido) {


                $arrayContol = array(
                    'idcontol' => $controlRecibido->getId(),
                    'idcontolRecibido' => $id_control,
                    'titulo' => $controlRecibido->getQue()->getTitulo(),
                    'autor'=> $controlRecibido->getUsuario(),
                    'municipio'=> $controlRecibido->getDonde()->getMunicipio()->getNombre(),
                    'area'=> $controlRecibido->getDonde()->getArea()->getNombre(),
                    'direccion'=> $controlRecibido->getDonde()->getDescripcion(),
                    //'institucion'=> $controlRecibido->getDonde()->getInstitucion,
                    'institucion'=> "",
                    'descripcion'=> $controlRecibido->getQue()->getDescripcion(),
                    'imagen'=> $controlRecibido->getQue()->getArchivo(),
                    'votos'=> $controlRecibido->getPositivos()
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
