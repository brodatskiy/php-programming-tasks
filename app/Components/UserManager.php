<?php

namespace Project\App\Components;
class UserManager
{

    private MailInterface $mailer;

    public function __construct(MailInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function register($email, $password)
    {
        // The user just registered, we create his account
        // ...

        // We send him an email to say hello!
        $this->mailer->mail($email, 'Hello and welcome!');
    }

}