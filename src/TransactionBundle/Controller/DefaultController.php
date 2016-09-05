<?php

namespace TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TransactionBundle:Default:index.html.twig');
    }
    
    public function productListAction()
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get the products list
        $product = $em->getRepository('TransactionBundle:Product')->find(1);
        $data = '<button class="buttons btn btn-primary" ng-click="add('.$product->getId().')">'.$product->getName().'</button>';
        return new Response($data);
    }
}
