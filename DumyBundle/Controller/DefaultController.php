<?php

namespace Acme\DumyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeDumyBundle:Default:index.html.twig', array('name' => $name));
    }
}
