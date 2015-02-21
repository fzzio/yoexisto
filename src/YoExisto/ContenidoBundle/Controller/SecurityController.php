<?php

namespace YoExisto\ContenidoBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\Security\Core\SecurityContextInterface;
use YoExisto\ContenidoBundle\Entity\Control;
use YoExisto\ContenidoBundle\Entity\Usuario;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\File\UploadedFile;



class SecurityController extends Controller
{




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
            return new RedirectResponse($this->generateUrl('yoexisto_login'));
        }

    }










    public function registrarAction(Request $request)
    {


        $usuario = new Usuario();




        $form = $this->createFormBuilder($usuario)
            ->add('username', 'text')
//            ->add('password', 'password')
            ->add('password', 'repeated', array(
                'type' => 'password',
                'invalid_message' => 'Las contraseñas deben coincidir.',
                'options' => array('attr' => array('class' => 'password-field')),
                'required' => true,
                'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password'),
            ))
            ->add('email', 'text')
            ->add('cedula', 'text')
            ->add('file', 'file' , array('required' => false))
            ->add('save', 'submit', array('label' => 'Create Task'))
            ->getForm();


        $form->handleRequest($request);



        if ($form->isValid()  ) {



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



            $session = $this->container->get('session');

            $session->getFlashBag()->add(
                'success',
                'Tu cuenta ha sido creada, revisa tu bandeja de correo'
            );


            $usuario = $this->getDoctrine()->getManager()->getRepository("YoExistoContenidoBundle:Usuario")->find( $user->getId() );
            $this->enviaMail(  $usuario );

            return $this->render('YoExistoContenidoBundle:Templates:ready.html.twig', array("usuario" =>  $usuario ));


        }


        return $this->render('YoExistoContenidoBundle:Templates:registrar.html.twig' , array(
            'form' => $form->createView()
        ));
    }








    public function pruebaAction(){
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository("YoExistoContenidoBundle:Usuario")->findOneBy(array("username" => "halvarado"));

        $this->enviaMail($usuario);


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



    public function testCodigoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usuario = $em->getRepository("YoExistoContenidoBundle:Usuario")->find(20);
        $this->enviaMail(  $usuario );

//        return $this->render('YoExistoContenidoBundle:Templates:ready.html.twig');
    }



}
