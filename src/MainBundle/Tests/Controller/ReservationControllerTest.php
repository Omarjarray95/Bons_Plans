<?php

namespace MainBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReservationControllerTest extends WebTestCase
{
    public function testAjout()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Res/Ajout');
    }

    public function testSupprimer()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Res/Supp');
    }

    public function testModifier()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/Res/Modif');
    }

}
