<?php

namespace TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{   
    public function postSaleTransactionAction(Request $request)
    {
        //Get the input data sent by the front application
        $inputData = json_decode($request->getContent(), true);
        return $inputData['data'];
        //Get the STransaction handler service
        $saleHandler = $this->get('transaction.sale_handler');
        //Process the sale transaction
        return $inputData['data'];
        $saleHandler->processSaleTransaction($inputData);
        
        //return View::create(array('info' => 'user of verifier_token: '.$inputData['verifier_token'].' has been logged out successfully.'), 200);
        
        return 'successfull transaction !';
    }
}
