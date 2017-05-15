<?php

namespace TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use TransactionBundle\Entity\STransaction;

class ApiController extends Controller
{
    public function postSynchronizerAction(Request $request)
    {
        //Verbose
        $faild = false;
        $faildMessage = 'successful';

        $em = $this->getDoctrine()->getManager();
        //Get the input data sent by the front application
        $inputData = json_decode($request->getContent(), true);

        //Get the branch from the user object
        $user = $em->getRepository('UserBundle:User')
                   ->findOneBy(array('email' => $inputData['user_email']));

        $branch = $em->getRepository('KmBundle:Branch')
                     ->findOneBy(array('idSynchrone' => $inputData['branch_synchrone_id']));

        //Make sure object exist
        if((!$user) || (!$branch)){
            $faild = true;
            $faildMessage = 'user or branch does not exist';
        }else{
            //Get the STransaction handler service
            $saleHandler = $this->get('transaction.sale_handler');
            //Process the sale transaction
            //return $inputData['order'];
            $saleHandler->processSaleTransaction2($inputData, $branch, $user);
        }


        //Get the idSynchrone to give it back in order for the client to remove it from it cache
        $idSynchrone = $em->getRepository('TransactionBundle:STransaction')
            ->findOneBy(array('idSynchrone' => $inputData['st_synchrone_id']));

        return array('faild' => $faild,
                     'faildMessage' => $faildMessage,
                     'st_synchrone_id' => $idSynchrone->getIdSynchrone());
    }

    public function postSaleTransactionAction(Request $request)
    {
        
        //Get the input data sent by the front application
        $inputData = json_decode($request->getContent(), true);
        //Get the branch from the user object
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        $branch = $user->getBranch();
        
        $data = $inputData['data'];
        
        //Get the STransaction handler service
        $saleHandler = $this->get('transaction.sale_handler');
        //Process the sale transaction
        
        $saleHandler->processSaleTransaction($data, $branch);
        
        $response = new Response($this->get('translator')->trans('Successfull transaction!'));
                            
        $response->headers->set('Access-Control-Allow-Origin', 'http://127.0.0.1');
        return $response;
        //return View::create(array('info' => 'user of verifier_token: '.$inputData['verifier_token'].' has been logged out successfully.'), 200);
        
        return 'successfull transaction!';
    }
}