<?php
namespace App\Enum;

enum AttributeType: string
{
    case DROPDOWN = 'Liste déroulante';
    case RADIO = 'Boutons radio';
    case COLOR = 'Couleur';
}