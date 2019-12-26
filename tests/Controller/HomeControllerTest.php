<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testHomepage()
    {
        //on crée un client HTTP (navigateur)
        $client = static::createClient();

        // on exécute la requête HTTP avec la méthode GET sur l'url
        $client->request('GET', '/');

        //on vérifie que le status de la réponse est bien 200 
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // on vérifie aussi que l'on a un contenu spécifique sur la page d'accueil
        $this->assertSelectorTextContains('a.search', 'RECHERCHER');
    }
}