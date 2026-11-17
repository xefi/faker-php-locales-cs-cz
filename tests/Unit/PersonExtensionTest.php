<?php

namespace Xefi\Faker\CsCz\Tests\Unit;

use Random\Randomizer;
use ReflectionClass;
use Xefi\Faker\CsCz\Extensions\PersonExtension as CsCzPersonExtension;
use Xefi\Faker\Extensions\PersonExtension;

final class PersonExtensionTest extends TestCase
{
    protected array $firstNameMale = [];
    protected array $firstNameFemale = [];
    protected array $lastName = [];
    protected array $lastNameFemale = [];
    protected array $titleMale = [];
    protected array $titleFemale = [];

    protected function setUp(): void
    {
        parent::setUp();

        $personExtension = new CsCzPersonExtension(new Randomizer());
        $this->firstNameMale = (new ReflectionClass($personExtension))->getProperty('firstNameMale')->getValue($personExtension);
        $this->firstNameFemale = (new ReflectionClass($personExtension))->getProperty('firstNameFemale')->getValue($personExtension);
        $this->lastName = (new ReflectionClass($personExtension))->getProperty('lastName')->getValue($personExtension);
        $this->lastNameFemale = (new ReflectionClass($personExtension))->getProperty('lastNameFemale')->getValue($personExtension);
        $this->titleMale = (new ReflectionClass($personExtension))->getProperty('titleMale')->getValue($personExtension);
        $this->titleFemale = (new ReflectionClass($personExtension))->getProperty('titleFemale')->getValue($personExtension);
    }

    public function testFirstNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameFemale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameFemale,
            $results
        );
    }

    public function testFirstNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->firstNameMale); $i++) {
            $results[] = $this->faker->unique()->firstName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->firstNameMale,
            $results
        );
    }

    public function testFirstName(): void
    {
        $results = [];
        $firstnames = array_unique(array_merge($this->firstNameMale, $this->firstNameFemale));
        for ($i = 0; $i < count($firstnames); $i++) {
            $results[] = $this->faker->unique()->firstName();
        }

        $this->assertEqualsCanonicalizing(
            $firstnames,
            $results
        );
    }

    public function testLastNameMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastName); $i++) {
            $results[] = $this->faker->unique()->lastName(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->lastName,
            $results
        );
    }

    public function testLastNameFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->lastNameFemale); $i++) {
            $results[] = $this->faker->unique()->lastName(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->lastNameFemale,
            $results
        );
    }

    public function testLastName(): void
    {
        $lastNames = array_merge($this->lastName, $this->lastNameFemale);

        $results = [];
        for ($i = 0; $i < count($lastNames); $i++) {
            $results[] = $this->faker->unique()->lastName();
        }

        $this->assertEqualsCanonicalizing(
            $lastNames,
            $results
        );
    }

    public function testNameMale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_MALE), 2);

            $this->assertContains($firstName, $this->firstNameMale);
            $this->assertContains($lastName, $this->lastName);
        }
    }

    public function testNameFemale(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(PersonExtension::GENDER_FEMALE), 2);

            $this->assertContains($firstName, $this->firstNameFemale);
            $this->assertContains($lastName, $this->lastNameFemale);
        }
    }

    public function testName(): void
    {
        for ($i = 0; $i < 100; $i++) {
            [$firstName, $lastName] = explode(' ', $this->faker->name(), 2);

            if (in_array($firstName, $this->firstNameFemale, true)) {
                $this->assertContains($lastName, $this->lastNameFemale);
            } else {
                $this->assertContains($firstName, $this->firstNameMale);
                $this->assertContains($lastName, $this->lastName);
            }
        }
    }

    public function testTitleFemale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleFemale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_FEMALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->titleFemale,
            $results
        );
    }

    public function testTitleMale(): void
    {
        $results = [];
        for ($i = 0; $i < count($this->titleMale); $i++) {
            $results[] = $this->faker->unique()->title(PersonExtension::GENDER_MALE);
        }

        $this->assertEqualsCanonicalizing(
            $this->titleMale,
            $results
        );
    }

    public function testTitle(): void
    {
        $titles = array_unique(array_merge($this->titleFemale, $this->titleMale));

        $results = [];
        for ($i = 0; $i < count($titles); $i++) {
            $results[] = $this->faker->unique()->title();
        }

        $this->assertEqualsCanonicalizing(
            $titles,
            $results
        );
    }

    public function testRodneCislo(): void
    {
        for ($i = 0; $i < 100; $i++) {
            $rodneCislo = $this->faker->rodneCislo();

            $this->assertMatchesRegularExpression('/^\d{6}\/\d{4}$/', $rodneCislo);
            $this->assertRodneCisloIsValid($rodneCislo);
        }
    }

    public function testRodneCisloGender(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $male = $this->faker->rodneCislo(PersonExtension::GENDER_MALE);
            $female = $this->faker->rodneCislo(PersonExtension::GENDER_FEMALE);

            $this->assertRodneCisloIsValid($male);
            $this->assertRodneCisloIsValid($female);
            $this->assertLessThanOrEqual(12, (int) substr($male, 2, 2));
            $this->assertGreaterThanOrEqual(51, (int) substr($female, 2, 2));
        }
    }

    private function assertRodneCisloIsValid(string $rodneCislo): void
    {
        $digits = str_replace('/', '', $rodneCislo);
        $month = (int) substr($digits, 2, 2);
        $month = $month > 50 ? $month - 50 : $month;
        $year = (int) substr($digits, 0, 2);
        $year += $year >= 54 ? 1900 : 2000;

        $this->assertTrue(checkdate($month, (int) substr($digits, 4, 2), $year), "'{$rodneCislo}' does not contain a valid birth date");
        $this->assertSame(0, (int) $digits % 11, "'{$rodneCislo}' must be divisible by 11");
    }
}
