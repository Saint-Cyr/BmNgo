<?php

/*
 * This file is part of Components of KingManager project
 * By contributor S@int-Cyr MAPOUKA
 * (c) TinzapaTech <info@yamegroup.com>
 * For the full copyrght and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace Tests\TransactionBundle\Service;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class StockTest extends WebTestCase
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
    
    public function testIncreaseStock()
    {
        
    }
    
    public function testIsAlertStock()
    {
           
    }
}
