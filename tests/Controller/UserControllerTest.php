<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserControllerTest extends WebTestCase
{

    public function testInscription()
    {
        //on crée un client HTTP (navigateur)
        $client = static::createClient();

        // on exécute la requête HTTP avec la méthode GET sur l'url
        $client->request('GET', '/inscription');

        //on vérifie que le status de la réponse est bien 200 
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $this->assertSelectorTextContains('h1', 'Inscription');
    }
}