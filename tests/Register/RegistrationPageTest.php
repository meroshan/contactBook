<?php

namespace ContactBook\Tests\Register;

use ContactBook\Tests\AbstractTestCase;
use ContactBook\Tests\Page\Register;

/**
 * Created by PhpStorm.
 * User: deepak
 * Date: 2/22/17
 * Time: 4:21 PM
 */
class RegistrationPageTest extends AbstractTestCase
{
    public function testEmailField()
    {
        $this->assertEquals(
            1,
            $this->getRegisterCrawler()->filter($this->getPage()->getEmailField())->count()
        );
    }

    public function testUserNameField()
    {
        $this->assertEquals(
            1,
            $this->getRegisterCrawler()->filter($this->getPage()->getUserNameField())->count()
        );
    }

    public function testPasswordField()
    {
        $this->assertEquals(
            1,
            $this->getRegisterCrawler()->filter($this->getPage()->getPasswordField())->count()
        );
    }

    public function testConfirmPasswordField()
    {
        $this->assertEquals(
            1,
            $this->getRegisterCrawler()->filter($this->getPage()->getConfirmPasswordField())->count()
        );
    }

    protected function getRegisterCrawler()
    {
        $crawler = $this->getClient()
            ->request('GET', '/register/');

        return $crawler;
    }

    protected function getPage()
    {
        return new Register();
    }
}
