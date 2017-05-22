<?php
/**
 * Created by PhpStorm.
 * User: deepak
 * Date: 2/22/17
 * Time: 4:28 PM
 */

namespace ContactBook\Tests\Page;

class Register
{
    public function getEmailField()
    {
        return 'input[name="fos_user_registration_form[email]"]';
    }

    public function getUserNameField()
    {
        return 'input[name="fos_user_registration_form[username]"]';
    }

    public function getPasswordField()
    {
        return 'input[name="fos_user_registration_form[plainPassword][first]"]';
    }

    public function getConfirmPasswordField()
    {
        return 'input[name="fos_user_registration_form[plainPassword][second]"]';
    }
}
