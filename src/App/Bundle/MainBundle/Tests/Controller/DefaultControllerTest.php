<?php

namespace App\Bundle\MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/users');

        $this->assertTrue($crawler->filter('html:contains("Andre")')->count() > 0);
    }
}
