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
use TransactionBundle\Entity\Product;

class ReportHandlerTest extends WebTestCase
{
    private $em;
    private $application;
    private $reportHandler;


    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        
        $this->application = new Application(static::$kernel);
        $this->em = $this->application->getKernel()->getContainer()->get('doctrine.orm.entity_manager');
        $this->reportHandler = $this->application->getKernel()->getContainer()->get('km.report_handler');
    }
    
    public function testGetReportA()
    {
        //Parameters
        $initialDate = new \DateTime('01-01-17');
        $finalDate = new \DateTime('15-01-17');
        
        $result1 = $this->reportHandler->getReportA($initialDate, $finalDate, [], []);
        $this->assertEquals($result1, '');
    }
    
    public function testBuildReportAoneProduct()
    {
        //Parameters
        $initialDate = new \DateTime('01-01-2008');
        $finalDate = new \DateTime('01-01-2009');
        $product = $this->em->getRepository('TransactionBundle:Product')->find(1);
        $product = $this->reportHandler->buildReportAoneProduct($initialDate, $finalDate, $product);
        
        $this->assertEquals($product->getFlyProfit(), 246);
        $this->assertEquals($product->getFlyAmount(), 260);
    }
    
    public function testBuildReportAmanyProducts()
    {
        //Parameters
        $initialDate = new \DateTime('-1 day');
        $finalDate = new \DateTime('-2 day');
        //$product = new Product;
        $this->reportHandler->buildReportAmanyProducts(array());
    }
    
    public function testRemoveOneProduct()
    {
        //List of product that must not be reported
        $p1 = new Product();
        $p2 = new Product();
        $p3 = new Product();
        $p3->setBarcode('1');
        
        $unreportedProducts = array($p1, $p2, $p3);
        $toBeRemoved = new Product;
        $toBeRemoved->setBarcode('1');
        $result1 = $this->reportHandler->removeOneProduct($unreportedProducts, $toBeRemoved);
        $this->assertEquals($result1, array($p1, $p2));
    }
    
    public function testRemoveManyProducts()
    {
        //List of product that must not be reported
        $p1 = new Product();
        $p2 = new Product();
        $p3 = new Product();
        
        $p1->setBarcode('1');
        $p2->setBarcode('2');
        $p3->setBarcode('3');
        
        //List of product that must not be reported
        $p4 = new Product();
        $p5 = new Product();
        $p6 = new Product();
        
        $p4->setBarcode('4');
        $p5->setBarcode('5');
        $p6->setBarcode('6');
        
        $unreportedProducts = array($p1, $p2, $p3, $p4, $p5, $p6);
        
        $productToBeUnreported = array($p4, $p5, $p6);
        
        $result1 = $this->reportHandler->removeManyProducts($unreportedProducts, $productToBeUnreported);
        $this->assertEquals($result1, array($p1, $p2, $p3));
    }
}

