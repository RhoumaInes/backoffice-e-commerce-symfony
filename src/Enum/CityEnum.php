<?php

namespace App\Enum;

enum CityEnum: string
{
    case TUNIS = 'Tunis';
    case SFAX = 'Sfax';
    case BIZERTE = 'Bizerte';
    case SOUSSE = 'Sousse';
    public function label(): string
    {
        return ucfirst(strtolower($this->name));
    }
}
