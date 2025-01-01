<?php
class Date
{
    private DateTime $date;
    private const LANGUAGES = ["en" => "en", "ru" => "ru"];
    private const MONTHS = [
        1 => [self::LANGUAGES["en"] => "January", self::LANGUAGES["ru"] => "Январь"],
        2 => [self::LANGUAGES["en"] => "February", self::LANGUAGES["ru"] => "Февраль"],
        3 => [self::LANGUAGES["en"] => "March", self::LANGUAGES["ru"] => "Март"],
        4 => [self::LANGUAGES["en"] => "April", self::LANGUAGES["ru"] => "Апрель"],
        5 => [self::LANGUAGES["en"] => "May", self::LANGUAGES["ru"] => "Май"],
        6 => [self::LANGUAGES["en"] => "June", self::LANGUAGES["ru"] => "Июнь"],
        7 => [self::LANGUAGES["en"] => "July", self::LANGUAGES["ru"] => "Июль"],
        8 => [self::LANGUAGES["en"] => "August", self::LANGUAGES["ru"] => "Август"],
        9 => [self::LANGUAGES["en"] => "September", self::LANGUAGES["ru"] => "Сентябрь"],
        10 => [self::LANGUAGES["en"] => "October", self::LANGUAGES["ru"] => "Октябрь"],
        11 => [self::LANGUAGES["en"] => "November", self::LANGUAGES["ru"] => "Ноябрь"],
        12 => [self::LANGUAGES["en"] => "December", self::LANGUAGES["ru"] => "Декабрь"],
    ];
    private const WEEKDAYS = [
        1 => [self::LANGUAGES["en"] => "Monday", self::LANGUAGES["ru"] => "Понедельник"],
        2 => [self::LANGUAGES["en"] => "Tuesday", self::LANGUAGES["ru"] => "Вторник"],
        3 => [self::LANGUAGES["en"] => "Wednesday", self::LANGUAGES["ru"] => "Среда"],
        4 => [self::LANGUAGES["en"] => "Thursday", self::LANGUAGES["ru"] => "Четверг"],
        5 => [self::LANGUAGES["en"] => "Friday", self::LANGUAGES["ru"] => "Пятница"],
        6 => [self::LANGUAGES["en"] => "Saturday", self::LANGUAGES["ru"] => "Суббота"],
        7 => [self::LANGUAGES["en"] => "Sunday", self::LANGUAGES["ru"] => "Воскресенье"],
    ];

    public function __construct($date = null)
    {
        $oldDate = $date ?? (new DateTime())->format("Y-m-d");
        $this->date = DateTime::createFromFormat("Y-m-d", $oldDate);
    }

    public function getDay(): int
    {
        return (int) $this->date->format("d");
    }

    public function getMonth(string $lang = self::LANGUAGES["en"]): string
    {
        $currentMonth = (int) $this->date->format("m");
        return self::MONTHS[$currentMonth][$lang];
    }

    public function getYear(): int
    {
        return (int) $this->date->format("Y");
    }

    public function getWeekDay(string $lang = self::LANGUAGES["en"]): string
    {
        $currentWeekDay = (int) $this->date->format("W");
        return self::WEEKDAYS[$currentWeekDay][$lang];
    }

    public function addDay(int $value)
    {
        $this->date->modify("+$value day");
        return $this;
    }

    public function subDay(int $value)
    {
        $this->date->modify("-$value day");
        return $this;
    }

    public function addMonth(int $value)
    {
        $this->date->modify("+$value month");
        return $this;
    }

    public function subMonth(int $value)
    {
        $this->date->modify("-$value month");
        return $this;
    }

    public function addYear(int $value)
    {
        $this->date->modify("+$value year");
        return $this;
    }

    public function subYear(int $value)
    {
        $this->date->modify("-$value year");
        return $this;
    }

    public function format(string $format): string
    {
        return $this->date->format($format);
    }

    public function __toString(): string
    {
        return $this->date->format("Y-m-d");
    }
}