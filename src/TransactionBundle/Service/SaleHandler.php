<?php

namespace TransactionBundle\Service;
use TransactionBundle\Entity\STransaction;
use TransactionBundle\Entity\Sale;
use KmBundle\Entity\Branch;
//use FOS\RestBundle\View\View;

class SaleHandler
{
    //To store the entity manager
    private $em;
    
    public function __construct($em) 
    {
        $this->em = $em;
    }
    
    public function processSaleTransaction(array $inputData, Branch $branch)
    {
        //Create an instance of a SaleTransaction & hydrate it with the branch and the total amount of the transaction
        $stransaction = new STransaction();
        $stransaction->setTotalAmount($inputData['total']);
        $stransaction->setBranch($branch);
        //Link the employee to the transaction
        //...
        
        //Loop over each sale
        foreach ($inputData['order'] as $s){
            //create an instance of a sale
            $sale = new Sale();
            //Link the sale to the related product
            $product = $this->em->getRepository('TransactionBundle:Product')->find($s['item']['id']);
            $sale->setProduct($product);
            //Call the defaultHandler service to update the stock
            //...
            $sale->setAmount($s['totalPrice']);
            $sale->setStransaction($stransaction);
            $this->em->persist($sale);
        }
        //Persist its in DB.
        $this->em->persist($stransaction);
        $this->em->flush();
    }
}
