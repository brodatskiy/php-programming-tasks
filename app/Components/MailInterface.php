<?php

namespace Project\App\Components;

interface MailInterface
{
    public function mail($recipient, $content);
}
