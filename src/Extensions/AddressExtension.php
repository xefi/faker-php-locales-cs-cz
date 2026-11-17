<?php

namespace Xefi\Faker\CsCz\Extensions;

use Xefi\Faker\Extensions\Extension;

class AddressExtension extends Extension
{
    protected $regions = [
        'Hlavní město Praha', 'Středočeský kraj', 'Jihočeský kraj', 'Plzeňský kraj', 'Karlovarský kraj',
        'Ústecký kraj', 'Liberecký kraj', 'Královéhradecký kraj', 'Pardubický kraj', 'Kraj Vysočina',
        'Jihomoravský kraj', 'Olomoucký kraj', 'Zlínský kraj', 'Moravskoslezský kraj',
    ];

    protected $cities = [
        'Praha', 'Brno', 'Ostrava', 'Plzeň', 'Liberec', 'Olomouc', 'České Budějovice', 'Hradec Králové',
        'Ústí nad Labem', 'Pardubice', 'Zlín', 'Havířov', 'Kladno', 'Most', 'Opava', 'Frýdek-Místek',
        'Karviná', 'Jihlava', 'Teplice', 'Děčín', 'Karlovy Vary', 'Chomutov', 'Jablonec nad Nisou',
        'Mladá Boleslav', 'Prostějov', 'Přerov', 'Česká Lípa', 'Třebíč', 'Třinec', 'Tábor',
    ];

    protected $streetNames = [
        'Masarykova', 'Husova', 'Palackého', 'Komenského', 'Nádražní', 'Školní', 'Zahradní', 'Krátká',
        'Dlouhá', 'Lipová', 'Polní', 'Luční', 'Nová', 'Smetanova', 'Jiráskova', 'Tyršova', 'Havlíčkova',
        'Riegrova', 'Žižkova', 'Sokolská', 'Revoluční', 'Na Výsluní', 'U Školy', 'Pod Lesem', 'K Nádraží',
        'Na Příkopě', 'Vodičkova', 'Karlova', 'Nerudova', 'Purkyňova', 'Bezručova', 'Lidická',
        'Svatopluka Čecha', 'Boženy Němcové', 'Jana Žižky', 'náměstí Míru', 'Václavské náměstí',
        'třída Svobody', 'Mírová', 'Slunečná',
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

    /**
     * Return a random Czech region (kraj).
     *
     * @return string
     */
    public function region(): string
    {
        return $this->pickArrayRandomElement($this->regions);
    }

    /**
     * Return a random Czech city.
     *
     * @return string
     */
    public function city(): string
    {
        return $this->pickArrayRandomElement($this->cities);
    }

    /**
     * Return a random Czech postal code (PSČ), formatted as "000 00".
     *
     * @return string
     */
    public function postcode(): string
    {
        return sprintf('%d%02d %02d', $this->randomizer->getInt(1, 7), $this->randomizer->getInt(0, 99), $this->randomizer->getInt(0, 99));
    }

    /**
     * Return a random house number: a conscription number (číslo popisné), optionally followed
     * by a street number (číslo orientační), e.g. "681/14".
     *
     * @return string
     */
    public function houseNumber(): string
    {
        $houseNumber = (string) $this->randomizer->getInt(1, 3500);

        if ($this->randomizer->getInt(0, 2) > 0) {
            $houseNumber .= '/'.$this->randomizer->getInt(1, 120);
        }

        return $houseNumber;
    }

    /**
     * Return a random street name.
     *
     * @return string
     */
    public function streetName(): string
    {
        return $this->pickArrayRandomElement($this->streetNames);
    }

    /**
     * Return a random street address, e.g. "Husova 681/14".
     *
     * @return string
     */
    public function streetAddress(): string
    {
        return sprintf('%s %s', $this->streetName(), $this->houseNumber());
    }

    /**
     * Return a full address on one line: street address, postal code and city.
     *
     * @return string
     */
    public function fullAddress(): string
    {
        return sprintf('%s, %s %s', $this->streetAddress(), $this->postcode(), $this->city());
    }
}
