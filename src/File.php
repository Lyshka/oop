<?php
interface iFile
{
    public function __construct($filePath);

    public function getPath(): string; // путь к файлу
    public function getDir(): string;  // папка файла
    public function getName(): string; // имя файла
    public function getExt(): string;  // расширение файла
    public function getSize(): int; // размер файла

    public function getText(): string;          // получает текст файла
    public function setText(string $text);     // устанавливает текст файла
    public function appendText(string $text);  // добавляет текст в конец файла

    public function copy(string $copyPath);    // копирует файл
    public function delete();           // удаляет файл
    public function rename(string $newName);   // переименовывает файл
    public function replace(string $newPath);  // перемещает файл
}

class File implements iFile
{
    private string $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function getPath(): string
    {
        return $this->filePath;
    }

    public function getDir(): string
    {
        return dirname($this->filePath);
    }

    public function getName(): string
    {
        return basename($this->filePath);
    }

    public function getExt(): string
    {
        return pathinfo($this->filePath, PATHINFO_EXTENSION);
    }

    public function getSize(): int
    {
        return filesize($this->filePath);
    }

    public function getText(): string
    {
        return file_get_contents($this->filePath);
    }
    public function setText(string $text)
    {
        file_put_contents($this->filePath, $text);
        return $this;
    }

    public function appendText(string $text)
    {
        file_put_contents($this->filePath, $text, FILE_APPEND);
        return $this;
    }

    public function copy(string $copyPath)
    {
        copy($this->filePath, $copyPath . $this->getName());
        return $this;
    }

    public function delete()
    {
        unlink($this->filePath);
        return $this;
    }

    public function rename(string $newName)
    {
        rename($this->filePath, "{$this->getDir()}/$newName");
        $this->filePath = "{$this->getDir()}/$newName";
        return $this;
    }

    public function replace(string $newPath)
    {
        move_uploaded_file($this->filePath, "{$this->getDir()}/$newPath/{$this->getName()}");
        $this->filePath = "{$this->getDir()}/$newPath/{$this->getName()}";
        return $this;
    }
}