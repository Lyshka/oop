<?php
require_once "./Tag.php";

class Img extends Tag
{
    public function __construct()
    {
        $this->setAttr("src", "")->setAttr("alt", "");
        parent::__construct("img");
    }

    public function __tostring()
    {
        return $this->open();
    }
}

$img = new Img();
echo $img->setAttrs(["width" => 200, "height" => 300])->setAttr("src", "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/0f/ba/29/5c/img-worlds-of-adventure.jpg?w=900&h=500&s=1")->setAttr("alt", "Парк");