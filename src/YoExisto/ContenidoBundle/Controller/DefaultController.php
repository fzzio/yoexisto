<?php

namespace YoExisto\ContenidoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;
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
    public function dondeAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:donde.html.twig');
    }

    public function queAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:que.html.twig');
    }

    public function resumenAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:resumen.html.twig');
    }

    public function generadoAction()
    {
        return $this->render('YoExistoContenidoBundle:Templates:generado.html.twig');
    }
}
