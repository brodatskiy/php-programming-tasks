<?php
namespace Project\App\Components;
class Mailer implements MailInterface {

    public function mail($recipient, $content) {
        // send an email to the recipient
        echo 'Email has been sent';
    }
}
