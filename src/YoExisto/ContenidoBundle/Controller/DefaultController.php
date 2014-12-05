<?php

namespace YoExisto\ContenidoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;
use YoExisto\ContenidoBundle\Entity\Control;
use YoExisto\ContenidoBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;



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
                $userManager = $this->get('fos_user.user_manager');
                $user = $userManager->createUser();
                $user->setUsername(  $usuario->getUsername() );
                $user->setEmail($usuario->getEmail());
                $user->setCedula($usuario->getCedula());
                $user->setPassword($usuario->getPassword());
                $user->setPlainPassword($usuario->getPassword());
                $user->setEnabled(true);

                $userManager->updateUser($user);


                $session->getFlashBag()->add(
                    'success',
                    'Usuario Registrado Correctamente'
                );


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
        return $this->render('YoExistoContenidoBundle:Templates:reciente.html.twig');
    }




    /* Esta sección es para los 3 pasos al generar un reporte */
    public function dondeAction(Request $request)
    {

        $control = $this->getCurrentControl();

        $donde = $control->getDonde();
        if(  !$donde ){
            $donde = new \YoExisto\ContenidoBundle\Entity\Donde();
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
            $donde->setLatitud("");
            $donde->setLongitud("");

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


}
