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

<<<<<<< HEAD
    public function testAffiche()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AfficheRes');
=======
    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/UpdateRes');
>>>>>>> fe7792dfe8f4206374c2c1594b1607f75d011706
    }

    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/DeleteRes');
    }

<<<<<<< HEAD
    public function testUpdate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/UpdateRes');
=======
    public function testAffiche()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/AfficheRes');
>>>>>>> fe7792dfe8f4206374c2c1594b1607f75d011706
    }

}
