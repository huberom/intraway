<?php

/**
 * @author Huber Muñoz <huberom@hotmail.com>
 */
namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SequenceControllerTest extends WebTestCase
{
    /*
     * Check if homepage is working as expected.
     * The status response is validated as well as
     * the home page header title (h1)
     */
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals('Subsequence Weighting', $crawler->filter('h1')->text());
    }

    /*
     * Test if server form validation returns proper
     * validation message
     */
    public function testFormvalidation()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/process', []);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $expected = strtolower('Please check form options and try again');
        $result = strtolower(trim($crawler->filter('form .alert-danger')->first()->text()));
        $this->assertEquals($expected, $result);
    }
}
