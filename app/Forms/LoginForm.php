<?php

use \Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Form;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;

class LoginForm extends Form
{
    public function initialize()
    {
        $this->add(
            (new Text('email'))
                ->setFilters('email')
                ->addValidators([
                    new PresenceOf(['message' => 'The email is required']),
                    new Email(['message' => 'The email is not valid'])
                ])
                ->setAttribute('class', 'form-control')
        );

        $this->add(
            (new Password('password'))
                ->setFilters(['string','trim'])
                ->addValidator(new PresenceOf(['message' => 'The password is required']))
                ->setAttribute('class', 'form-control')
        );

    }
}