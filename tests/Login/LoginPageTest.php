<?php

namespace ContactBook\Tests\Login;

use ContactBook\Tests\AbstractTestCase;
use ContactBook\Tests\Page\LogIn;

class LoginPageTest extends AbstractTestCase
{
    public function testUserNameField()
    {
        $this->assertEquals(
            1,
            $this->getLogInCrawler()->filter($this->getPage()->getUserNameField())->count()
        );
    }

    public function testPasswordField()
    {
        $this->assertEquals(
            1,
            $this->getLogInCrawler()->filter($this->getPage()->getPasswordField())->count()
        );
    }

    public function testSubmitButton()
    {
        $this->assertEquals(
            1,
            $this->getLogInCrawler()->filter($this->getPage()->getSubmitButton())->count()
        );
    }

    public function testRegisterButton()
    {
        $this->assertEquals(
            1,
            $this->getLogInCrawler()->filter($this->getPage()->getRegisterButoon())->count()
        );
    }

    public function testForgetPasswordLink()
    {
        $this->assertEquals(
            1,
            $this->getLogInCrawler()->filter($this->getPage()->getPasswordForgetLink())->count()
        );
    }

    protected function getLogInCrawler()
    {
        $crawler = $this->getClient()
            ->request('GET', '/login');

        return $crawler;
    }

    protected function getPage()
    {
        return new LogIn();
    }
}
