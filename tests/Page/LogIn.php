<?php

namespace ContactBook\Tests\Page;

/**
 * Created by PhpStorm.
 * User: deepak
 * Date: 2/22/17
 * Time: 2:41 PM
 */
class LogIn
{
    public function getUserNameField()
    {
        return 'input#username';
    }

    public function getPasswordField()
    {
        return 'input#password';
    }

    public function getSubmitButton()
    {
        return 'input#_submit';
    }

    public function getRegisterButoon()
    {
        return 'a[name="create_account"]';
    }

    public function getPasswordForgetLink()
    {
        return 'a[href="/resetting/request"]';
    }
}
