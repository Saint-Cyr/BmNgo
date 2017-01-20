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
        $initDate = new \DateTime('01-01-2008');
        $finitDate = new \DateTime('01-01-2011');
        
        $category1 = $this->em->getRepository('TransactionBundle:Category')->find(1);
        $category2 = $this->em->getRepository('TransactionBundle:Category')->find(2);
        
        $this->assertEquals($category1->getName(), 'Boutique');
        $this->assertEquals($category2->getName(), 'Secretariat');
        //As doctrine array is not supported we have to build a standard array
        $boutique = array();
        
        foreach ($category1->getProducts() as $product){
            $boutique[] = $product;
        }
        
        $secretariat = array();
        
        foreach ($category2->getProducts() as $product){
            $secretariat[] = $product;
        }
        
        $outPut1 = $this->reportHandler->getReportA($initDate, $finitDate, $secretariat, $boutique);
        //There are 1 array for reported product / services like Plastification, Scanner, ...and 1 array for Boutique (other)
        $this->assertEquals(count($outPut1), 2);
        //There are only 3 products in Boutique
        $this->assertEquals(count($outPut1['other']), 3);
        //Check each one of the product of the shop
        $this->assertEquals($outPut1['other'][0]->getName(), 'CD Simple');
        $this->assertEquals($outPut1['other'][1]->getName(), 'DVD');
        $this->assertEquals($outPut1['other'][2]->getName(), 'Manette 4500');
        //Check sale & profit amount for each one
        $this->assertEquals($outPut1['other'][0]->getFlyAmount(), 150);
        $this->assertEquals($outPut1['other'][0]->getFlyProfit(), 50);
        $this->assertEquals($outPut1['other'][1]->getFlyAmount(), 900);
        $this->assertEquals($outPut1['other'][1]->getFlyProfit(), 450);
        $this->assertEquals($outPut1['other'][2]->getFlyAmount(), 4500);
        $this->assertEquals($outPut1['other'][2]->getFlyProfit(), 2500);
        
        //There are six services in Secretariat
        $this->assertEquals(count($outPut1['reported']), 6);
        //Check each one of the 6 service of the secretariat
        $this->assertEquals($outPut1['reported'][0]->getName(), 'Plastification');
        $this->assertEquals($outPut1['reported'][1]->getName(), 'Scanner');
        $this->assertEquals($outPut1['reported'][2]->getName(), 'Photo44');
        $this->assertEquals($outPut1['reported'][3]->getName(), 'Photocopy');
        $this->assertEquals($outPut1['reported'][4]->getName(), 'Internet');
        $this->assertEquals($outPut1['reported'][5]->getName(), 'Serigraphy');
        //Check sale & profit amount for each one
        $this->assertEquals($outPut1['reported'][0]->getFlyAmount(), 750);
        $this->assertEquals($outPut1['reported'][0]->getFlyProfit(), 0);
        
    }
    
    public function testBuildReportAoneProduct()
    {
        
    }
    
    public function testBuildReportAmanyProducts()
    {
        
    }
    
    public function testGetProfitOnFly()
    {
        
    }
    
    public function testGetSaleAmountOnFly()
    {
        
    }
}

