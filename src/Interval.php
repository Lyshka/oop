<?php
class Interval
{
    private DateTime $date1;
    private DateTime $date2;

    public function __construct(Date $date1, Date $date2)
    {
        $this->date1 = DateTime::createFromFormat("Y-m-d", $date1);
        $this->date2 = DateTime::createFromFormat("Y-m-d", $date2);
    }

    public function toDays(): int
    {
        return $this->different("days");
    }

    public function toMonths(): int
    {
        return $this->different("m");
    }

    public function toYears(): int
    {
        return $this->different("y");
    }

    private function different(string $property): int
    {
        return $this->date1->diff($this->date2)->$property;
    }
}