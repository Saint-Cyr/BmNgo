<?php

/*
 * This file is part of Components of KingManager project
 * By contributor S@int-Cyr MAPOUKA
 * (c) YAME Group <info@yamegroup.com>
 * For the full copyrght and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace Tests\TransactionBundle\Service;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SaleHandlerTest extends WebTestCase
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
    
    public function testProcessSaleTransaction()
    {
        //Get an instance of a sale transaction from the fixtures
        $sTransaction = $this->em->getRepository('TransactionBundle:STransaction')->find(1);
        //Prepare a dummy inputData from the front-end
        $sale1 = array('productId' => 1, 'productName' => 'Iron', 'quantity' => 1, 'price'=> 50, 'saleAmount' => 50);
        $sale2 = array('productId' => 2, 'productName' => 'Iron2', 'quantity' => 2, 'price'=> 51, 'saleAmount' => 51);
        //Package the sale in a Stransaction
        $sTransaction2[] = $sale1;
        $sTransaction2[] = $sale2;
        //Data structure that can be sent by the end point to the server
        $data = array('total' => 50, 'stransaction' => $sTransaction2);
        //Get the sale_handler service
        //$this->saleHandler->processSaleTransaction($data);
        //Get the lastested insered id
        $id = 2;
        $sTransaction3 = $this->em->getRepository('TransactionBundle:STransaction')->find($id);
        //Check that there are two sales item in the transaction
        //$this->assertEquals(count($sTransaction3->getSales()), 2);
    }
}
