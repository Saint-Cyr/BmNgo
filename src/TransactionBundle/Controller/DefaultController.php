<?php

namespace TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function wayBillAction()
    {
        return $this->render('TransactionBundle:Default:way_bill.html.twig');
    }
    
    public function saleAction(Request $request)
    {
        //Get the data structure that came from the client as an array
        $data = json_decode($request->getContent(), true);
        //Get the sale handler service
        $saleHandler = $this->get('transaction.sale_handler');
        //Process the sale transaction
        /*@Saint-Cyr NOTICE: because it is the Starter formular, we just manager one branch but we still have the right DB schema in order
         * to keep compatibility with other formula so that when a customer want to upgrade, it make it easy for us. And we consider as
         * one branch the the very first one in the database also we'll make sure the prevent other registration of any other branch
         */
        //$mainBranch = $this->getDoctrine()->getManager()->getRepository('KmBundle:Branch')->find(1);
        //Get the user in order to get it related branch and use it 
        $user = $this->getUser();
        if(!$user){
            $this->createNotFoundException("User not found.");
        }
        
        $branch = $user->getBranch();
        $saleHandler->processSaleTransaction($data, $branch);
        
        $response = new Response('Successfull transaction');
                            
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost');
        
        return $response;
    }
    
    public function posAction()
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get the list of all the products
        $products = $em->getRepository('TransactionBundle:Product')->findAll();
        
        return $this->render('TransactionBundle:POS:pos.html.twig', array('products' => $products));
    }
    
    public function pos2Action()
    {
        //Get the entity manager
        $em = $this->getDoctrine()->getManager();
        //Get the list of all the products
        $products = $em->getRepository('TransactionBundle:Product')->findAll();
        //Get the list of all the categories
        $categories = $em->getRepository('TransactionBundle:Category')->findAll();

        return $this->render('TransactionBundle:POS:pos2.html.twig', array('categories' => $categories,
                                                                           'products' => $products));
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
