<?php

namespace KmBundle\Service;

use KmBundle\Entity\Branch;
use TransactionBundle\Entity\Product;
use TransactionBundle\Entity\Stock;

class StockHandler
{
    //To store the entity manager
    private $em;
    
    public function __construct($em) 
    {
        $this->em = $em;
    }
    
    /**
     * @param Branch | Product
     */
    public function updateStock(Branch $branch, Product $product)
    {
        foreach ($product->getStocks() as $stock){
            
            if($stock->getBranch()->getId() == $branch->getId()){
                
                $stock->decreaseValue();
            }
        }
    }
}
