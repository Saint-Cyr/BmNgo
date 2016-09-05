<?php

namespace TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ApiController extends Controller
{   
    public function postSaleTransactionAction(Request $request)
    {
        //Get the input data sent by the front application
        $inputData = json_decode($request->getContent(), true);
        return $inputData;
    }
}
