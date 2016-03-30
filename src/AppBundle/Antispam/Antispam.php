<?php

namespace AppBundle\Antispam;

class Antispam
{
    private $antispamLength;

    public function __construct($antispamLength)
    {
        $this->antispam = $antispamLength;
    }

    public function isSpam($text)
    {
       return strlen($text) > $this->antispamLength;
    }
}