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

class StockHandlerTest extends WebTestCase
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
    public function testUpdateStock()
    {
        //Get the product and the stock
        $product = $this->em->getRepository('TransactionBundle:Product')->find(3);
        //it have to be Jus Top 0.35 L and it related stock
        $this->assertEquals($product->getName(), 'Jus Top 0.35 L');
        //Get the branch
        $branch = $this->em->getRepository('KmBundle:Branch')->find(3);
        //it have to be BATA
        $this->assertEquals($branch->getName(), 'BATA');
        $stocks = $product->getStocks();
        //Get the stockHandler service
        $stockHandler = $this->application->getKernel()->getContainer()->get('km.stock_handler');
        $stockHandler->updateStock($branch, $product);
        //Get the stock from the DB in order to check whether it have been updated effectivilly
        $stock = $this->em->getRepository('TransactionBundle:Stock')->find(1);
        $this->assertEquals($stock->getValue(), 9);
        //Attention ! NOTICE THAT WE DO NOT PERSIST THE CHANGE OF THE ABOVE LINE IN DATA BASE ALLTHOUGH THE TEST PAST
    }
}

