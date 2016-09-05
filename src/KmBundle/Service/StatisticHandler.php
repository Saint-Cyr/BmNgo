<?php

namespace KmBundle\Service;

class StatisticHandler
{
    //To store the entity manager
    private $em;
    
    public function __construct($em) 
    {
        $this->em = $em;
    }
    
    /**
     * @return type Description
     */
    public function getSale(array $input = null)
    {
        //Get all the saleTransaction and make the simple calculation
        $STransactions = $this->em->getRepository('TransactionBundle:STransaction')->findAll();
        $total = 0;
        foreach ($STransactions as $st){
            $total = $total + $st->getTotalAmount();
        }
        
        return $total;
    }
    
    /**
     * 
     * @param array $input
     */
    public function getProfit(array $input = null)
    {
        //Get all the saleTransaction and make the simple calculation
        $STransactions = $this->em->getRepository('TransactionBundle:STransaction')->findAll();
        $total = 0;
        foreach ($STransactions as $st){
            //Because STransaction:setProfit() is a custom methode, then call it
            $st->setProfit();
            $total = $total + $st->getProfit();
        }
        
        return $total;
    }
    
    /**
     * 
     * @param array $input
     */
    public function getExpenditure(array $input = null)
    {
        //Get all the expenditure
        $expenditures = $this->em->getRepository('KmBundle:Expenditure')->findAll();
        $total = 0.00;
        foreach ($expenditures as $exp){
            $total = $total + $exp->getAmount();
        }
        
        return $total;
    }
    
    /**
     * 
     * @param array $input
     */
    public function getBalance(array $input = null)
    {
        //A balance is just the difference between profit and expenditure
        return $this->getProfit() - $this->getExpenditure();
    }
    
    /**
     * 
     * @param \KmBundle\Entity\Branch $branch
     */
    public function getSaleByBranch(\KmBundle\Entity\Branch $branch)
    {
        //Get all the saleTransaction for the given branch
        $STransactions = $branch->getStransactions();
        $total = 0;
        foreach ($STransactions as $st){
            $total = $total + $st->getTotalAmount();
        }
        
        return $total;
    }
    
    /**
     * 
     * @param \KmBundle\Entity\Branch $branch
     */
    public function getProfitByBranch(\KmBundle\Entity\Branch $branch)
    {
        //Get all the saleTransactions related to the given branch
        $STransactions = $branch->getStransactions();
        $total = 0;
        foreach ($STransactions as $st){
            //Because STransaction:setProfit() is a custom methode, then call it
            $st->setProfit();
            $total = $total + $st->getProfit();
        }
        
        return $total;
    }
    
    /**
     * 
     * @param \KmBundle\Entity\Branch $branch
     */
    public function getExpenditureByBranch(\KmBundle\Entity\Branch $branch)
    {
        //Get all the expenditure related to the given branch
        $expenditures = $branch->getExpenditures();
        $total = 0.00;
        foreach ($expenditures as $exp){
            $total = $total + $exp->getAmount();
        }
        
        return $total;
    }
    
    /**
     * 
     * @param \KmBundle\Entity\Branch $branch
     */
    public function getBalanceByBranch(\KmBundle\Entity\Branch $branch)
    {
        //A balance is just the difference between profit and expenditure for the given branch
        $profit = $this->getProfitByBranch($branch);
        $expenditure = $this->getExpenditureByBranch($branch);
        
        return $profit - $expenditure;
    }
}
