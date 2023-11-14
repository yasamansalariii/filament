<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UnitType: string implements HasLabel
{
    use Enum;

    case Gram = 'gr';
    case Kilo = 'kg';
    case Liter = 'ltr';
    case Spoon = 'sp';
    case Cup = 'cup';
    case Number = 'n';
    case Unknown = 'u';

    public function getLabel(): ?string
    {
        // dg baghish ro khodet bezan (samte chap mishe case samte rast mishe ebarat ke az translate laravel ham estefade mikonim baraye chang zabane boodan)
        return match ($this) {
            self::Gram => __('gr'),
            self::Kilo => __('kg'),
        };
    }

    public static function default(): static
    {
        return self::Unknown;
    }
}
