<?php

/*
 * This file is part of Components of KingManager project
 * By contributor S@int-Cyr MAPOUKA
 * (c) TizampaTech <mapoukacyr@yahoo.fr>
 * For the full copyrght and license information, please view the LICENSE
 * file that was distributed with this source code
 */
namespace Tests\TransactionBundle\Entity;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SaleTest extends WebTestCase
{
    private $em;
    private $application;
    private $saleHandler;


    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        
        $this->application = new Application(static::$kernel);
        $this->em = $this->application->getKernel()->getContainer()->get('doctrine.orm.entity_manager');
        $this->saleHandler = $this->application->getKernel()->getContainer()->get('transaction.sale_handler');
    }
    
    public function testGetProfit()
    {
        $this->assertTrue(true);
        $sale = $this->em->getRepository('TransactionBundle:Sale')->find(1);
        $this->assertEquals($sale->getProfit(), 50);
        
        $sale = $this->em->getRepository('TransactionBundle:Sale')->find(2);
        $this->assertEquals($sale->getProfit(), 150);
        
        $sale = $this->em->getRepository('TransactionBundle:Sale')->find(3);
        $this->assertEquals($sale->getProfit(), 300);
        
        $sale = $this->em->getRepository('TransactionBundle:Sale')->find(12);
        $this->assertEquals($sale->getProfit(), null);
        
    }
    
    public function testGetAmount()
    {
        $sale1 = $this->em->getRepository('TransactionBundle:Sale')->find(1);
        $this->assertEquals($sale1->getAmount(), 150);
        
        $sale2 = $this->em->getRepository('TransactionBundle:Sale')->find(2);
        $this->assertEquals($sale2->getAmount(), 300);
        
        $sale3 = $this->em->getRepository('TransactionBundle:Sale')->find(3);
        $this->assertEquals($sale3->getAmount(), 600);
        
        $sale4 = $this->em->getRepository('TransactionBundle:Sale')->find(4);
        $this->assertEquals($sale4->getAmount(), 4500);
        
        $sale5 = $this->em->getRepository('TransactionBundle:Sale')->find(5);
        $this->assertEquals($sale5->getAmount(), 250);
    }
    
    public function testSetAmount()
    {
        $this->assertTrue(true);
        $sale = $this->em->getRepository('TransactionBundle:Sale')->find(1);
        $sale->setAmount(100);
        $this->assertEquals(100, $sale->getAmount());
        
        $sale->setAmount();
        $this->assertEquals(150, $sale->getAmount());
    }
}
