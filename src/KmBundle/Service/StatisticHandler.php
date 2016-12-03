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
    
    public function getSaleByMonth2($year = null)
    {
        //Get the current year
        $date = new \DateTime("now");
        $currentYear = $date->format('y');
        //If the value of $year is not define then use the current year (default)
        if(!$year){
            $year = $currentYear;
        }
        
        //Get all the STransaction from the DB first.
        $STransactions = $this->em->getRepository('TransactionBundle:STransaction')->findAll();
        $months = array('jan' => 0, 'feb' => 0,  'mar' => 0, 'apr' => 0, 'may' => 0, 'jun' => 0, 'jul'
                              => 0, 'aug' => 0, 'sep' => 0, 'oct' => 0, 'nov' => 0, 'dec' => 0);
        foreach ($STransactions as $st){
            $m = $st->getCreatedAt()->format("m");
            $y = $st->getCreatedAt()->format("y");
            if($m == 01 && $y == $year){
                $months['jan'] = $months['jan'] + $st->getTotalAmount();
            }elseif($m == 11 && $y == $year){
                $months['nov'] = $months['nov'] + $st->getTotalAmount();
            }
        }
        
        return $months;
        
    }
    
    /**
     * @return type Description
     */
    public function getSaleByMonth($year = null)
    {
        //Get the current year
        $date = new \DateTime("now");
        $currentYear = $date->format('y');
        //If the value of $year is not define then use the current year (default)
        if(!$year){
            $year = $currentYear;
        }
        //Get all the STransaction from the DB first.
        $STransactions = $this->em->getRepository('TransactionBundle:STransaction')->findAll();
        
        $months = array('jan' => 0, 'feb' => 0,  'mar' => 0, 'apr' => 0, 'may' => 0, 'jun' => 0, 'jul'
                              => 0, 'aug' => 0, 'sep' => 0, 'oct' => 0, 'nov' => 0, 'dec' => 0);
        //return $currentYear;
        //Get all the saleTransaction and make the simple calculation for every month
        foreach ($STransactions as $st){
            $m = $st->getCreatedAt()->format("m");
            $y = $st->getCreatedAt()->format("y");
            if($m == 01 && $y == $year){
                $months['jan'] = $months['jan'] + $st->getTotalAmount();
            }elseif($m == 02 && $y == $year){
                $months['feb'] = $months['feb'] + $st->getTotalAmount();
            }elseif($m == 03 && $y == $year){
                $months['mar'] = $months['mar'] + $st->getTotalAmount();
            }elseif($m == 04 && $y == $year){
                $months['apr'] = $months['apr'] + $st->getTotalAmount();
            }elseif ($m == 05 && $y == $year) {
                $months['may'] = $months['may'] + $st->getTotalAmount();
            }elseif($m == 06 && $y == $year){
                $months['jun'] = $months['jun'] + $st->getTotalAmount();
            }elseif ($m == 07 && $y == $year) {
                $months['jul'] = $months['jul'] + $st->getTotalAmount();
            }elseif($m == '08' && $y == $year){
                $months['aug'] = $months['aug'] + $st->getTotalAmount();
            }elseif ($m == '09' && $y == $year) {
                $months['sep'] = $months['sep'] + $st->getTotalAmount();
            }elseif($m == 10 && $y == $year){
                $months['oct'] = $months['oct'] + $st->getTotalAmount();
            }elseif ($m == 11 && $y == $year) {
                $months['nov'] = $months['nov'] + $st->getTotalAmount();
            }elseif($m == 12 && $y == $year){
                $months['dec'] = $months['dec'] + $st->getTotalAmount();
            }
        }
        
        return $months;
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
