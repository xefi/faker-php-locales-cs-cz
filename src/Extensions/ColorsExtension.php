<?php

namespace Xefi\Faker\CsCz\Extensions;

use Xefi\Faker\Extensions\ColorsExtension as BaseColorsExtension;

class ColorsExtension extends BaseColorsExtension
{
    protected array $safeColorNames = [
        'Černá', 'Kaštanová', 'Zelená', 'Námořnická modrá', 'Olivová',
        'Nachová', 'Modrozelená', 'Limetková', 'Modrá', 'Stříbrná',
        'Šedá', 'Žlutá', 'Fuchsiová', 'Vodní modrá', 'Bílá',
    ];

    protected array $colorNames = [
        'Černá', 'Kaštanová', 'Zelená', 'NámořnickáModrá', 'Olivová',
        'Nachová', 'Modrozelená', 'Limetková', 'Modrá', 'Stříbrná',
        'Šedá', 'Žlutá', 'Fuchsiová', 'VodníModrá', 'Bílá',
        'Béžová', 'Čokoládová', 'Korálová', 'Azurová', 'Karmínová',
        'TmavěModrá', 'TmavěOranžová', 'Cihlová', 'MořskáZelená', 'KvětinověBílá',
        'LesníZelená', 'Zlatá', 'Růžová', 'Indigová', 'Khaki',
        'Levandulová', 'SvětleModrá', 'SvětleKorálová', 'SvětleZelená', 'SvětleLososová',
        'Lněná', 'Purpurová', 'StředněModrá', 'StředněOrchidejová', 'Mokasínová',
        'Oranžová', 'Červená', 'Švestková', 'PeruánskáHnědá', 'KrálovskáModrá',
        'Lososová', 'PísečnáHnědá', 'NebeskáModrá', 'Sněhová', 'Tyrkysová',
        'Fialová', 'KouřověBílá',
    ];

    /**
     * Returns the locale handled by this extension.
     *
     * @return string|null
     */
    public function getLocale(): ?string
    {
        return 'cs_CZ';
    }
}
