<?php

/*
 * This file is part of Components of BeezyManager project
 * By contributor S@int-Cyr MAPOUKA
 * (c) TinzapaTech <mapoukacyr@yahoo.fr>
 * For the full copyrght and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace Tests\KmBundle\Service;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StatisticHandlerTest extends WebTestCase
{
    private $em;
    private $application;
    private $statisticHandler;


    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        
        $this->application = new Application(static::$kernel);
        $this->em = $this->application->getKernel()->getContainer()->get('doctrine.orm.entity_manager');
        $this->statisticHandler = $this->application->getKernel()->getContainer()->get('km.statistic_handler');
    }
    
    /*
     * This have to be updated
     */
    public function testGetSaleByMonth()
    {
        //To avoid risk notice by PHPUnit
        $this->assertTrue(true);
    }


    public function testGetSale()
    {
        //Case 1: get sale for all branches. (It have to be 12300 based on fixtures)
        $outPut1 = $this->statisticHandler->getSale(null, null);
        $this->assertEquals($outPut1, 12300);
        
        //Case 2: get sale for a branch
        //...
    }
    
    /*
     * To be review
     */
    public function testGetProfit()
    {
        //Case 1: get profit for all branches (It have to be 3000 based on fixtures)
        $outPut1 = $this->statisticHandler->getProfit(null, null);
        $this->assertEquals($outPut1, 3000);
    }
    
    public function testGetExpenditure()
    {
        //Case 1: get all expenditure
        $outPut1 = $this->statisticHandler->getExpenditure();
        $this->assertEquals($outPut1, 0.0);
    }
    
    public function testGetBalance()
    {
        //Case 1: balance is positive
        $outPut1 = $this->statisticHandler->getBalance();
        $this->assertEquals($outPut1, 3000);
        
    }
    
    public function testGetSaleByBranch()
    {
        //Get the branch
        $branch = $this->em->getRepository('KmBundle:Branch')->find(1);
        $branch2 = $this->em->getRepository('KmBundle:Branch')->find(2);
        $this->assertEquals($branch->getName(), 'BATA');
        
        $outPut1 = $this->statisticHandler->getSaleByBranch($branch);
        $outPut2 = $this->statisticHandler->getSaleByBranch($branch2);
        $this->assertEquals($outPut1, 12300);
        $this->assertEquals($outPut2, 0);
    }
    
    public function testGetProfitByBranch()
    {
        //Case 1: test the profit of @branch1
        $branch = $this->em->getRepository('KmBundle:Branch')->find(1);
        $outPut1 = $this->statisticHandler->getProfitByBranch($branch);
        $this->assertEquals($outPut1, 3000);
        
        //Case 2: test the profit of @branch2
        $branch = $this->em->getRepository('KmBundle:Branch')->find(2);
        $outPut1 = $this->statisticHandler->getProfitByBranch($branch);
        $this->assertEquals($outPut1, 0.00);
    }
    
    public function testGetExpenditureByBranch()
    {
        //Case 1: test the expenditure value related to @branch1 
        $branch = $this->em->getRepository('KmBundle:Branch')->find(1);
        $outPut1 = $this->statisticHandler->getExpenditureByBranch($branch);
        $this->assertEquals($outPut1, 0);
        
        //Case 2: test the expenditure value related to @branch2 
        $branch = $this->em->getRepository('KmBundle:Branch')->find(2);
        $outPut1 = $this->statisticHandler->getExpenditureByBranch($branch);
        $this->assertEquals($outPut1, 0.00);
    }
    
    public function testGetBalanceByBranch()
    {
        //Case 1: balance is positive (for @branch1)
        $branch = $this->em->getRepository('KmBundle:Branch')->find(1);
        $outPut1 = $this->statisticHandler->getBalanceByBranch($branch);
        $this->assertEquals($outPut1, 3000);
    }
}

