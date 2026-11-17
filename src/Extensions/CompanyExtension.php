<?php

namespace Xefi\Faker\CsCz\Extensions;

use Xefi\Faker\Extensions\Extension;

class CompanyExtension extends Extension
{
    private array $companies = [
        'Novák a syn s.r.o.', 'Vltava Stavby a.s.', 'Moravské strojírny a.s.',
        'Šumava Dřevo s.r.o.', 'Krkonošská pekárna s.r.o.', 'Pražská logistika a.s.',
        'Dvořák & Kučera v.o.s.', 'Brněnské softwarové studio s.r.o.', 'Labská energetika a.s.',
        'Hanácké mlékárny družstvo', 'Ostravská ocel a.s.', 'Pivovar Hvězda Plzeň s.r.o.',
        'Svoboda Elektro s.r.o.', 'Beskydy Tour s.r.o.', 'Českomoravská doprava a.s.',
        'Jizerské sklárny s.r.o.', 'Polabské zemědělské družstvo', 'Horák a partneři v.o.s.',
        'Zlatá Praha Reality s.r.o.', 'Severočeské vodárny a.s.', 'Kovárna Kříž k.s.',
        'Jihočeské rybářství s.r.o.', 'Datová centra Morava a.s.', 'Lesy Vysočiny s.r.o.',
        'Pokorný stavební spol. s r.o.', 'Orlík Design s.r.o.', 'Valašská textilka a.s.',
        'Česká lékárenská síť a.s.', 'Hradecké tiskárny s.r.o.', 'Bohemia Nábytek k.s.',
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
     * Return a random company name.
     *
     * @return string
     */
    public function company(): string
    {
        return $this->pickArrayRandomElement($this->companies);
    }

    /**
     * Generate a Czech company identification number (IČO): 8 digits with a valid modulo 11 check digit.
     *
     * @return string
     */
    public function ico(): string
    {
        $digits = $this->randomizer->getBytesFromString('0123456789', 7);

        $sum = 0;
        for ($i = 0; $i < 7; $i++) {
            $sum += (int) $digits[$i] * (8 - $i);
        }

        return $digits.((11 - $sum % 11) % 10);
    }

    /**
     * Generate a Czech VAT number (DIČ) of a legal entity: "CZ" followed by its IČO.
     *
     * @return string
     */
    public function vat(): string
    {
        return 'CZ'.$this->ico();
    }
}
