<?php

namespace BlogBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SchoolControllerTest extends WebTestCase
{
    public function testSchool()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/school/teachers');
    }

}
