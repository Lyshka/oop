<?php
require_once "./Tag.php";

class Img extends Tag
{
    public function __construct($src, $alt = "")
    {
        $this->setAttr("src", $src)->setAttr("alt", $alt);
        parent::__construct("img");
    }

    public function __tostring()
    {
        return $this->open();
    }
}