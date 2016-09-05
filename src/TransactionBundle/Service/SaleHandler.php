<?php

namespace TransactionBundle\Service;
use TransactionBundle\Entity\STransaction;
use TransactionBundle\Entity\Sale;

class SaleHandler
{
    //To store the entity manager
    private $em;
    
    public function __construct($em) 
    {
        $this->em = $em;
    }
    
    public function processSaleTransaction(array $inputData)
    {
        //Create an instance of a SaleTransaction
        $stransaction = new STransaction();
        $stransaction ->setTotalAmount($inputData['total']);
        
        //Loop over each sale
        foreach ($inputData['stransaction'] as $s){
            //create an instance of a sale
            $sale = new Sale();
            $sale->setAmount($s['saleAmount']);
            $sale->setStransaction($stransaction);
            $this->em->persist($sale);
        }
        //Persist its in DB.
        $this->em->flush();
    }
}
