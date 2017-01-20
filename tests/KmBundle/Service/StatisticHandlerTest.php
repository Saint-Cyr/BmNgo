<?php

/*
 * This file is part of Components of BeezyManager project
 * By contributor S@int-Cyr MAPOUKA
 * (c) TinzapaTech <mapoukacyr@yahoo.fr>
 * For the full copyrght and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace Tests\TransactionBundle\Service;

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
            
    }


    public function testGetSale()
    {
        
    }
    
    /*
     * To be review
     */
    public function testGetProfit()
    {
        
    }
    
    public function testGetExpenditure()
    {
        
    }
    
    public function testGetBalance()
    {
        
    }
    
    public function testGetSaleByBranch()
    {
        
    }
    
    public function testGetProfitByBranch()
    {
        
    }
    
    public function testGetExpenditureByBranch()
    {
        
    }
    
    public function testGetBalanceByBranch()
    {
        
    }
}

