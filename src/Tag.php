<?php
interface iTag
{
    // Геттер имени:
    public function getName(): string;

    // Геттер текста:
    public function getText(): string;

    // Геттер всех атрибутов:
    public function getAttrs(): array;

    // Геттер одного атрибута по имени:
    public function getAttr(string $name): string|null;

    // Открывающий тег, текст и закрывающий тег:
    public function show(): string;

    // Открывающий тег:
    public function open(): string;

    // Закрывающий тег:
    public function close(): string;

    // Установка текста:
    public function setText(string $text);

    // Установка атрибута:
    public function setAttr(string $name, string $value = null);

    // Установка атрибутов:
    public function setAttrs(array $attrs);

    // Удаление атрибута:
    public function removeAttr(string $name);

    // Установка класса:
    public function addClass(string $className);

    // Удаление класса:
    public function removeClass(string $className);
}

class Tag implements iTag
{
    private string $name;
    private string $text = '';
    private array $attrs = [];

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function getAttrs(): array
    {
        return $this->attrs;
    }

    public function getAttr($attr): string|null
    {
        if (isset($this->attrs[$attr])) {
            return $this->attrs[$attr];
        } else {
            return null;
        }
    }

    public function show(): string
    {
        return "{$this->open()}{$this->text}{$this->close()}";
    }

    public function open(): string
    {
        $name = $this->name;
        $attrStr = $this->getAttrsStr($this->attrs);
        return "<$name$attrStr>";
    }

    public function close(): string
    {
        return "</$this->name>";
    }

    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }

    public function setAttr(string $name, string $value = null)
    {
        $this->attrs[$name] = $value;
        return $this;
    }

    public function setAttrs(array $attrs)
    {
        foreach ($attrs as $name => $value) {
            $this->setAttr($name, $value);
        }
        return $this;
    }

    public function removeAttr(string $attr)
    {
        unset($this->attrs[$attr]);
        return $this;
    }

    public function addClass(string $className)
    {
        if (isset($this->attrs["class"])) {
            $classNames = explode(" ", $this->attrs["class"]);

            if (!in_array($className, $classNames)) {
                $classNames[] = $className;

                $this->attrs["class"] = implode(" ", $classNames);
            }
        } else {
            $this->attrs["class"] = $className;
        }

        return $this;
    }

    public function removeClass($className)
    {
        if (isset($this->attrs["class"])) {
            $classNames = explode(" ", $this->attrs["class"]);

            if (in_array($className, $classNames)) {
                $classNames = $this->removeElem($className, $classNames);
                $this->attrs["class"] = implode(" ", $classNames);
            }
        }
        return $this;
    }

    private function getAttrsStr(array $attrs): string
    {
        $result = "";

        if (!empty($attrs)) {
            foreach ($attrs as $name => $value) {
                if ($value) {
                    $result .= " $name=\"$value\"";
                } else {
                    $result .= " $name";
                }
            }

            return $result;
        } else {
            return $result;
        }
    }

    private function removeElem(string $elem, array $arr): array
    {
        $key = array_search($elem, $arr);
        array_splice($arr, $key, 1);

        return $arr;
    }
}