<?php

namespace MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationControllerTest extends WebTestCase
{
    public function testAjout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AjoutRes');
    }

    public function testAffiche()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AfficheRes');
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/DeleteRes');
    }

    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/UpdateRes');
    }

}
