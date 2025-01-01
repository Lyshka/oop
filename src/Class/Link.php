<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Class/Tag.php";

class Link extends Tag
{
    private const ACTIVE_CLASS = "active";
    public function __construct($href)
    {
        $this->setAttr("href", $href);
        parent::__construct("a");
    }

    public function open(): string
    {
        $this->activateSelf();
        return parent::open();
    }

    public function __tostring()
    {
        return $this->show();
    }

    private function activateSelf()
    {
        if ($this->getAttr("href") === $_SERVER['REQUEST_URI']) {
            $this->addClass(self::ACTIVE_CLASS);
        }
    }
}