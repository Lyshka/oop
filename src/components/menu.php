<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/Class/Link.php";

echo (new Link("/pages/first.php"))->setText("first") . "<br>";
echo (new Link("/pages/second.php"))->setText("second") . "<br>";
echo (new Link("/pages/third.php"))->setText("third") . "<br>";