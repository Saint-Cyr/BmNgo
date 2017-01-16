<?php

namespace KmBundle\Service;

use KmBundle\Entity\Branch;
use TransactionBundle\Entity\Product;
use TransactionBundle\Entity\Stock;

class ReportHandler
{
    //To store the entity manager
    private $em;
    
    public function __construct($em) 
    {
        $this->em = $em;
    }
    
    
    /**
     * 
     * @param \DateTime $initialDate
     * @param \DateTime $finalDate
     * @param array $productToBeReported
     * this method generate one of the types of report (ReportA). it is suitable for business like cafe internet...
     * it build a table with a flexible number of culumn where each culumn can represent a product or a set of
     * product. See the Super-admin Guid for more information
     */
    public function getReportA(\DateTime $initialDate, \DateTime $finalDate, array $productToBeReported, array $productToBeUnreported)
    {
        $reportedProducts = array();
        $unreportedProducts = array();
        
        foreach ($productToBeReported as $p){
            //Build the reportA for this particular product and push it in the output variable ($reportedProducts)
            //$reportedProducts = $this->buildReportAoneProduct($initialDate, $finalDate, $p)
            //Remove this product from the list of unreportedProduct
            //$this->removeOneProduct($unreportedProducts, $p);
            //Remove the products that must not be considered in the report
            //$this->removeManyProducts($unreportedProducts, $productToBeUnreported);
            //Build the last column of the table of the report with the unselected products 
            //(that are not part of $productToBeUnreported)
            //$reportedProducts['other'] = $this->buildReportAmanyProducts($unreportedProducts);
            return $reportedProducts;
        }
    }
    
    public function buildReportAoneProduct(\DateTime $initialDate, \DateTime $finalDate, Product $product)
    {   
        $sales = $this->em->getRepository('TransactionBundle:Sale')
                      ->getSaleFromTo($initialDate, $finalDate, $product);
        
        $profit = null;
        $amount = null;
        
        foreach ($sales as $s){
            $profit = $profit + $s->getProfit();
            $amount = $amount + $s->getAmount();
        }
        
        $product->setFlyProfit($profit);
        $product->setFlyAmount($amount);
        
        return $product;
    }
    
    public function buildReportAmanyProducts(array $unreportedProducts)
    {
        
    }
    
    /*
     * Remove a product in the array of products
     */
    public function removeOneProduct(array $unreportedProducts, Product $product)
    {
        foreach ($unreportedProducts as $key => $value){
            if($value == $product){
                array_splice($unreportedProducts, $key, 1);
            }
        }
        
        return $unreportedProducts;
    }
    
    /*
     * Remove a set of product from the list of unreported products
     */
    public function removeManyProducts(array $unreportedProducts, array $productsToBeUnreported)
    {   
        $unreportedProducts = array_udiff($unreportedProducts, $productsToBeUnreported,
                function($object_a, $object_b){
                    return $object_a->getBarcode() - $object_b->getBarcode();
                }
        );
        
        return $unreportedProducts;
    }
}
