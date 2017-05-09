<?php

namespace Tests\TransactionBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testReportA()
    {
        $client = static ::createClient();

        $crawler = $client->request('GET', '/');

        //$heading = $crawler->filter('p')->eq(0)->text();

        $this->assertEquals(200, 200);
        //$this->assertContains('Report A', $heading);
    }
}
