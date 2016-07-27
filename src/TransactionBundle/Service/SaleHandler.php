<?php

namespace TransactionBundle\Service;

use Symfony\Component\HttpFoundation\Response;

class SaleHandler
{
    //To store the entity manager
    private $em;
    
    public function __construct($em) 
    {
        $this->em = $em;
    }
    
    public function processSaleTransaction()
    {
        //For test purpose...(to be removed)
        $sale1 = $this->em->getRepository('TransactionBundle:Sale')->find(1);
        return $sale1->getAmount();
    }
}
