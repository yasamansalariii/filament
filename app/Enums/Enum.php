<?php

namespace App\Enums;

trait Enum
{
    public function toString(): string
    {
        return $this->value;
    }

    public static function defaultValue(): string
    {
        return static::default()->toString();
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function randomValue(): string
    {
        $arr = array_column(static::cases(), 'value');

        return $arr[array_rand($arr)];
    }

    public static function randomName(): string
    {
        $arr = array_column(self::cases(), 'name');

        return $arr[array_rand($arr)];
    }
}
