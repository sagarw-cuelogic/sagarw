<?php

namespace Acme\TestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\TestBundle\Entity\JoinUs;
use Acme\TestBundle\Form\JoinType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


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
        $message='';
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

                $message="Data added successfully....";
                $currentUrl = $this->getRequest()->getUri();
                return $this->redirect($currentUrl); 
                
            }
            
            return $this->render('AcmeTestBundle:join:join.html.twig',$arrayName = array('form' => $form->createView(),'message'=>''));
        }

    	return $this->render('AcmeTestBundle:join:join.html.twig',$arrayName = array('form' => $form->createView(),'message'=>''));
    }
    public function clientAction()
    {
    	return $this->render('AcmeTestBundle:clients:client.html.twig');
    }
    public function termsAction()
    {
        return $this->render('AcmeTestBundle:terms:terms.html.twig');
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
}

