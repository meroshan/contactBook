<?php

namespace ContactBook\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PropelException;

/**
 * Created by PhpStorm.
 * User: deepak
 * Date: 2/22/17
 * Time: 2:33 PM
 */
class AbstractTestCase extends WebTestCase
{
    protected $client;

    public function setUp()
    {
        try {
            $this->client = static::createClient();
        } catch (PropelException $e) {
            $this->client = static::createClient();
        }
    }

    protected function getClient()
    {
        return $this->client;
    }
}
