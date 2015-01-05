<?php

namespace Acme\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\TestBundle\Entity\JoinUs;
use Acme\TestBundle\Form\JoinType;
use Acme\TestBundle\Entity\Login;
use Acme\TestBundle\Form\LoginType;
use Acme\TestBundle\Entity\Registeration;
use Acme\TestBundle\Form\RegistrationType;
use Acme\TestBundle\Entity\SendEmail;
use Acme\TestBundle\Form\SendEmailType;
use Acme\TestBundle\Entity\Photos;
use Acme\TestBundle\Form\PhotoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AcmeTestBundle:default:index.html.twig');
    }
    public function aboutAction()
    {
    	return $this->render('AcmeTestBundle:about:about.html.twig');
    }
    public function joinmeAction(Request $request)
    {

        $joinus = new JoinUs();
        $form   = $this->createForm(new JoinType(),$joinus); // create form by passing object of entity
       
        //$request = $this->get('request');

        $form->handleRequest($request); // handles the form request GET,POST

        if($request->getMethod()=='POST')
        {
            if($form->isValid()) //check all validation is done
            {
                
                $this->get('session')->getFlashBag()->add('notice', 'Your changes were saved!');

                $em = $this->getDoctrine()->getManager();
                $em->persist($joinus);
                $em->flush();

                
                $currentUrl = $this->getRequest()->getUri();
                return $this->redirect($currentUrl); 
                
            }
            
            return $this->render('AcmeTestBundle:join:join.html.twig',$arrayName = array('form' => $form->createView()));
        }

    	return $this->render('AcmeTestBundle:join:join.html.twig',$arrayName = array('form' => $form->createView()));
    }
    public function clientAction()
    {
    	return $this->render('AcmeTestBundle:clients:client.html.twig');
    }
    public function termsAction()
    {
        return $this->render('AcmeTestBundle:terms:terms.html.twig');
    }
    public function loginAction(Request $request)
    {
        $login = new Login();
        $form   = $this->createForm(new LoginType(),$login);
        $form->handleRequest($request); // handles the form request GET,POST

        if($request->getMethod()=='POST')
        {
            if($form->isValid()) //check all validation is done
            {
                $userName=$login->getUserName();
                $password=$login->getPassword();
                $parameters= array('email' => $userName,'password'=>$password);
               
                $em=$this->getDoctrine()->getRepository('AcmeTestBundle:Registeration');
                $res=$em->findOneBy($parameters);
                

                if($res)
                {
                    $session=new Session();
                    $id=$res->getUserId();
                    $session->set('user_id',$id);
                    
                    return $this->redirect($this->generateUrl('test_profile'));
                }
                else {

                    $this->get('session')->getFlashBag()->add('notice', 'Invalid username and password!');
                    $currentUrl = $this->getRequest()->getUri();
                    return $this->redirect($currentUrl); 
                }
            }
        }
        return $this->render('AcmeTestBundle:login:login.html.twig',array('form' =>$form->createView()));
    }
    public function logoutAction()
    {
        $session=new Session();
        $session->remove('name');
        return $this->redirect($this->generateUrl('test_homepage'));
    }
    public function profileAction(Request $request)
    {
        $session=new Session();

        if($session->get('user_id'))
        {
        $user_id=$session->get('user_id');
        // get user data from database
        $em=$this->getDoctrine()->getRepository('AcmeTestBundle:Registeration');
        $data=$em->find($user_id);

        return $this->render('AcmeTestBundle:profile:profile.html.twig',array('user'=>$data));
        }
        else
        {
            return $this->redirect($this->generateUrl('test_homepage'));
        }
    }
    
    public function registerAction(Request $request)
    {
        $register= new Registeration();
        $form=$this->createForm(new RegistrationType(),$register);
        $form->handleRequest($request);
        if($request->getMethod()=='POST')
        {
            if($form->isValid()) //check all validation is done
            {
                $this->get('session')->getFlashBag()->add('notice', 'Your account created successfully!');

                $em = $this->getDoctrine()->getManager();
                $em->persist($register);
                $em->flush();
                return $this->redirect($this->generateUrl('test_login'));
            }
        }
        return $this->render('AcmeTestBundle:registeration:register.html.twig',array('form' =>$form->createView()));
    }
    public function emailAction(Request $request)
    {
         $sendmail= new SendEmail();
         $form=$this->createForm(new SendEmailType(),$sendmail);
         $form->handleRequest($request);
         if($request->getMethod()=='POST')
        {
           if($form->isValid()) //check all validation is done
            {
                $this->get('session')->getFlashBag()->add('notice', 'Mail send successfully!');

                $em = $this->getDoctrine()->getManager();
                $em->persist($sendmail);
                $em->flush();
                $message = \Swift_Message::newInstance()
                ->setSubject($sendmail->getBody())
                ->setFrom('sagar.wadiyaar@cuelogic.co.in')
                ->setTo($sendmail->getSenderEmail())
                ->setBody('Hi these is test mail');

                $this->get('mailer')->send($message);
                return $this->redirect($this->generateUrl('test_mail'));
                
            }
           
        }

         return $this->render('AcmeTestBundle:sendemail:email.html.twig',array('form' =>$form->createView()));
    }
    public function sendEmailAction()
    {
        $message = \Swift_Message::newInstance()
        ->setSubject('Hello Email')
        ->setFrom('sagar.wadiyaar@cuelogic.co.in')
        ->setTo('sagar.wadiyaar@cuelogic.co.in')
        ->setBody('Hi these is test mail');

        $this->get('mailer')->send($message);
        return $this->render('AcmeTestBundle:default:index.html.twig');
    }
    public function galleryAction(Request $request)
    {
        $photo = new Photos();
        $form   = $this->createForm(new PhotoType(),$photo);
        $form->handleRequest($request); // handles the form request GET,POST
         if($request->getMethod()=='POST')
        {
           if($form->isValid()) //check all validation is done
            {

                 $name= '';

                 foreach($request->files as $uploadedFile) {
                 $name= $uploadedFile['photo_name']->getClientOriginalName();
                 $directory=$photo->getUploadRootDir();
                 $file = $uploadedFile['photo_name']->move($directory, $name);
                } 
                $em = $this->getDoctrine()->getManager();
                $em->persist($photo);
                $em->flush();
                $currentUrl = $this->getRequest()->getUri();
                return $this->redirect($currentUrl); 
            }
        }
        
        $em=$this->getDoctrine()->getRepository('AcmeTestBundle:Photos');
        $data=$em->findAll();
        //echo '<pre>';
       //print_r($data);die();
        return $this->render('AcmeTestBundle:photos:photo.html.twig',array('form' =>$form->createView(),'news' =>$data));
    }
    public function deletePhotoAction(Request $request)
    {
        $photo = new Photos();
        $form   = $this->createForm(new PhotoType(),$photo);
        $form->handleRequest($request); // handles the form request GET,POST

        $file_id = $_GET['id'];
        $directory=$photo->getUploadRootDir();
        //print_r($_GET);die();
        if(isset($_GET['id']))
        {
            //$path=$directory.'/'.$file;
                //unlink($path);
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                    'delete from AcmeTestBundle:Photos p
                     WHERE p.photo_id=:id'
                    )->setParameter('id', $file_id);
            $photo=$query->getResult();
        }
       // print_r($directory);
        //return new Response();
        return $this->redirect($this->generateUrl('test_photos'));
    }

}

