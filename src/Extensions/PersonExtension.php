<?php

namespace Xefi\Faker\CsCz\Extensions;

use Xefi\Faker\Extensions\PersonExtension as BasePersonExtension;

class PersonExtension extends BasePersonExtension
{
    protected $firstNameMale = [
        'Jiří', 'Jan', 'Petr', 'Josef', 'Pavel', 'Martin', 'Tomáš', 'Jaroslav', 'Miroslav', 'Zdeněk',
        'Václav', 'Michal', 'František', 'Jakub', 'Milan', 'Karel', 'Lukáš', 'David', 'Vladimír', 'Ondřej',
        'Stanislav', 'Ladislav', 'Roman', 'Marek', 'Radek', 'Daniel', 'Antonín', 'Vojtěch', 'Filip', 'Adam',
        'Matěj', 'Dominik', 'Libor', 'Vít', 'Ivan', 'Aleš', 'Bohumil', 'Radim', 'Šimon', 'Štěpán',
    ];

    protected $firstNameFemale = [
        'Marie', 'Jana', 'Eva', 'Hana', 'Anna', 'Lenka', 'Kateřina', 'Věra', 'Lucie', 'Alena',
        'Petra', 'Jaroslava', 'Veronika', 'Martina', 'Ludmila', 'Jitka', 'Helena', 'Tereza', 'Michaela', 'Zdeňka',
        'Ivana', 'Monika', 'Eliška', 'Zuzana', 'Markéta', 'Barbora', 'Kristýna', 'Klára', 'Adéla', 'Natálie',
        'Simona', 'Dagmar', 'Vlasta', 'Božena', 'Radka', 'Šárka', 'Blanka', 'Romana', 'Dana', 'Pavla',
    ];

    protected $lastName = [
        'Novák', 'Svoboda', 'Novotný', 'Dvořák', 'Černý', 'Procházka', 'Kučera', 'Veselý', 'Horák', 'Němec',
        'Marek', 'Pospíšil', 'Pokorný', 'Hájek', 'Král', 'Jelínek', 'Růžička', 'Beneš', 'Fiala', 'Sedláček',
        'Doležal', 'Zeman', 'Kolář', 'Navrátil', 'Čermák', 'Vaněk', 'Urban', 'Blažek', 'Kříž', 'Kovář',
        'Bartoš', 'Vlček', 'Polák', 'Musil', 'Kopecký', 'Šimek', 'Konečný', 'Malý', 'Holub', 'Štěpánek',
    ];

    protected $lastNameFemale = [
        'Nováková', 'Svobodová', 'Novotná', 'Dvořáková', 'Černá', 'Procházková', 'Kučerová', 'Veselá', 'Horáková', 'Němcová',
        'Marková', 'Pospíšilová', 'Pokorná', 'Hájková', 'Králová', 'Jelínková', 'Růžičková', 'Benešová', 'Fialová', 'Sedláčková',
        'Doležalová', 'Zemanová', 'Kolářová', 'Navrátilová', 'Čermáková', 'Vaňková', 'Urbanová', 'Blažková', 'Křížová', 'Kovářová',
        'Bartošová', 'Vlčková', 'Poláková', 'Musilová', 'Kopecká', 'Šimková', 'Konečná', 'Malá', 'Holubová', 'Štěpánková',
    ];

    protected $titleMale = ['Pan', 'Ing.', 'Mgr.', 'MUDr.', 'JUDr.', 'Bc.', 'doc.', 'prof.'];

    protected $titleFemale = ['Paní', 'Slečna', 'Ing.', 'Mgr.', 'MUDr.', 'JUDr.', 'Bc.', 'doc.', 'prof.'];

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
     * Return a full name whose last name agrees with the gender of the first name.
     *
     * @param string|null $gender One of static::GENDER_MALE or static::GENDER_FEMALE, random when null.
     *
     * @return string
     */
    public function name(?string $gender = null): string
    {
        if ($gender === null) {
            $gender = $this->randomizer->getInt(0, 1) === 0 ? static::GENDER_FEMALE : static::GENDER_MALE;
        }

        return sprintf('%s %s', $this->firstName($gender), $this->lastName($gender));
    }

    /**
     * Return a last name, in its feminine form (-ová, -á) for women.
     *
     * @param string|null $gender One of static::GENDER_MALE or static::GENDER_FEMALE, random when null.
     *
     * @return string
     */
    public function lastName(?string $gender = null): string
    {
        if ($gender === static::GENDER_MALE) {
            return $this->pickArrayRandomElement($this->lastName);
        }

        if ($gender === static::GENDER_FEMALE) {
            return $this->pickArrayRandomElement($this->lastNameFemale);
        }

        return $this->pickArrayRandomElement($this->randomizer->getInt(0, 1) === 0 ? $this->lastNameFemale : $this->lastName);
    }

    /**
     * Generate a Czech birth number (rodné číslo), formatted as YYMMDD/XXXX.
     *
     * The month is increased by 50 for women and the whole 10-digit number is divisible by 11.
     *
     * @param string|null $gender One of static::GENDER_MALE or static::GENDER_FEMALE, random when null.
     *
     * @return string
     */
    public function rodneCislo(?string $gender = null): string
    {
        if ($gender === null) {
            $gender = $this->randomizer->getInt(0, 1) === 0 ? static::GENDER_FEMALE : static::GENDER_MALE;
        }

        do {
            $birthDate = $this->randomizer->getInt(gmmktime(0, 0, 0, 1, 1, 1954), gmmktime(0, 0, 0, 12, 31, 2020));
            $month = (int) gmdate('n', $birthDate) + ($gender === static::GENDER_FEMALE ? 50 : 0);

            $number = sprintf(
                '%s%02d%s%03d',
                gmdate('y', $birthDate),
                $month,
                gmdate('d', $birthDate),
                $this->randomizer->getInt(0, 999)
            );
            $checkDigit = (int) $number % 11;
        } while ($checkDigit === 10);

        return sprintf('%s/%s%d', substr($number, 0, 6), substr($number, 6), $checkDigit);
    }
}
